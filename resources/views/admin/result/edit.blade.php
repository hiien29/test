<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>{{''}}</h1>
        </div>
    </x-slot>

    <form action="{{ route('admin.result_update', ['id'=>$params->id]) }}" method="POST">
        @csrf
        <div class="edit_outer">
            <h1>編集画面</h1>
            <div class="edit_box">
                <label>打設日</label>
                <input type="date" name="make_day" value="{{ old('make_day') ?? $params->make_day}}">
                @error('make_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>試験日</label>
                <input type="date" name="test_day" value="{{ old('test_day') ?? $params->test_day}}">
                @error('test_day')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>材齢(日)</label>
                <input type="text" name="age" value="{{ old('age') ?? $params->age}}">
                @error('age')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>配合</label>
                <input type="text" name="type" value="{{ old('type') ?? $params->type}}">
                @error('type')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>現場名</label>
                <input type="text" name="site" value="{{ old('site') ?? $params->site}}">
                @error('site')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label>試験結果(N/㎟)</label>
                <input type="text" name="result" value="{{ old('result') ?? $params->result}}">
                @error('result')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="edit_box">
                <label><i class="fa-duotone fa-asterisk"></i>コメント(編集理由、共有事項等記載してください)</label>
                <textarea name="comment" id="" cols="30" rows="10" >{{ old('comment') }}</textarea>
                @error('comment')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <input type="hidden" name="test_editor" value="{{ Auth::user()->name}}">
            </div>

            <div class="edit_btn">
                <a href="{{ route('admin.result') }}" class="edit__btn">戻る</a>
                <button type="submit" onclick="return confirm('変更しますか？')" class="edit___btn">変更</button>
            </div>
        </div>
    </form>

</x-admin-layout>