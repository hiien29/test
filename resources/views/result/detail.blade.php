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
                <th class="detail_inner detail_border">試験ID</th>
                <td class="detail__border">{{ $details->id }}</td>
            </tr>
            <tr>
                <th class="detail_border">打設日</th>
                <td class="detail__border">{{ date('Y/m/d',strtotime($details->make_day)) }}</td>
            </tr>
            <tr>
                <th class="detail_border">試験日</th>
                <td class="detail__border">{{ date('Y/m/d',strtotime($details->test_day)) }}</td>
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
                <th class="detail_border">試験結果</th>
                <td class="detail__border">{{ $details->result }}N/㎟</td>
            </tr>
            <tr>
                <th class="detail_border">作成者</th>
                <td class="detail__border">{{ $details->author }}<br>
                （{{date('Y/m/d H:i:m',strtotime($details->created_at))}}）</td>
            </tr>
            {{-- <tr>
                <th class="detail_border">試験詳細編集者</th>
                <td class="detail__border">{{ $details->editor }}</td>
            </tr> --}}
            <tr>
                <th class="detail_border">試験者</th>
                <td class="detail__border indent_">{{ $details->tester }}</td>
            </tr>
            {{-- <tr>
                <th class="detail_border">結果編集者</th>
                <td class="detail__border">{{ $details->test_editor }}</td>
            </tr> --}}
            <tr>
                <th class="detail__inner">コメント</th>
                <td class="indent">{{ $details->comment }}</td>
            </tr>
        </table>
    </div>

    <div class="detail_back">
        <a href="#" onclick="history.back()"><i class="fa-solid fa-circle-arrow-left"></i>戻る</a>
    </div>
</x-app-layout>