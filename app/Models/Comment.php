<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    protected $fillable =[
        'testlist_id',    
        'enterer',
        'comment'
    ];


    public function testlist()
    {
        return $this->belongsTo(Testlist::class);
    }
}