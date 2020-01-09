<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nuwa extends Model
{
    protected $fillable = [ 'username','language','answer','level','edited_by','validated','validated_by'];

}
