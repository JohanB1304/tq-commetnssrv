<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogMessages extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $primaryKey = 'guid';

    protected $uuidFieldName = 'guid';

    protected bool $primaryKeyIsUuid = true;

    protected $table = 'an_log_messages';

    protected $fillable = [
        "annotation_id",
        "ref_id",
        "user_id",
        "status",
        "tenant_id"
    ];

    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($model){
        //     $model->tenant_id = Auth::user()->tenant_id;
        // });
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            "user_id",
        );
    }

    public function refEntity()
    {
        return $this->belongsTo(
            config('annotation.ref_entity'),
            "ref_id",
        );
    }

    public function annotation()
    {
        return $this->belongsTo(
            Annotation::class,
            "annotation_id",
        );
    }

    public function store($refId, $annotation){
        self::create([
            "user_id" => Auth::id(),
            "ref_id" => $refId,
            "annotation_id" => $annotation->guid,
            "status" => "active",
        ]);
    }

    public function readMessages($refId, $data){
        $messages = self::latest()
            ->where("user_id", Auth::id())
            ->where("ref_id", $refId)
            ->get();
        $log_message_ids = $messages->map(function ($message) {
            return [$message->getRawOriginal('guid')];
        });
        self::whereIn('guid', $log_message_ids)
            ->delete();
        foreach ($data as $annotation) {
            self::create([
                "user_id" => is_null(Auth::user())?null:Auth::id(),
                "ref_id" => $refId,
                "annotation_id" => is_null($annotation->guid)?$annotation->id:$annotation->guid,
                "status" => "active",
            ]);
        }
    }
}
