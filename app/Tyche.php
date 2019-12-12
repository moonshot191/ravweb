<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tyche extends Model
{
    protected $fillable = [ 'username','language','question','user_id','level','edited_by','validated','validated_by'];

}
