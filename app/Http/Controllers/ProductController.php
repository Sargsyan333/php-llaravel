<?php

namespace App\Http\Controllers;

use App\Package;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('orders','images')->get();

        return response()->json([ 'data' => $products]);
    }

    /**
     *
     */
    public function getPackages()
    {
        $packages = Package::latest()->get();

        return response()->json([ 'data' => $packages]);
    }
}
