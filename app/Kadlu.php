<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadlu extends Model
{
    protected $fillable = [ 'filename','title','language','c_type','created_by','level','edited_by','validated','validated_by'];


    public function kadluq(){
        return $this->hasMany(Kadluq::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($question){
            $question->kadluq()->delete();
        });
    }


}


