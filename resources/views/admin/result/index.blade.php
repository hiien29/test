<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験結果</h1>
        </div>
    </x-slot>
    <div class="table_outer">
        <table class="table">
            <tr>
                <th>打設日</th>
                <th>試験日</th>
                <th class="th_4">材齢</th>
                <th>配合</th>
                <th class="th_6">現場名</th>
                <th>試験結果</th>
                <th class="th_4"></th>
                <th class="th_4"></th>
                <th class="th_4"></th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>{{ $param->result }}N/㎟</td>
                <td><a href="{{ route('admin.result_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                <td><a href="{{ route('admin.result_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('admin.result_delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>

        <div class="page">
            {{ $params->links() }}
        </div>
    
</x-admin-layout>