<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $attributes;

    protected $fillable = [
        'firstname', 
        'lastname',
        'company',
        'email',
        'phone'
    ];

    // public function getFullname()
    // {
    //     return $this->firstname.' '.$this->lastname;
    // }
}
