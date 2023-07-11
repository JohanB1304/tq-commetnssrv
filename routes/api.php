<?php
use App\Http\Controllers\AnnotationController;

Route::prefix('api/{slugTenant}/annotation/')->middleware('verifyJwt')->group(function(){
    Route::get('{ref_id}',[TqCommentssrv\TqCommentssrv\Http\Controllers\AnnotationsController::class, 'index']);
    Route::post('{ref_id}',[TqCommentssrv\TqCommentssrv\Http\Controllers\AnnotationsController::class, 'store']);
    Route::get('{ref_id}/get_qty_messages_unread',[TqCommentssrv\TqCommentssrv\Http\Controllers\AnnotationsController::class, 'getTotal']);
});