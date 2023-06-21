<x-guest-layout>

    <div class="backtop">
        <a href="{{ route('admin.login') }}">管理者の方はこちら</a>
    </div>
    <div class="backtop" style="margin-bottom: 30px">
        <a href="{{ route("login") }}">従業員の方はこちら</a>
    </div>
        
</x-guest-layout>