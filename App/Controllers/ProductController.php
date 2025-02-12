<?php

namespace App\Controllers;

use Src\Validation\Validator;
use App\Models\Product;
class ProductController
{
    public function index()
    {
        $products = Product::all();

        return view('products', ['products' => $products]);
    }
    public function create()
    {
        return view('add-product');
    }
    public function store()
    {
        $validator = new Validator();
        $validator->setRules([

            'sku' => 'required|unique:product,sku',
            'name' => 'required',
            'price' => 'required|numeric',
            'type' => 'required',
            'weight' => 'required_if:type,book|numeric',
            'size' => 'required_if:type,dvd|numeric',
            'height' => 'required_if:type,furniture|numeric',
            'width' => 'required_if:type,furniture|numeric',
            'length' => 'required_if:type,furniture|numeric',
        ]);
        $validator->make(request()->all());

        if (!$validator->passes()) {
            app()->session->setFlash('errors', $validator->errors());
            app()->session->setFlash('old', request()->all());


            return back();
        }

        Product::create([
            'sku'    => request('sku'),
            'name'   => request('name'),
            'price'  => request('price'),
            'type'   => request('type'),
            // Provide type-specific fields based on user selection:
            'size'   => request('size'),       // Used if type is "dvd"
            'weight' => request('weight'),     // Used if type is "book"
            'height' => request('height'),     // Used if type is "furniture"
            'width'  => request('width'),
            'length' => request('length'),
        ]);
        

        app()->session->setFlash('success', 'Added sucessfully :D');

        return redirect('/');
    }
    public function delete()
    {
        // Retrieve the array of product IDs from the request
        $ids = request('checkedProducts');

        Product::deleteMany($ids);

        app()->session->setFlash('success', 'Selected products deleted successfully.');

        return back();
    }


}