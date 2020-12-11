<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestHistory extends Model
{
    use HasFactory;

    protected $fillable = ['test_number', 'start_time', 'array_generation_time', 'query_execution_time', 'num_records'];
}
