<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leizi extends Model
{
    protected $fillable = [ 'username','instruction','question','answer','alternative','level','edited_by','validated','validated_by'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
