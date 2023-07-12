<?php
namespace TqCommentssrv\TqCommentssrv\Http\Controllers;

use App\Models\AnAnnotation;
use Illuminate\Http\Request;

class AnnotationsController
{
    public function index(Request $request, $prefix, $refId)
    {
        try{
            $annotation = new AnAnnotation();
            $data = $annotation->index($refId);
            return response()->json([
                'data' => $data,
                'status_code' => '200',
                'message' => 'ok'
            ]);
        }catch(Throwable $e){
            return response()->json([
                'status_code' => '400',
                'message' => 'Bad request'
            ],400);
        }
        
    }

    public function getTotal($prefix, $refId)
    {
        $log = new AnAnnotation();
        $total = $log->getTotalUnread($refId);
        return response()->json([
            'total' => $total,
            'status_code' => '200',
            'message' => 'ok'
        ]);
    }

    public function store(Request $request ,$prefix, $refId)
    {
        $comment = json_decode($request->getContent());
        $annotation = new AnAnnotation();
        $newAnnotation = $annotation->store($comment, $refId);
        return response()->json([
            'data' => $newAnnotation,
            'status_code' => '200',
            'message' => 'Comentario creado correctamente'
        ]);
    }
}
