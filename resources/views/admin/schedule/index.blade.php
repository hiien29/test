<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験予定</h1>
        </div>
    </x-slot>

    
    <div style="width: 85%;margin: 5% auto 0;">
        <p class="addbtn"><a href="{{ route('admin.testregister') }}">予定追加<i class="fa-solid fa-plus add"></i></a></p>
    </div>
    <div style="width: 85%; margin: 0 auto;">
        <p style="text-align: right">全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
    </div>
    <div class="table_outer">
        <table class="table">
            <tr>
                <th>試験ID</th>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th>材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_2">現場名</th>
                <th>詳細</th>
                <th>編集</th>
                <th>削除</th>
                {{-- <th><a href="{{ route('admin.testregister') }}"><i class="fa-solid fa-plus add"></i></a></th> --}}
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->id }}</td>
                <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td><a href="{{ route('admin.detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                <td><a href="{{ route('admin.edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('admin.delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="page">
        {{ $params->links() }}
    </div>
</x-admin-layout>
<a href="#_" class="relative inline-block text-lg group">
    <span class="relative z-10 block px-5 py-3 overflow-hidden font-medium leading-tight text-gray-800 transition-colors duration-300 ease-out border-2 border-gray-900 rounded-lg group-hover:text-white">
    <span class="absolute inset-0 w-full h-full px-5 py-3 rounded-lg bg-gray-50"></span>
    <span class="absolute left-0 w-48 h-48 -ml-2 transition-all duration-300 origin-top-right -rotate-90 -translate-x-full translate-y-12 bg-gray-900 group-hover:-rotate-180 ease"></span>
    <span class="relative">Button Text</span>
    </span>
    <span class="absolute bottom-0 right-0 w-full h-12 -mb-1 -mr-1 transition-all duration-200 ease-linear bg-gray-900 rounded-lg group-hover:mb-0 group-hover:mr-0" data-rounded="rounded-lg"></span>
    </a>