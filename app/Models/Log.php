<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'logs';

    protected $fillable =[
        'action',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function testlist()
    {
        return $this->belongsTo('App\Models\Testlist');
    }
}




