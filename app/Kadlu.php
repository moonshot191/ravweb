<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadlu extends Model
{
    protected $fillable = [ 'filename','title','language','c_type','created_by','level','edited_by','validated','validated_by'];

}
