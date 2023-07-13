<x-admin-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="top"> 
                <a href="{{ route('admin.schedule') }}" class="top_btn">試験予定</a>
                <a href="{{ route('admin.test') }}" class="top_btn">当日</a>
                <a href="{{ route('admin.result') }}" class="top_btn">試験結果</a>
                <a href="{{ route('admin.set') }}" class="top_btn">設定</a>
            </div>
        </div>
    </div>
</x-admin-layout>
