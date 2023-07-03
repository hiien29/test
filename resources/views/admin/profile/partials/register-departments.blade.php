<header>
    <h2 class="text-lg font-medium text-gray-900">
        {{ __('部署一覧') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        {{ __("部署名、を追加削除いたします。") }}
    </p>
</header>

{{-- <form id="send-verification" method="post" action="{{ route('admin.verification.send') }}">
    @csrf
</form> --}}

<form method="post" action="{{ route('admin.departments.register') }}" class="mt-6 space-y-6">
    @csrf

    <div>
        <x-input-label for="depart_name" :value="__('部署名')" />
        <x-input-error class="mt-2" :messages="$errors->get('depart_name')" />
        <x-text-input id="depart_name" name="depart_name" type="text" class="mt-1 block w-full" />
    </div>
    <div>
        <x-input-label for="depart_number" :value="__('部署コード')" />
        <x-input-error class="mt-2" :messages="$errors->get('depart_number')" />
        <x-text-input id="depart_number" name="depart_number" type="text" class="mt-1 block w-full"  />
    </div>


    <div class="flex items-center gap-4">
        <x-primary-button onclick="return confirm('追加しますか？')">{{ __('追加') }}</x-primary-button>

        @if(session('message'))
        <p class="text-sm text-gray-600"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ session('message') }}</p>
        @endif
        @if(session('message_'))
        <p class="text-sm text-gray-600"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600">{{ session('message_') }}</p>
        @endif
    </div>
</form>

<div class="mt-6">【部署一覧】</div>
<div class="flex flex-wrap">
    @foreach ($departments as $department)
    <div class="flex mt-2">
        <p class="p-1">{{ $department->name }}</p>
        <p class="p-1">{{ $department->number }}</p>
        <a href="{{ route('admin.departments.delete',['id'=>$department->id]) }}" onclick="return confirm('削除しますか？')"
            class="block bg-red-500 text-white rounded-md p-1 mr-2">削除</a></p>
    </div>
@endforeach
</div>
