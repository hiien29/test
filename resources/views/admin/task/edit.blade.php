<x-admin-layout>

    <form action="{{ route('admin.task_update', ['id'=>$params->id]) }}" method="POST">
        @csrf
        <div class="main">
            <div>
                <label for="">打設日</label>
                <input type="date" name="make_day" value="{{ old('make_day') ?? $params->make_day}}">
                @error('make_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">試験日</label>
                <input type="date" name="test_day" value="{{ old('test_day') ?? $params->test_day}}">
                @error('test_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">材齢</label>
                <input type="text" name="age" value="{{ old('age') ?? $params->age}}">日
                @error('age')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">配合</label>
                <input type="text" name="type" value="{{ old('type') ?? $params->type}}">
                @error('type')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">現場名</label>
                <input type="text" name="site" value="{{ old('site') ?? $params->site}}">
                @error('site')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="">コメント</label>
                <textarea name="comment" id="" cols="30" rows="10" >{{ old('comment') ?? $params->comment}}</textarea>
                @error('comment')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="editor" value="{{ Auth::user()->name}}">
            </div>
            <div>
                <button type="submit" onclick="return confirm('変更しますか？')">変更</button>
            </div>
            <div>
                <a href="{{ route('admin.test') }}">戻る</a>
            </div>
        </div>
    </form>

</x-admin-layout>