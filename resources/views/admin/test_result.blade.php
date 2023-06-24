<x-admin-layout>
    <x-slot name="header">
        <p>試験結果</p>
    </x-slot>
    <div class="box">
        <table border="1">
            <tr>
                <th>打設日</th>
                <th>試験日</th>
                <th>材齢</th>
                <th>配合</th>
                <th>現場名</th>
                <th>試験結果</th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>{{ $param->result }}N/㎟</td>
                <td><a href="{{ route('admin.detail', ['id'=>$param->id]) }}">詳細</a></td>
                <td><a href="/admin/schedule_edit/{{ $param->id }}">編集</a></td>
                <td><a href="{{ route('admin.delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a></td>
            </tr>
            @endforeach
        </table>
    
</x-admin-layout>