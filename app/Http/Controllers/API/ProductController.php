<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        if(!count($products)){
            return response([
                'message' => 'There is no data in the products table'
            ],200);
        }

        return response([
            'products'   => $products,
            'message'    => 'Retrieved successfully'
        ],200);
    }

    public function store(Request $request)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'name'          => 'required|max:100',
            'description'   => 'required'
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $product = Product::create($datas);

        return response([
            'product'  => $product,
            'message'  => 'Created successfully'
        ],201);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'Whoops, data not found!'
            ],400);
        }

        return response([
            'product'    => $product,
            'message'    => 'Retrieved successfully'
        ],200);
    }

    public function update(Request $request, $id)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'name'          => 'required|max:100',
            'description'   => 'required'
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->enable = $request->enable ?? 0;
        $product->save();

        return response([
            'product'  => $product,
            'message'  => 'Updated successfully'
        ],200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            return response([
                'message' => 'No data to delete'
            ],400);
        }

        $product->delete();

        return response([
            'message'  => 'Deleted successfully'
        ],200);
    }
}
