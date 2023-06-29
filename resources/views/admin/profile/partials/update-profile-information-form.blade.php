<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('アカウント編集') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("アカウントの名前とメールアドレスを変更します。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('氏名')" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" autofocus autocomplete="name" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" autocomplete="username" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('変更') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('登録情報を変更しました。') }}</p>
            @endif
        </div>
    </form>
</section>
