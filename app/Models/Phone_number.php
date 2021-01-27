<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone_number extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','phone_number'];
    protected $table = 'table_phone_number';
}
