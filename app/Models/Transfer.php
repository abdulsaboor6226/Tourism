<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Transfer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['vehicle_id','driver_id','passenger_id','from','to','departure_dateTime','reaching_dateTime','status_id'];

    protected $hidden = ['created_by', 'updated_by', 'deleted_by', 'created_at', 'updated_at', 'deleted_at'];


    protected static function boot()
    {

        parent::boot();

        if (Auth::check()){
            // updating created_by and updated_by when model is created
            static::creating(function ($model) {
                if (!$model->isDirty('created_by')) {
                    $model->created_by = auth()->user()->id;
                }
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            });

            // updating updated_by when model is updated
            static::updating(function ($model) {
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            });

            // deleting deleting_by when model is updated
            static::deleted(function ($model) {
                if (!$model->isDirty('deleted_by')) {
                    $model->deleted_by = auth()->user()->id;
                    $model->save();
                }
            });
        }
    }

    public function status(){
        return $this->belongsTo(Dictionary::class,'status_id')->withDefault(dictionaryDefault());
    }
    public function vehicle(){
        return $this->belongsTo(Vehicle::class,'vehicle_id')->withDefault(dictionaryDefault());
    }
    public function driver(){
        return $this->belongsTo(User::class,'driver_id')->withDefault(dictionaryDefault());
    }
    public function passenger(){
        return $this->belongsTo(User::class,'passenger_id')->withDefault(dictionaryDefault());
    }
}
