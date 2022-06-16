<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index(){
        $images = Image::all();

        if(!count($images)){
            return response([
                'message' => 'There is no data in the images table'
            ],200);
        }

        return response([
            'images'   => $images,
            'message'  => 'Retrieved successfully'
        ],200);
    }

    public function store(Request $request){
        $datas = $request->all();

        $validator = Validator::make($datas,[
            'name' => 'required|max:100',
            'file' => 'required|mimes:jpg,png,jpeg,webp,jfif'
        ]);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $image       = new Image;
        $image->name = $request->name;

        if($request->hasFile('file')) {
            if($request->file('file')->isValid()) {
                $file      = $request->file('file');
                $fileName = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/images' ;
                $file->move($destinationPath,$fileName);

                $image->file = '/images/'.$fileName;
            }
        }

        $image->save();

        return response([
            'image'    => $image,
            'message'  => 'Created successfully'
        ],201);
    }

    public function show($id)
    {
        $image = Image::find($id);

        if(!$image){
            return response([
                'message' => 'Whoops, data not found!'
            ],400);
        }

        return response([
            'image'    => $image,
            'message'  => 'Retrieved successfully'
        ],200);
    }

    public function update(Request $request, $id){
        $datas = $request->all();

        $rules = [
            'name' => 'required|max:100'
        ];

        if($request->hasFile('file')){
            $rules['file'] = 'required|mimes:jpg,png,jpeg,webp,jfif';
        }
        $validator = Validator::make($datas,$rules);

        if($validator->fails()){
            return response([
                'message'=> 'Validation Error',
                'errors' => $validator->errors()
            ],400);
        }

        $image       = Image::find($id);
        $image->name = $request->name;

        if($request->hasFile('file')) {
            if($request->file('file')->isValid()) {
                $file = $request->file('file');
                if(file_exists(public_path('/images/'.$file->getClientOriginalName()))){
                    unlink(public_path('/images/'.$file->getClientOriginalName()));
                }
                $fileName        = $file->getClientOriginalName() ;
                $destinationPath = public_path().'/images' ;
                $file->move($destinationPath,$fileName);

                $image->file = '/images/'.$fileName;
            }
        }

        $image->save();

        return response([
            'image'    => $image,
            'message'  => 'Updated successfully'
        ],201);
    }

    public function destroy($id)
    {
        $image = Image::find($id);

        if(!$image){
            return response([
                'message' => 'No data to delete'
            ],400);
        }

        unlink(public_path($image->file));
        $image->delete();

        return response([
            'message'  => 'Deleted successfully'
        ],200);
    }
}
