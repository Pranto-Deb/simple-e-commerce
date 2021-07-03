<?php
namespace App\Traits;

use Illuminate\Http\Response;

trait JsonResponse
{
    public static function allResponse($status='success', $code=200, $message='', $url='', $data=[])
    {
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'message'=>$message,
            'url'=>$url,
            'data'=>$data,
        ]);
    }

    public static function singleResponse($status='success',$code=200, $message='', $data=[])
    {
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'message'=>$message,
            'data'=>$data
        ]);
    }

    public static function collectionResponse($status='success', $code=200, $collection=[])
    {
        return response()->json([
            'status'=>$status,
            'code'=>$code,
            'data'=>$collection
        ]);
    }

    public static function validationResponse($errors=[])
    {
        $message = '';
        foreach ($errors as $error){
            if(!empty($error)){
                foreach ($error as $item){
                    $message .= $item.' ';
                }
            }
        }

        return response()->json([
            'status'=>'validation',
            'code'=>Response::HTTP_BAD_REQUEST,
            'message'=> ($message != null)? $message : 'Invalid Data',
        ]);
    }
}
