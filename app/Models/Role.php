<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 *
 * @property $id
 * @property $name
 * @property $display_name
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Role extends Model
{

    static $rules = [
		'name' => 'required',
		'display_name' => 'required',
    ];



    protected $fillable = ['name','display_name'];



}
