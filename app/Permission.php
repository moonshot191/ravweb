<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_apollo',
            'add_apollo',
            'edit_apollo',
            'delete_apollo',

            'view_apollos',
            'add_apollos',
            'edit_apollos',
            'delete_apollos',

            'view_africas',
            'add_africas',
            'edit_africas',
            'delete_africas',

            'view_gaias',
            'add_gaias',
            'edit_gaias',
            'delete_gaias',

            'view_kadlus',
            'add_kadlus',
            'edit_kadlus',
            'delete_kadlus',

            'view_leizis',
            'add_leizis',
            'edit_leizis',
            'delete_leizis',

            'view_nuwas',
            'add_nuwas',
            'edit_nuwas',
            'delete_nuwas',

            'view_odins',
            'add_odins',
            'edit_odins',
            'delete_odins',

            'view_seshats',
            'add_seshats',
            'edit_seshats',
            'delete_seshats',

            'view_tyches',
            'add_tyches',
            'edit_tyches',
            'delete_tyches',

            'view_walas',
            'add_walas',
            'edit_walas',
            'delete_walas',

            'view_kadluqs',
            'add_kadluqs',
            'edit_kadluqs',
            'delete_kadluqs',

            'view_walaqs',
            'add_walaqs',
            'edit_walaqs',
            'delete_walaqs',

            'view_zalmos',
            'add_zalmos',
            'edit_zalmos',
            'delete_zalmos'
        ];
    }
}
