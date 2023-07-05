<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('管理者一覧') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("管理者アカウントを追加･削除します。") }}
    </p>
</header>

{{-- <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
    @csrf
</form> --}}

<form method="post" action="{{ route('admin.admin.register') }}" class="mt-6 space-y-6">
    @csrf

    <div>
        <x-input-label for="name" :value="__('管理者名')" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" />
    </div>
    <div>
        <x-input-label for="email" :value="__('メールアドレス')" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"  />
    </div>
    <div>
        <x-input-label for="password" :value="__('パスワード')" />
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"  />
    </div>
    <div>
        <x-input-label for="password_confirmation" :value="__('パスワード（確認用）')" />
        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full"  />
    </div>


    <div class="flex items-center gap-4">
        <x-primary-button onclick="return confirm('追加しますか？')">{{ __('追加') }}</x-primary-button>

        @if(session('message__'))
        <p class="text-sm text-gray-600"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ session('message__') }}</p>
        @endif
        @if(session('message___'))
        <p class="text-sm text-gray-600"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ session('message___') }}</p>
        @endif
    </div>
</form>

<div class="mt-6">【管理者一覧】</div>
<div class="flex flex-wrap">
    @foreach ($admins as $admin)
    <div class="flex mt-2">
        <p class="p-1">{{ $admin->name }}</p>
        <p class="p-1">{{ $admin->email }}</p>
        <a href="{{ route('admin.admin.delete',['id'=>$admin->id]) }}" onclick="return confirm('削除しますか？')"
            class="block bg-red-500 text-white rounded-md p-1 mr-2">削除</a></p>
    </div>
@endforeach
</div>