<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walaq extends Model
{

    protected $fillable = [ 'wala_id','question','answer_a','answer_b','answer_c','answer_d','c_answer','created_by','edited_by','validated','validated_by'];


    public function wala(){
        return $this->belongsTo(Wala::class);
    }
}
