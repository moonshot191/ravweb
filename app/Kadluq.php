<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadluq extends Model
{
    protected $fillable = [ 'kadlu_id','question','answer_a','answer_b','answer_c','answer_d','c_answer','created_by','edited_by','validated','validated_by'];


    public function kadlu(){
        return $this->belongsTo(Kadlu::class);
    }
}
