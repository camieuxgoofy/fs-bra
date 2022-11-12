<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['no_hp', 'instagram', 'facebook', 'email', 'location'];
    public $timestamps = false;
}
