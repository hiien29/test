
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" class="mt-10"/>
            <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" class="mt-10" />

            <x-text-input id="password" class="block mt-2 w-full"
                            type="password"
                            name="password"
                            autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="btn">
            <button type="submit" class="btn_">ログイン</button>
        </div>

        <div class="pass">
            @if (Route::has('admin.password.request'))
                <a class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.password.request') }}">
                    {{ __('パスワードを忘れた方はこちら') }}
                </a>
            @endif
        </div>
    </form>

    <div class="backtop">
        <a href="{{ route('toppage') }}">←戻る</a>
    </div>

</x-guest-layout>
