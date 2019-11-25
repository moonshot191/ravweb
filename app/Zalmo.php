<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zalmo extends Model
{
    protected $fillable = [ 'username','bot','language','answer','file','level','edited_by','validated','validated_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
