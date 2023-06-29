<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('パスワードの変更') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('安全性の高いパスワードを設定してください。') }}
        </p>
    </header>

    <form method="post" action="{{ route('admin.password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('現在のパスワード')" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        </div>

        <div>
            <x-input-label for="password" :value="__('新しいパスワード')" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('新しいパスワード（確認用）')" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('変更') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('パスワードを変更しました。') }}</p>
            @endif
        </div>
    </form>
</section>
