<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testlist extends Model
{
    use HasFactory;
    protected $table = 'testlists';

    protected $fillable =[
        'make_day',
        'test_day',
        'age',
        'type',
        'site',
        'author'
    ];
}
