<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験予定</h1>
        </div>
    </x-slot>

    <p class="mt-6 text-right" style="margin-right: 10%; margin-top: 3%;">全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
    <div class="table_outer">
        <table class="table">
            <tr>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th>材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_2">現場名</th>
                <th></th>
                <th></th>
                <th><a href="{{ route('testregister') }}"><i class="fa-solid fa-plus add"></i></a></th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td><a href="{{ route('detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                <td><a href="{{ route('edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="page">
        {{ $params->links() }}
    </div>
    
</x-app-layout>