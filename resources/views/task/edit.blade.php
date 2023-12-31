<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <form action="{{ route('task_update', ['id'=>$params->id]) }}" method="POST" id="updateForm">
        @csrf
        <div class="edit_outer">
            <h1>編集画面</h1>
            <div class="edit_box">
                <label class="test_id">試験ID : {{$params->id}}</label>
            </div>
            <div class="edit_box">
                <label>打設日</label>
                @error('make_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="date" name="make_day" value="{{ old('make_day') ?? $params->make_day}}" id="make_day">
            </div>
            <div class="edit_box">
                <label>試験日</label>
                @error('test_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="date" name="test_day" value="{{ old('test_day') ?? $params->test_day}}" id="test_day">
            </div>
            <div class="edit_box">
                <label>材齢(日)</label>
                @error('age')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="age" value="{{ old('age') ?? $params->age}}" id="age" readonly>
            </div>
            <div class="edit_box">
                <label>配合</label>
                @error('type')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="type" value="{{ old('type') ?? $params->type}}">
            </div>
            <div class="edit_box">
                <label>現場名</label>
                @error('site')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="site" value="{{ old('site') ?? $params->site}}">
            </div>
            <div class="edit_box">
                <label><i class="fa-duotone fa-asterisk"></i>コメント(編集理由、共有事項等記載してください)</label>
                @error('comment')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <textarea name="comment" id="" cols="30" rows="10" >{{ old('comment') }}</textarea>
            </div>
            
            <input type="hidden" name="editor" value="{{ Auth::user()->name }}">
            <input type="hidden" name="url" value="{{ $url }}">
            
            <div class="edit_btn">
                <a href="#" onclick="history.back()" class="edit__btn">戻る</a>
                <button type="button" onclick="return Update()" class="edit___btn">変更</button>
            </div>
            
        </div>
    </form>

</x-app-layout>
<script src="{{ asset('js/register.js') }}"></script>