<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::orderBy('size_id', 'desc')->paginate(15);
        return view('admin.size.index', compact('sizes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'size_name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $size = Size::create([
                    'size_name'=> $request->size_name,
                ]);

                if (!empty($size)) {
                    DB::commit();
                    return JsonResponse::allResponse('success', '200', 'Size Added Successfully', route('admin.size.index'));
                }
                else {
                    throw new Exception('Invalid information',400);
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

            $size = Size::find($id);
            if(empty($size)){
                throw new Exception('Invalid Size Information');
            }
            $sizeU = $size->delete();
            if (!empty($sizeU)) {
                DB::commit();
                return JsonResponse::allResponse('success', Response::HTTP_OK, 'Size Deleted Successfully', route('admin.size.index'));

            } else {
                throw new Exception('Invalid Size Information');
            }

        }catch (\Exception $ex){
            DB::rollback();
            return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
        }
    }
}
