<x-admin-layout>
    <form action="{{ route('admin.result_register',['id'=>$data->id])}}" method="POST">
        @csrf
        <div>
            <p>打設日</p>
            <p>{{ $data->make_day}}</p>
        </div>
        <div>
            <p>試験日</p>
            <p>{{ $data->test_day}}</p>
        </div>
        <div>
            <p>材齢</p>
            <p>{{ $data->age}}</p>
        </div>
        <div>
            <p>配合</p>
            <p>{{ $data->type}}</p>
        </div>
        <div>
            <p>現場</p>
            <p>{{ $data->site}}</p>
        </div>
        <div>
            <label for="">試験結果</label>
            <input type="text" name="result" value="{{ old('result')}}">N/㎟
            @error('result')
            <p>{{$message}}</p>
            @enderror
        </div>
        <div>
            <input type="hidden" name="tester" value="{{ Auth::user()->name}}">
        </div>
        <div class="addbtn">
            <button type="submit" onclick="return confirm('登録しますか？')">登録</button>
        </div>
        <div>
            <a href="{{ route('admin.test') }}">戻る</a>
        </div>
    </form>
</x-admin-layout>