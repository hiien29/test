<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';

    protected $fillable =[
        'testlist_id',
        'result'
    ];

    public function testlist()
    {
    return $this->belongsTo(Testlist::class, 'testlist_id');
    }

}
