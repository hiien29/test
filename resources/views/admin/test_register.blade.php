<x-admin-layout>
    <x-slot name="header">
        <p>テスト追加</p>
    </x-slot>

    <form action="{{ route('admin.test_register') }}" method="POST">
        @csrf
        <div class="main">
            <div>
                <label for="">打設日</label>
                <input type="date" name="make_day" value="{{ old('make_day')}}">
                @error('make_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">試験日</label>
                <input type="date" name="test_day" value="{{ old('test_day')}}">
                @error('test_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">材齢</label>
                <input type="text" name="age" value="{{ old('age')}}">日
                @error('age')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">配合</label>
                <input type="text" name="type" value="{{ old('type')}}">
                @error('type')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">現場名</label>
                <input type="text" name="site" value="{{ old('site')}}">
                @error('site')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">作成者</label>
                <input type="text" name="author" value="{{ old('author')}}">
                @error('author')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="addbtn">
                <button type="submit">登録</button>
            </div>
        </div>

    </form>
    
</x-admin-layout>

<script src="{{ asset('/js/hoge.js') }}"></script>