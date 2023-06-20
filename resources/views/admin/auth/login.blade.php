
<x-guest-layout>
    {{-- <img src={{ asset('img/login.jpg') }} alt=""> --}}
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

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        {{-- <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 mt-10 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('パスワードを忘れた方はこちら') }}
                </a>
            @endif
        </div> --}}
        <div class="btn">
            {{-- <x-primary-button class="ml-3">
                {{ __('ログイン') }}
            </x-primary-button> --}}
            <button type="submit" class="btn_">ログイン</button>
        </div>
        <div class="pass">
        {{-- "flex items-center justify-end mt-4" --}}
            @if (Route::has('admin.password.request'))
                <a class="underline text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('admin.password.request') }}">
                    {{ __('パスワードを忘れた方はこちら') }}
                </a>
            @endif
        </div>
    </form>

    <p class="line"></p>

    <div class="btn__">
        <p>アカウントをお持ちでない方はこちら</p>
        <a href="{{ route('register')}}">新規登録</a>
    </div>


</x-guest-layout>
