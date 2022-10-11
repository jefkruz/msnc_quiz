<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Applicant extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded;


    static $rules = [
        'name' => 'required',
        'rank_id' => 'required',
        'phone' => 'required',
        'church' => 'required',
        'zone' => 'required',
        'region' => 'required',
        'department' => 'required',
        'job' => 'required',
        'email' => 'required|email|unique:applicants',
    ];
    public function ranks()
    {
        return $this
            ->Belongsto(Rank::class, 'rank_id');
    }



    public function roles()
    {
        return $this
            ->Belongsto(Role::class, 'role_id');
    }

    public function zones()
    {
        return $this
            ->Belongsto(Zone::class, 'zone');
    }

    public function regions()
    {
        return $this
            ->Belongsto(Region::class, 'region');
    }


    public function jobs()
    {
        return $this
            ->Belongsto(Job::class, 'job');
    }


    public function departments()
    {
        return $this
            ->Belongsto(Department::class, 'department');
    }

}
