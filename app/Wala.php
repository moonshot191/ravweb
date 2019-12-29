<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wala extends Model
{
    protected $fillable = [ 'title','language','question','created_by','level','edited_by','validated','validated_by'];


    public function sub_question(){
        return $this->hasMany(Walaq::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($question){
            $question->sub_question()->delete();
        });
    }


}
