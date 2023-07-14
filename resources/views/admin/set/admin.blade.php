<x-admin-layout>
    <x-slot name="header">
        <h1>設定</h1>
    </x-slot>

    
    @include('admin.set.nav')

    <form method="post" action="{{ route('admin.admin.register') }}" class="mt-6 space-y-6">
        @csrf
    
        <div class="admin_register">
            <div class=>
                <x-input-label for="name" :value="__('管理者名')" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block admin_input" />
            </div>
            <div>
                <x-input-label for="email" :value="__('メールアドレス')" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block admin_input"  />
            </div>
            <div>
                <x-input-label for="password" :value="__('パスワード')" />
                <x-input-error class="mt-2" :messages="$errors->get('password')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block admin_input"  />
            </div>
            <div>
                <x-input-label for="password_confirmation" :value="__('パスワード（確認用）')" />
                <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block admin_input"  />
            </div>
            <div class="admin_btn">
                <x-primary-button onclick="return confirm('追加しますか？')">{{ __('追加') }}</x-primary-button>
            </div>
        </div>
    
            @if(session('message__'))
            <p class="text-lg text-gray-600 text-center"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ session('message__') }}</p>
            @endif
            @if(session('message___'))
            <p class="text-lg text-gray-600 text-center"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ session('message___') }}</p>
            @endif

    </form>

    <div class="log_outer">
        <table>
            <tr>
                <th></th>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                {{-- <th>削除</th> --}}
            </tr>

            @foreach($admins as $admin)
            <tr>
                <td>{{ $admins->firstItem() + $loop->index }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                {{-- <td><a href="{{ route('admin.admin.delete',['id'=>$admin->id]) }}" onclick="return confirm('削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td> --}}
            </tr>
            @endforeach
            
        </table>
    </div>
    
</x-admin-layout>