<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験結果</h1>
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
                <th class="th_3">現場名</th>
                <th>試験結果</th>
                <th></th>
                <th></th>
                {{-- <th class="th_4"></th> --}}
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>{{ $param->result }}N/㎟</td>
                <td><a href="{{ route('result_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                <td><a href="{{ route('result_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                {{-- <td><a href="{{ route('result_delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td> --}}
            </tr>
            @endforeach
        </table>
    </div>

    <div class="page">
        {{ $params->links() }}
    </div>
    
</x-app-layout>