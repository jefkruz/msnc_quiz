<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Essay
 *
 * @property $id
 * @property $essay
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Essay extends Model
{
    
    static $rules = [
		'essay' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['essay'];



}
