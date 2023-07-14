<x-admin-layout>
    <x-slot name="header">
    </x-slot>
    
    <form action="{{ route('admin.task_register',['id'=>$data->id])}}" method="POST">
        @csrf
        <div class="edit_outer">
            <h1>試験結果 登録</h1>
            <div class="edit_box">
                <p>試験ID：{{ $data->id }}</p>
            </div>
            <div class="edit_box">
                <p>打設日：{{ $data->make_day}}</p>
            </div>
            <div class="edit_box">
                <p>試験日：{{ $data->test_day}}</p>
            </div>
            <div class="edit_box">
                <p>材齢：{{ $data->age}}</p>
            </div>
            <div class="edit_box">
                <p>配合：{{ $data->type}}</p>
            </div class="edit_box">
            <div class="edit_box">
                <p>現場：{{ $data->site}}</p>
            </div>
            <div class="edit_box">
                <p class="indent_">共有事項：</p>
                @foreach ($comments as $comment)
                <p class="indent_  comment_user">{{ $comment->enterer }}（{{ date('Y/m/d H:i',strtotime($comment->created_at)) }}）</p>
                <p class="indent_ comment_detail">{{ $comment->comment }}</p>
                @endforeach
            </div>
            <div class="edit_box">
                <label>試験結果(N/㎟)</label>
                @error('result')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="result" value="{{ old('result')}}">
            </div>
            <div class="edit_box">
                <label>コメント(任意)</label>
                @error('comment')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <textarea name="comment" cols="40" rows="10" >{{ old('comment') }}</textarea>
            </div>
            
                <input type="hidden" name="tester" value="{{ Auth::user()->name}}">
                <input type="hidden" name="url" value="{{ $url }}">
            
            <div class="edit_btn">
                <a href="#" onclick="history.back()" class="edit__btn">戻る</a>
                <button type="submit" onclick="return confirm('登録しますか？')" class="edit___btn">登録</button>
            </div>
        </div>
    </form>
</x-admin-layout>