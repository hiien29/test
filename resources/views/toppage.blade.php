<x-guest-layout>

    <div class="text-center">
        <a href="{{ route('admin.login') }}">管理者の方はこちら</a>
    </div>
    <div class="text-center mt-10">
        <a href="{{ route("login") }}">従業員の方はこちら</a>
    </div>
        
</x-guest-layout>