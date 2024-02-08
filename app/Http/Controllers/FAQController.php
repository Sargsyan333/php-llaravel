<?php

namespace App\Http\Controllers;

use App\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = FAQ::all();
        return response()->json(['data' => $faqs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $faq = FAQ::create($data);

        return response()->json(['data' => $faq]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fAQ)
    {
        $data = $request->all();
        $faqItem = FAQ::find($fAQ);

        $faqItem->update($data);

        return response()->json(['data' => $data,'a' => $fAQ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy($fAQ)
    {
        FAQ::destroy($fAQ);

        return response()->json([
            'status' => 200,
            'message' => 'FAQ deleted successfully'
        ]);
    }
}
