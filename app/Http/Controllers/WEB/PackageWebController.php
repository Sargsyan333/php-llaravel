<?php

namespace App\Http\Controllers\WEB;

use App\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackageWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::latest()->get();
        return view('admin.package.index',compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Package::create($request->all());

        return redirect('/administration/packages');
    }

    /**
     * @param Package $package
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Package $package)
    {
        return view('admin.package.show',compact('package'));
    }

    /**
     * @param Package $package
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Package $package)
    {
        return view('admin.package.update',compact('package'));
    }


    public function update(Request $request, Package $package)
    {
        $package->update(
            $request->all()
        );

        return redirect("administration/packages");
    }


    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Package deleted successfully'
        ]);
    }
}
