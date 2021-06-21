<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila_basic_info extends Model
{
    use HasFactory;
    protected $table = 'upazila_basic_info';

    public function data_exist(){
      return   $query  = Upazila_basic_info::count();
    }
}
