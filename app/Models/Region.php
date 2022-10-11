<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Region extends Model
{

    static $rules = [
		'name' => 'required|unique:regions',

    ];

    protected $perPage = 20;


    protected $fillable = ['name'];



}
