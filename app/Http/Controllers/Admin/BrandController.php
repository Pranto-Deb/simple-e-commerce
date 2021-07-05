<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Attachment;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::notDelete()->with('attachment')->paginate(15);
        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create_update');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'brand_name' => ['required', 'string', 'max:255'],
            'brand_details' => ['required'],
            'position' => ['required'],
            'status'=> ['required'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $brand = Brand::create([
                    'brand_name'=> $request->brand_name,
                    'brand_details'=> $request->brand_details,
                    'position'=> $request->position,
                    'status'=> $request->status,
                ]);

                if (!empty($brand)) {
                    if(!empty($request->file('image_path'))){
                        $brand->updateAttachment($request->file('image_path'));
                    }
                    DB::commit();
                    return JsonResponse::allResponse('success', Response::HTTP_OK, 'Brand Added Successfully', route('admin.brand.index'));
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
        $brand = Brand::where('brand_id', $id)->firstOrFail();
        return view('admin.brand.create_update', [
            'brand'=>$brand,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'brand_name' => ['required', 'string', 'max:255'],
            'brand_details' => ['required'],
            'position' => ['required'],
            'status'=> ['required'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $brand = Brand::where('brand_id', $id)->first();
                if(empty($brand)){
                    throw new Exception('Invalid Brand Information', 404);
                }

                $brandU = $brand->update([
                    'brand_name'=> $request->brand_name,
                    'brand_details'=> $request->brand_details,
                    'position'=> $request->position,
                    'status'=> $request->status,
                ]);

                if (!empty($brandU)) {
                    if(!empty($request->file('image_path'))){
                        $brand->updateAttachment($request->file('image_path'));
                    }
                    DB::commit();
                    return JsonResponse::allResponse('success', Response::HTTP_OK, 'Brand Updated Successfully', route('admin.brand.index'));
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
            $brand = Brand::where('brand_id', $id)->first();
            if(empty($brand)){
                throw new Exception('Invalid Brand Information', 404);
            }
            $brandU = $brand->update([
                'status'=> config('app.delete'),
            ]);

            if (!empty($brandU)) {
                DB::commit();
                return JsonResponse::allResponse('success', Response::HTTP_OK, 'Brand Deleted Successfully', route('admin.brand.index'));
            } else {
                throw new Exception('Invalid information', Response::HTTP_BAD_REQUEST);
            }

        }catch (\Exception $ex){
            DB::rollback();
            return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
        }
    }
}
