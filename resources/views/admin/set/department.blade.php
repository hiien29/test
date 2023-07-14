<x-admin-layout>
    <x-slot name="header">
        <h1>設定</h1>
    </x-slot>

    
    @include('admin.set.nav')

    <form method="post" action="{{ route('admin.departments.register') }}" class="mt-6 space-y-6">
        @csrf
        <div class="flex depart_register">
            <div>
                <x-input-label for="depart_name" :value="__('部署名')" />
                <x-input-error class="mt-2" :messages="$errors->get('depart_name')" />
                <x-text-input id="depart_name" name="depart_name" type="text" class="mt-1 block" value="{{ old('depart_name') }}" />
            </div>
            <div>
                <x-input-label for="number" :value="__('部署コード')" />
                <x-input-error class="mt-2" :messages="$errors->get('number')" />
                <x-text-input id="number" name="number" type="text" class="mt-1 block" value="{{ old('number') }}" />
            </div>
            <div class="depart_btn">
                <x-primary-button onclick="return confirm('追加しますか？')">{{ __('追加') }}</x-primary-button>
            </div>
        </div>
    
            
    
            @if(session('message'))
            <p class="text-lg text-gray-600 text-center" 
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ session('message') }}</p>
            @endif
            @if(session('message_'))
            <p class="text-lg text-gray-600 text-center"
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ session('message_') }}</p>
            @endif
        
    </form>

    <div class="log_outer">
        <table>
            <tr>
                <th class="th_4"></th>
                <th>部署コード</th>
                <th>部署名</th>
                <th class="th_4">削除</th>
            </tr>

            @foreach($departments as $department)
            <tr>
                <td>{{ $departments->firstItem() + $loop->index }}</td>
                <td>{{ $department->number }}</td>
                <td>{{ $department->name }}</td>
                <td><a href="{{ route('admin.departments.delete',['id'=>$department->id]) }}" onclick="return confirm('削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
            
        </table>
    </div>

    <div class="page">
        {{ $departments->links() }}
    </div>
    
</x-admin-layout>