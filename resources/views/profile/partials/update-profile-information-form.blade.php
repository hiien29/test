<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('アカウント編集') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("アカウントの名前とメールアドレスを変更します。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
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

            {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif --}}
        </div>

        <div>
            <x-input-label for="name" :value="__('部署コード')" />
            <x-input-error class="mt-2" :messages="$errors->get('department_number')" />
            <x-text-input id="department_number" name="department_number" type="text" class="mt-1 block w-full" :value="old('department_number', $user->department_number)" autofocus  />
        </div>
        <div>
            <x-input-label for="name" :value="__('部署名')" />
            <p style="padding-top: 1%;font-size:1.1rem;">{{ $department }}</p>
            {{-- <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" :value="$department" autofocus readonly /> --}}
        </div>

        {{-- <div>{{ $department->name}}</div> --}}

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('変更') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('変更しました。') }}</p>
            @endif
        </div>
    </form>
</section>
