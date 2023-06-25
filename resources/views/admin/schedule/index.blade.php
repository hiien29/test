<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <p>試験予定</p>
            <p><a href="{{ route('admin.testregister') }}">追加</a></p>
        </div>
    </x-slot>

    <div class="box">
        <table border="1">
            <tr>
                <th>打設日</th>
                <th>試験日</th>
                <th>材齢</th>
                <th>配合</th>
                <th>現場名</th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ $param->make_day }}</td>
                <td>{{ $param->test_day }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td><a href="{{ route('admin.detail', ['id'=>$param->id]) }}">詳細</a></td>
                <td><a href="{{ route('admin.edit', ['id'=>$param->id]) }}">編集</a></td>
                <td><a href="{{ route('admin.delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')">削除</a></td>
            </tr>
            @endforeach
        </table>





        
        {{-- @foreach ($contacts as $contact)
        <tr>
            <td>{{ $contact->make_day }}</td>
            <td>{{ $contact->test_day }}</td>
            <td>{{ $contact->age }}</td>
            <td>{{ $contact->type }}</td>
            <td>{{ $contact->site }}</td>
            <td>{{ $contact->author }}</td> --}}
            {{-- <td>{{ $contact->created_at }}</td>
            <td><a href="/edit/{{ $contact->id}}">編集</a></td>
            <td><a href="/delete/{{ $contact->id}}"  onclick="return confirm('本当に削除しますか？')">削除</a></td> --}}
        {{-- </tr>
        @endforeach
        </table> --}}
    </div>
</x-admin-layout>