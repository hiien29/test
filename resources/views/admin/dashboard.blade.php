<x-admin-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('ああ') }}
        </h2> --}}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main">   <!-- .mainで背景白にしてるよーー -->
                <a href="{{ route('admin.schedule') }}">試験予定</a>
                <a href="{{ route('admin.test') }}">当日</a>
                <a href="{{ route('admin.result') }}">試験結果</a>
            </div>
        </div>
    </div>
</x-admin-layout>
