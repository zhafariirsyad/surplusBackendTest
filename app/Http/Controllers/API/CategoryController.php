<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if(!count($categories)){
            return response([
                'message' => 'There is no data in the categories table'
            ],200);
        }

        return response([
            'categories' => $categories,
            'message'    => 'Retrieved successfully'
        ],200);
    }

    public function store(Request $request)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'name' => 'required|max:100'
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $category = Category::create($datas);

        return response([
            'category' => $category,
            'message'  => 'Created successfully'
        ],201);
    }

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response([
                'message' => 'Whoops, data not found!'
            ],400);
        }

        return response([
            'category' => $category,
            'message'    => 'Retrieved successfully'
        ],200);
    }

    public function update(Request $request, $id)
    {
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'name' => 'required|max:100'
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->enable = $request->enable ?? 0;
        $category->save();

        return response([
            'category' => $category,
            'message'  => 'Updated successfully'
        ],200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response([
                'message' => 'No data to delete'
            ],400);
        }

        $category->delete();

        return response([
            'message'  => 'Deleted successfully'
        ],200);
    }
}
