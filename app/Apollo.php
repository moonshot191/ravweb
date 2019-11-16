<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apollo extends Model
{
    protected $fillable = ['user_id', 'username','bot','question','answer','status','group_id','message_id','level','edited_by','validated','validated_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
