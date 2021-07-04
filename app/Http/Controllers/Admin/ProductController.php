<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Attachment;
use App\Traits\JsonResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::notDelete()->searchBy($request)->with('tags', 'sizes', 'thumb')->paginate(15);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $sizes = Size::orderBy('size_name', 'ASC')->pluck('size_name', 'size_id');
        $tags = Tag::orderBy('tag_name', 'ASC')->pluck('tag_name', 'tag_id');
        $categories = Category::isActive()->orderBy('position', 'asc')->pluck('category_name', 'category_id');
        $brands = Brand::isActive()->orderBy('position', 'asc')->pluck('brand_name', 'brand_id');
        return view('admin.product.create_update', compact('tags', 'sizes', 'categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'product_name' => ['required', 'string', 'max:255'],
            'product_price' => ['required', 'numeric'],
            'cat_id' => ['required'],
            'br_id' => ['required'],
            'product_features' => ['required'],
            'product_details' => ['required'],
            'product_quantity' => ['required'],
            'product_meta' => ['required'],
            'position' => ['required'],
            'status'=> ['required'],
            'images'=> ['nullable', 'array'],
            'images.*'=> ['mimes:jpeg,jpg,png','max:1024']
        ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $product = Product::create([
                    'product_name'=> $request->product_name,
                    'product_price'=> $request->product_price,
                    'cat_id'=> $request->cat_id,
                    'br_id'=> $request->br_id,
                    'product_features'=> $request->product_features,
                    'product_details'=> $request->product_details,
                    'product_quantity'=> $request->product_quantity,
                    'product_meta'=> $request->product_meta,
                    'position'=> $request->position,
                    'status'=> $request->status,
                ]);

                if (!empty($product)) {
                    if (!empty($request->tag_ids) && count($request->tag_ids) > 0){
                        $product->updateTaggable($request->tag_ids);
                    }

                    if (!empty($request->size_ids) && count($request->size_ids) > 0){
                        $product->updateSizeable($request->size_ids);
                    }

                    if(!empty($request->images) && count($request->images) > 0){
                        foreach ($request->images as $image){
                            if (!empty($image)){
                                $product->updateAttachment($image);
                            }
                        }
                    }
                    DB::commit();
                    return JsonResponse::allResponse('success', Response::HTTP_OK, 'Product Added Successfully', route('admin.product.index'));
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

}
