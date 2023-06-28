<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験予定</h1>
        </div>
    </x-slot>

    <div class="table_outer">
        <table class="table">
            <tr>
                <th class="th_7">打設日</th>
                <th class="th_7">試験日</th>
                <th class="th_4">材齢(日)</th>
                <th class="th_7">配合</th>
                <th class="th_3">現場名</th>
                <th class="th_4"></th>
                <th class="th_4"></th>
                <th class="th_4"><a href="{{ route('testregister') }}"><i class="fa-solid fa-plus add"></i></a></th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
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