<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wala extends Model
{
    protected $fillable = [ 'title','language','question','created_by','level','edited_by','validated','validated_by'];

}
