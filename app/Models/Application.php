<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $hidden = ['correct_answers'];

    public function exam()
    {
        return $this
            ->Belongsto(Applicant::class, 'applicant_id');
    }
}
