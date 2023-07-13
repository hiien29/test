
<nav class="set_nuv">
    <div class="flex">
		<a href="{{ route('admin.user') }}" class="nav_list @if(request()->routeIs('admin.user')) active @endif">
			<i class="fa-solid fa-users text-gray-500" style="padding-right:1rem;"></i>
			ユーザー情報</a>
		<a href="{{ route('admin.admin') }}" class="nav_list @if(request()->routeIs('admin.admin')) active @endif"><i class="fa-solid fa-user text-gray-500" style="padding-right:1rem;"></i>管理者情報</a>
		<a href="{{ route('admin.department') }}" class="nav_list @if(request()->routeIs('admin.department')) active @endif"><i class="fa-solid fa-address-card text-gray-500" style="padding-right:1rem;"></i>部署コード</a>
		<a href="{{ route('admin.log') }}" class="nav_list @if(request()->routeIs('admin.log')) active @endif" :active="request()->routeIs('admin.log')"><i class="fa-solid fa-clock-rotate-left text-gray-500" style="padding-right:1rem;"></i>ログ</a>
	</div>
</nav>
