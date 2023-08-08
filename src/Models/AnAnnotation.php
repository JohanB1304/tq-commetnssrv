<?php

namespace App\Models;

use App\Http\Resources\AnnotationResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AnAnnotation extends Model
{
    use HasUuids;

    public $incrementing = false;

    protected $primaryKey = 'guid';

    protected $uuidFieldName = 'guid';

    protected bool $primaryKeyIsUuid = true;

    protected $table = 'an_annotations';

    protected $fillable=[
        "ref_id",
        "ref_entity",
        "user_id",
        "comment",
        "tenant_id",
        "created_by",
        "updated_by",
        "expired_by",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        // 'id' => EfficientUuid::class,
        // 'guid' => EfficientUuid::class,
        // 'sg_dossier_id' => EfficientUuid::class,
        // 'user_requester_id' => EfficientUuid::class,
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone('America/Bogota')
            ->toDateTimeString();
    }
    protected $hidden = [
        "tenant_id",
    ];

    public function user($userId)
    {
        // return $this->belongsTo(
        //     User::class,
        //     'user_id',
        // );
        $user = User::find($userId);
        if(is_null($user)){
            $user = User::whereUuid($userId)->first();
        }
        return $user;
    }

    public function readMessages(){
        return $this->hasMany(\App\Models\log_messages::class);
    }

    public function index($refId){
        $data = self::where('ref_id', $refId)
            ->select('guid as id', 'ref_id', 'user_id', 'comment', 'created_at', 'updated_at')
            ->get();
        $fieldName = config('annotation.author_field_name');
        $data->each(function($annotation) use($fieldName){
            $this->setAuthor($annotation, $fieldName);
        });
        $log = new AnLogMessages();
        $log->readMessages($refId, $data);
        return $data;
    }

    public function store($request, $refId){
        $annotation = self::create([
            "ref_id" => $refId,
            "user_id" => Auth::id(),
            "comment" => $request->comment,
        ]);
        $log = new AnLogMessages();
        $log->store($refId, $annotation);
        $annotation = self::where('guid',$annotation->guid)
            ->select('guid as id', 'ref_id', 'user_id', 'comment', 'created_at', 'updated_at')
            ->first();
        $fieldName = config('annotation.author_field_name');
        $this->setAuthor($annotation, $fieldName);
        return $annotation;
    }

    public function getTotalUnread($refId){
        $readMessages = AnLogMessages::where('ref_id', $refId)
            ->where("user_id", Auth::id())
            ->get();

        if(count($readMessages)>0){
            $readMessages = $readMessages->map(function ($message) {
                return [$message->getRawOriginal('annotation_id')];
            });
        }else{
            $readMessages = [];
        }

        return AnAnnotation::where('ref_id', $refId)
            ->whereNotIn('guid', $readMessages)
            ->count();
    }

    public function setAuthor($annotation, $fieldName){
        $user = $annotation->user($annotation->user_id);
        $annotation ['author'] = is_null($user)?(null):($user->full_name);
    }
}
