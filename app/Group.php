<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use Notifiable;
    protected $fillable = [
        'group_id', 'group_title', 'group_language','group_admin','token',
    ];
}
