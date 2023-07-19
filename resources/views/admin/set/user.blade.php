<x-admin-layout>
    <x-slot name="header">
        <h1>設定</h1>
    </x-slot>

    
    @include('admin.set.nav')

    @if(session('message'))
            <p class="text-lg text-gray-600 text-center mt-6"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)">{{ session('message') }}</p>
    @endif

    <div class="log_outer">
        <table>
            <tr>
                <th></th>
                <th>ユーザー名</th>
                <th>メールアドレス</th>
                <th>部署コード</th>
                <th>部署名</th>
                <th>削除</th>
            </tr>

            @foreach($users as $user)
            <tr>
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->department_number }}</td>
                <td>{{ $user->department_name }}</td>
                <td><a href="#" data-url="{{ route('admin.user_delete', ['id'=>$user->id]) }}"  onclick="return Delete(this)"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>
    
</x-admin-layout>
