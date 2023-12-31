<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>{{'試験予定'}}</h1>
        </div>
    </x-slot>

    <div class="text-center"  style="height: 70px;">
        @if(session('message'))
        <p  x-data="{ show: true }"
            x-show="show"
            x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="text-xl text-gray-600"
            style="padding-top: 2%;;">{{ session('message') }}</p>
        @endif
    </div>
    <form action="{{ route('admin.test_register') }}" method="POST" id="registerForm">
        @csrf
        <div class="edit_outer">
            <h1>試験予定 登録</h1>
            <div class="edit_box">
                <label>打設日</label>
                @error('make_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="date" name="make_day" value="{{ old('make_day')}}" id="make_day">
            </div>
            <div class="edit_box">
                <label>試験日</label>
                @error('test_day')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="date" name="test_day" value="{{ old('test_day')}}" id="test_day">
            </div>
            <div class="edit_box">
                <label>材齢(日)</label>
                @error('age')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="age" value="{{ old('age')}}" id="age" readonly>
            </div>
            <div class="edit_box">
                <label>配合</label>
                @error('type')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="type" value="{{ old('type')}}">
            </div>
            <div class="edit_box">
                <label>現場名</label>
                @error('site')
                <p class="error_msg">{{$message}}</p>
                @enderror
                <input type="text" name="site" value="{{ old('site')}}">
            </div>
            <div class="edit_box">
                <label>コメント(共有事項等あれば記載してください)</label>
                <textarea name="comment" cols="40" rows="10" >{{ old('comment') }}</textarea>
            </div>
            <div>
                <input type="hidden" name="author" value="{{ Auth::user()->name}}">
            </div>
            <div class="edit_btn">
                <a href="{{ route('admin.schedule') }}" class="edit__btn">戻る</a>
                <button type="button" onclick="return Register()" class="edit___btn">登録</button>
            </div>
        </div>

    </form>
    
</x-admin-layout>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="{{ asset('js/register.js') }}"></script>
