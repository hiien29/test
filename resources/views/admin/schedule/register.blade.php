<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>{{''}}</h1>
        </div>
    </x-slot>

    <form action="{{ route('admin.test_register') }}" method="POST">
        @csrf
        <div class="edit_outer">
            <h1>テスト追加画面</h1>
            <div class="edit_box">
                <label>打設日</label>
                <input type="date" name="make_day" value="{{ old('make_day')}}">
                @error('make_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>試験日</label>
                <input type="date" name="test_day" value="{{ old('test_day')}}">
                @error('test_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>材齢(日)</label>
                <input type="text" name="age" value="{{ old('age')}}">
                @error('age')
                <p class="error_msg">{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>配合</label>
                <input type="text" name="type" value="{{ old('type')}}">
                @error('type')
                <p class="error_msg">{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>現場名</label>
                <input type="text" name="site" value="{{ old('site')}}">
                @error('site')
                <p  class="error_msg">{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>コメント(共有事項等あれば記載してください)</label>
                <textarea name="comment" cols="40" rows="10" >{{ old('comment') }}</textarea>
                @error('comment')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="author" value="{{ Auth::user()->name}}">
            </div>
            <div class="edit_btn">
                <a href="{{ route('admin.schedule') }}" class="edit__btn">戻る</a>
                <button type="submit" onclick="return confirm('登録しますか？')" class="edit___btn">登録</button>
            </div>
        </div>

    </form>
    
</x-admin-layout>

{{-- <script src="{{ asset('/js/hoge.js') }}"></script> --}}