<?php

namespace App\Http\Controllers\WEB;

use App\FAQ;
use App\Http\Requests\FAQRequest;
use Faker\Provider\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FAQWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::latest()->get();

        return view('admin.faq.index',compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FAQRequest $request)
    {
        FAQ::create(
            $request->all()
        );

        return redirect('/administration/faqs');
    }

    /**
     * Display the specified resource.
     *
     * @param FAQ $faq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(FAQ $faq)
    {
        return view('admin.faq.show',compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FAQ $faq
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(FAQ $faq)
    {
        return view('admin.faq.update',compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FAQRequest $request
     * @param FAQ $faq
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FAQRequest $request, FAQ $faq)
    {
        $faq->update(
            $request->all()
        );

        return redirect("administration/faqs");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FAQ $faq
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Faq deleted successfully'
        ]);
    }
}
