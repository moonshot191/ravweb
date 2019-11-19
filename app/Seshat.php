<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seshat extends Model
{
    protected $fillable = [ 'username','bot','question','answer','img_path','level','edited_by','validated','validated_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
