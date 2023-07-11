<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;

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
    

    public function logs()
    {
    return $this->hasMany('App\Models\Log');
    }
    
    protected static function boot()
    {
        parent::boot();

        self::created(function ($testlist) {
            $log = [
                'user_id' => Auth::id(),
                'testlist_id' => $testlist->id,
                'action' => '作成',
                'description' => '試験ID:' . $testlist->id.'を作成しました。'
            ];

            Log::create($log);
            // $log = new Log();
            // $log->user_id = Auth::id();
            // $log->testlist_id = $testlist->id;
            // $log->action = '作成';
            // $log->description = '試験ID:' . $testlist->id.'を作成しました。';
            // $log->save();
        });

        // self::deleting(function ($testlist) {
        //     $log = new Log();
        //     $log->user_id = Auth::id();
        //     $log->testlist_id = $testlist->id;
        //     $log->action = '削除';
        //     $log->description = '試験ID:' . $testlist->id.'を削除しました。';
        //     $log->save();
        // });
    }



}
