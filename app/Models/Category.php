<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    static $rules = [
		'name' => 'required',
    ];

    protected $perPage = 20;

  protected $table = 'categories';
    protected $fillable = ['name'];



}
