<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Zone extends Model
{


    static $rules = [
		'region_id' => 'required',
		'name' => 'required|unique:zones',
    ];

    protected $perPage = 20;


    protected $guarded;

    public function region()
    {
        return $this
            ->Belongsto(Region::class, 'region_id');
    }

}
