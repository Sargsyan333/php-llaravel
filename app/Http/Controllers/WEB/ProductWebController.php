<?php

namespace App\Http\Controllers\WEB;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductWebController extends Controller
{

    private $model;

    /**
     * ProductWebController constructor.
     */
    public function __construct()
    {
        $this->model = new Product();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('images')->latest()->get();

        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productCreated = Product::create($this->mutateProductData($request->all()));

        if($request->hasFile('images')) {
            $files = $request->file('images');

            $this->storeImages($files,$productCreated->id);
        }

        return redirect('/administration/products');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('admin.product.update',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Product $product)
    {
        $productData = $request->all();

        if(!isset($productData['current_images']))
            $productData['current_images'] = [];

        $this->updateCurrentImages($product,$productData['current_images']);

        $product->update($this->mutateProductData($productData));

        if($request->hasFile('images')) {
            $files = $request->file('images');

            $this->storeImages($files,$product->id);
        }

        return redirect("administration/products");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Product deleted successfully'
        ]);
    }

    /**
     * @param $currentImages
     * @param $imgIds
     */
    private function updateCurrentImages($currentImages,$imgIds)
    {
        foreach ($currentImages->images as $productImage) {
            if(!in_array($productImage->id,$imgIds)) {
                Storage::delete($productImage->filename);
                $productImage->delete();
            }
        }
    }

    /**
     * @param $files
     * @param $productId
     */
    private function storeImages($files,$productId)
    {
        foreach ($files as $photo) {

            $fileName = "skee_".time().'.'.$photo->getClientOriginalExtension();

            $photo->storeAs('uploads',$fileName);

            Image::create([
                'product_id' => $productId,
                'filename' => $fileName
            ]);
        }
    }

    /**
     * @param $productData
     * @return mixed
     */
    private function mutateProductData($productData)
    {
        if(Str::contains($productData['price'], ',')) {
            $productData['price'] = (double) Str::replaceFirst(',', '.', $productData['price']);
        }

        if(Str::contains($productData['weight'], ',')) {
            $productData['weight'] = (double) Str::replaceFirst(',', '.', $productData['weight']);
        }

        if(isset($productData['current_images']))  unset($productData['current_images']);
        if(isset($productData['images']))  unset($productData['images']);

        return $productData;
    }
}
