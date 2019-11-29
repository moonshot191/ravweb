<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Africa extends Model
{
    protected $fillable = [ 'username','bot','language','answer','question','user_id','level','edited_by','validated','validated_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

