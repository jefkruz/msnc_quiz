<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Rank extends Model
{

    static $rules = [
		'name' => 'required|unique:ranks',
		'display_name' => 'required|unique:ranks',
    ];


    protected $fillable = ['name','display_name'];



}
