<x-admin-layout>
    <x-slot name="header">
        <h1>設定</h1>
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
                @if( $log->user_id == NULL)
                <td>退会済みユーザー</td>
                @else
                <td>{{ $log->name }}</td>
                @endif
                <td>{{ $log->action }}</td>
                <td class="description">{{ $log->description }}</td>
                <td>{{ date('Y/m/d H:i',strtotime($log->created_at)) }}</td>
            </tr>
            @endforeach
            
        </table>
    </div>

    <div class="page">
        {{ $logs->links() }}
    </div>

</x-admin-layout>
