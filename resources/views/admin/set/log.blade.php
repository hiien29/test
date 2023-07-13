<x-admin-layout>
    <x-slot name="header">
    </x-slot>

    @include('admin.set.nav')

    <div class="log_outer">
        <table>
            <tr>
                <th>ユーザー名</th>
                <th>処理内容</th>
                <th>処理詳細</th>
                <th>日時</th>
            </tr>

            @foreach($logs as $log)
            <tr>
                <td>{{ $log->name }}</td>
                <td>{{ $log->action }}</td>
                <td class="description">{{ $log->description }}</td>
                <td>{{ date('Y/m/d H:i',strtotime($log->created_at)) }}</td>
            </tr>
            @endforeach
            
        </table>
    </div>

</x-admin-layout>
