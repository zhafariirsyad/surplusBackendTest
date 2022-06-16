<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Image;
use App\Product;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
{
    public function index(){
        $datas = [];
        $productImages = ProductImage::with('products','images')->get();
        foreach($productImages as $productImage){
            $datas['productImages'][] = $productImage;
        }

        if(!count($productImages)){
            return response([
                'message' => 'There is no data in the product images table'
            ],200);
        }

        return response([
            'productImages' => $datas['productImages'],
            'message'       => 'Retrieved successfully'
        ],200);
    }

    public function store(Request $request)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'image_id'    => 'required|numeric',
            'product_id'  => 'required|numeric',
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $image = Image::find($request->image_id);
        if(!$image){
            return response([
                'message' => 'Whoops, Image not found!'
            ],400);
        }

        $product = Product::find($request->product_id);

        if(!$product){
            return response([
                'message' => 'Whoops, Product not found!'
            ],400);
        }

        $productImages = ProductImage::create($datas);

        return response([
            'message'         => 'Created successfully',
            'productImages' => ProductImage::with('products','images')->find($productImages->id),
        ],201);
    }

    public function show($id)
    {
        $productImage = ProductImage::with('products','images')->find($id);

        if(!$productImage){
            return response([
                'message' => 'Whoops, data not found!'
            ],400);
        }

        return response([
            'productImage'  => $productImage,
            'message'       => 'Retrieved successfully'
        ],200);
    }

    public function update(Request $request, $id)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'image_id'    => 'required|numeric',
            'product_id'  => 'required|numeric',
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $image = Image::find($request->image_id);
        if(!$image){
            return response([
                'message' => 'Whoops, Image not found!'
            ],400);
        }

        $product = Product::find($request->product_id);

        if(!$product){
            return response([
                'message' => 'Whoops, Product not found!'
            ],400);
        }

        $productImages = ProductImage::find($id);
        $productImages->image_id = $request->image_id;
        $productImages->product_id = $request->product_id;
        $productImages->save();

        return response([
            'message'       => 'Updated successfully',
            'productImages' => ProductImage::with('products','images')->find($productImages->id),
        ],200);
    }

    public function destroy($id)
    {
        $productImage = ProductImage::find($id);

        if(!$productImage){
            return response([
                'message' => 'No data to delete'
            ],400);
        }

        $productImage->delete();

        return response([
            'message'  => 'Deleted successfully'
        ],200);
    }
}
