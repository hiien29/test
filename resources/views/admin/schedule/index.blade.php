<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験予定</h1>
        </div>
    </x-slot>

    <div class="table_outer">
        <table class="table">
            <tr>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th class="th_2">材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_3">現場名</th>
                <th class="th_4"></th>
                <th class="th_4"></th>
                <th class="th_4"><a href="{{ route('admin.testregister') }}"><i class="fa-solid fa-plus add"></i></a></th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>
                    <div class="list_btn">
                        <a href="{{ route('admin.detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a>
                    </div>
                </td>
                <td>
                    <div class="list_btn">
                        <a href="{{ route('admin.edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a>
                    </div>
                </td>
                <td>
                    <div class="list_btn">
                        <a href="{{ route('admin.delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a>
                    </div>
                    </td>
            </tr>
            @endforeach
        </table>
    </div>
    
</x-admin-layout>