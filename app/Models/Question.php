<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *

 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Question extends Model
{

    static $rules = [
		'category_id' => 'required',
		'question' => 'required',
		'options' => 'required',
		'answer' => 'required',
    ];

    protected $hidden = ['answer'];
    public function levels()
    {
        return $this
            ->Belongsto(Rank::class, 'rank_id');
    }

    public function cats()
    {
        return $this
            ->Belongsto(Category::class, 'category_id');
    }
   protected $guarded;

}
