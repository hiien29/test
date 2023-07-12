<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use Illuminate\Http\Request;

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
        'result',
        'author',
        'tester',
        'editor' ,
        'test_editor',
        'comment'
    ];
    


    public function comment()
    {
    return $this->hasMany(Comment::class);
    }
    
    }




