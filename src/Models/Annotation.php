<?php

namespace App\Models;

use App\Http\Resources\AnnotationResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Annotation extends Model
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

    // protected static function boot()
    // {
    //     parent::boot();

    //     self::observe(ModelObserver::class);
    // }

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
        $data = self::where('ref_id', $refId)->get();
        $data->each(function($annotation){
            $annotation ['author'] = $annotation->user($annotation->id);
        });
        $log = new LogMessages();
        $log->readMessages($refId, $data);
        return $data;
    }

    public function store($request, $refId){
        $annotation = self::create([
            "ref_id" => $refId,
            "user_id" => Auth::id(),
            "comment" => $request->comment,
        ]);
        $log = new LogMessages();
        $log->readMessage($refId, $annotation);
        return (AnnotationResource::make($annotation))->additional([
            'status_code' => '200',
            'message' => 'Comentario creado correctamente'
        ]);
    }

    public function getTotalUnread($refId){
        $readMessages = LogMessages::where('ref_id', $refId)
            ->where("user_id", Auth::id())
            ->get();

        if(count($readMessages)>0){
            $readMessages = $readMessages->map(function ($message) {
                return [$message->getRawOriginal('annotation_id')];
            });
        }else{
            $readMessages = [];
        }

        return Annotation::where('ref_id', $refId)
            ->whereNotIn('guid', $readMessages)
            ->count();
    }
}
