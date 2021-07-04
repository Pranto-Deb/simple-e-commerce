<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Attachment;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::notDelete()->with('attachment')->paginate(15);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create_update');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'category_name' => ['required', 'string', 'max:255'],
            'category_details' => ['required'],
            'position' => ['required'],
            'status'=> ['required'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $category = Category::create([
                    'category_name'=> $request->category_name,
                    'category_details'=> $request->category_details,
                    'position'=> $request->position,
                    'status'=> $request->status,
                ]);

                if (!empty($category)) {
                    if(!empty($request->file('image_path'))){
                        $category->updateAttachment($request->file('image_path'));
                    }
                    DB::commit();
                    return JsonResponse::allResponse('success', Response::HTTP_OK, 'Category Added Successfully', route('admin.category.index'));
                }
                else {
                    throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
                }

            }catch (\Exception $ex){
                DB::rollback();
                return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
            }
        }else {
            $errors = array_values($validator->errors()->getMessages());
            return JsonResponse::validationResponse($errors);
        }
    }

    public function edit($id)
    {
        $category = Category::where('category_id', $id)->firstOrFail();
        return view('admin.category.create_update', [
            'category'=>$category,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'category_name' => ['required', 'string', 'max:255'],
            'category_details' => ['required'],
            'position' => ['required'],
            'status'=> ['required'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $category = Category::where('category_id', $id)->first();
                if(empty($category)){
                    throw new Exception('Invalid Category Information', 404);
                }

                $categoryU = $category->update([
                    'category_name'=> $request->category_name,
                    'category_details'=> $request->category_details,
                    'position'=> $request->position,
                    'status'=> $request->status,
                ]);

                if (!empty($categoryU)) {
                    if(!empty($request->file('image_path'))){
                        $category->updateAttachment($request->file('image_path'));
                    }
                    DB::commit();
                    return JsonResponse::allResponse('success', Response::HTTP_OK, 'Category Updated Successfully', route('admin.category.index'));
                } else {
                    throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
                }

            }catch (\Exception $ex){
                DB::rollback();
                return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
            }
        }else {
            $errors = array_values($validator->errors()->getMessages());
            return JsonResponse::validationResponse($errors);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $category = Category::where('category_id', $id)->first();
            if(empty($category)){
                throw new Exception('Invalid Category Information', 404);
            }
            $categoryU = $category->update([
                'status'=> config('app.delete'),
            ]);

            if (!empty($categoryU)) {
                DB::commit();
                return JsonResponse::allResponse('success', Response::HTTP_OK, 'Category Deleted Successfully', route('admin.category.index'));
            } else {
                throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
            }

        }catch (\Exception $ex){
            DB::rollback();
            return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
        }
    }
}
