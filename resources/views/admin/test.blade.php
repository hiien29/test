<x-admin-layout>
    <x-slot name="header">
        <p>当日</p>
    </x-slot>
    <div class="box">
        <table border="1">
            <tr>
                <th>打設日</th>
                <th>試験日</th>
                <th>材齢</th>
                <th>配合</th>
                <th>現場名</th>
                <th>結果</th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>{{ $param->result }}</td>
                <td><a href="{{ route('admin.edit', ['id'=>$param->id]) }}">追加</a></td>
                <td><a href="{{ route('admin.edit', ['id'=>$param->id]) }}">編集</a></td>
                <td><a href="{{ route('admin.delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a></td>
            </tr>
            @endforeach
        </table>
</x-admin-layout>