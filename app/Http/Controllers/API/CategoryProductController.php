<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    public function index(){
        $datas = [];
        $categoryProducts = CategoryProduct::with('categories','products')->get();
        foreach($categoryProducts as $categoryProduct){
            $datas['categoryProducts'][] = $categoryProduct;
        }

        if(!count($categoryProducts)){
            return response([
                'message' => 'There is no data in the category products table'
            ],200);
        }

        return response([
            'categoryProducts' => $datas['categoryProducts'],
            'message'          => 'Retrieved successfully'
        ],200);
    }

    public function store(Request $request)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'category_id' => 'required|numeric',
            'product_id'  => 'required|numeric',
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $category = Category::find($request->category_id);
        if(!$category){
            return response([
                'message' => 'Whoops, Category not found!'
            ],400);
        }

        $product = Product::find($request->product_id);

        if(!$product){
            return response([
                'message' => 'Whoops, Product not found!'
            ],400);
        }

        $categoryProduct = CategoryProduct::create($datas);

        return response([
            'message'         => 'Created successfully',
            'categoryProduct' => CategoryProduct::with('categories','products')->find($categoryProduct->id),
        ],201);
    }

    public function show($id)
    {
        $categoryProducts = CategoryProduct::with('categories','products')->find($id);

        if(!$categoryProducts){
            return response([
                'message' => 'Whoops, data not found!'
            ],400);
        }

        return response([
            'categoryProducts'  => $categoryProducts,
            'message'           => 'Retrieved successfully'
        ],200);
    }

    public function update(Request $request, $id)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'category_id' => 'required|numeric',
            'product_id'  => 'required|numeric',
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $category = Category::find($request->category_id);
        if(!$category){
            return response([
                'message' => 'Whoops, Category not found!'
            ],400);
        }

        $product = Product::find($request->product_id);

        if(!$product){
            return response([
                'message' => 'Whoops, Product not found!'
            ],400);
        }

        $categoryProduct = CategoryProduct::find($id);
        $categoryProduct->category_id = $request->category_id;
        $categoryProduct->product_id = $request->product_id;
        $categoryProduct->save();

        return response([
            'message'         => 'Updated successfully',
            'categoryProduct' => $categoryProduct->with('categories','products')->find($id),
        ],200);
    }

    public function destroy($id)
    {
        $categoryProduct = CategoryProduct::find($id);

        if(!$categoryProduct){
            return response([
                'message' => 'No data to delete'
            ],400);
        }

        $categoryProduct->delete();

        return response([
            'message'  => 'Deleted successfully'
        ],200);
    }
}
