<x-admin-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="top"> 
                <div class="top_btn">
                    <a href="{{ route('admin.schedule') }}">試験予定</a>
                </div>
                <div class="top_btn">
                    <a href="{{ route('admin.test') }}">当日</a>
                </div>
                <div class="top_btn">
                    <a href="{{ route('admin.result') }}">試験結果</a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
