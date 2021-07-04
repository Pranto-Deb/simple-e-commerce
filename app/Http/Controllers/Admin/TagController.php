<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('tag_id', 'desc')->paginate(15);
        return view('admin.tag.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'tag_name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $tag = Tag::create([
                    'tag_name'=> $request->tag_name,
                ]);

                if (!empty($tag)) {
                    DB::commit();
                    return JsonResponse::allResponse('success', '200', 'Tag Added Successfully', route('admin.tag.index'));
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

            $tag = Tag::find($id);
            if(empty($tag)){
                throw new Exception('Invalid Tag Information');
            }
            $tagU = $tag->delete();
            if (!empty($tagU)) {
                DB::commit();
                return JsonResponse::allResponse('success', Response::HTTP_OK, 'Tag Deleted Successfully', route('admin.tag.index'));

            } else {
                throw new Exception('Invalid Tag Information');
            }

        }catch (\Exception $ex){
            DB::rollback();
            return JsonResponse::allResponse('error', $ex->getCode(), $ex->getMessage());
        }
    }
}
