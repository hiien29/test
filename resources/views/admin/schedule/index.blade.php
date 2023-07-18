<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験予定</h1>
        </div>
    </x-slot>

    
    <div style="width: 85%;margin: 5% auto 0;">
        <p class="addbtn"><a href="{{ route('admin.testregister') }}">予定追加<i class="fa-solid fa-plus add"></i></a></p>
    </div>



    <div style="width: 85%; margin: 2% auto 0; flex" class="flex justify-between items-end">
        <form action="{{ route('admin.schedule') }}" method="GET">
            <p style="font-size: .9rem;">表示件数</p>
            <label class="selectbox-003">
                <select name="limit" onchange="this.form.submit()">
                    <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10件</option>
                    <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20件</option>
                    <option value="30" {{ $limit == 30 ? 'selected' : '' }}>30件</option>
                    <option value="40" {{ $limit == 40 ? 'selected' : '' }}>40件</option>
                </select>
            </label>
        </form>
        <p>全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
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

                <td>
                    <form action="{{ route('admin.delete', ['id'=>$param->id]) }}" method="GET" id="deleteForm">
                        <button type="button" onclick="return Delete()"><i class="fa-regular fa-trash-can add2"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>


    <div class="page">
        {{ $params->appends(request()->query())->links() }}
    </div>
</x-admin-layout>



