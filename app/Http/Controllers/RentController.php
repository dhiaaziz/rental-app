<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = [
            ['id' => 1, 'image' => 'https://example.com/image1.jpg', 'title' => 'Xbox Series X', 'color' => 'Black', 'price' => 499],
            ['id' => 2, 'image' => 'https://example.com/image2.jpg', 'title' => 'PlayStation 5', 'color' => 'White', 'price' => 499],
            ['id' => 3, 'image' => 'https://example.com/image3.jpg', 'title' => 'Nintendo Switch', 'color' => 'Red & Blue', 'price' => 299],
        ];

        return view('pages.rent.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
