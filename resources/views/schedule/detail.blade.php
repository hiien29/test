<x-app-layout>
    <x-slot name="header">
        {{-- <div class="header">
            <h1>詳細</h1>
        </div> --}}
    </x-slot>

    <div class="detail_header">
        <h1>試験詳細</h1>
    </div>

    <div class="detail_table">
        <table class="detail">
            <tr>
                <th class="detail_inner detail_border">打設日</th>
                <td class="detail__border">{{ $details->make_day }}</td>
            </tr>
            <tr>
                <th class="detail_border">試験日</th>
                <td class="detail__border">{{ $details->test_day }}</td>
            </tr>
            <tr>
                <th class="detail_border">材齢</th>
                <td class="detail__border">{{ $details->age }}日</td>
            </tr>
            <tr>
                <th class="detail_border">配合</th>
                <td class="detail__border">{{ $details->type }}</td>
            </tr>
            <tr>
                <th class="detail_border">現場</th>
                <td class="detail__border">{{ $details->site }}</td>
            </tr>
            <tr>
                <th class="detail_border">作成者</th>
                <td class="detail__border">{{ $details->author }}</td>
            </tr>
            <tr>
                <th class="detail_border">編集者</th>
                <td class="detail__border">{{ $details->editor }}</td>
            </tr>
            <tr>
                <th class="detail__inner">コメント</th>
                <td class="indent">{{ $details->comment }}</td>
            </tr>
        </table>
    </div>

    <div class="detail_back">
        <a href="{{ route('schedule') }}"><i class="fa-solid fa-circle-arrow-left"></i>戻る</a>
    </div>
    
</x-app-layout>