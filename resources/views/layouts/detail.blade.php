<div class="detail__header">
    <h1>試験詳細</h1>
</div>

<div class="detail_table">
    <table class="detail_inner">
        <tr>
            <th class="detail_header detail_inner">試験ID</th>
            <td class="detail_data detail_border">{{ $details->id }}</td>
            <th class="detail_header">配合</th>
            <td class="detail_data">{{ $details->type }}</td>
        </tr>
        <tr>
            <th class="detail_header">打設日</th>
            <td class="detail_data detail_border">{{ date('Y/m/d',strtotime($details->make_day)) }}</td>
            <th class="detail_header">現場名</th>
            <td class="detail_data">{{ $details->site }}</td>
        </tr>
        <tr>
            <th class="detail_header">試験日</th>
            <td class="detail_data detail_border">{{ date('Y/m/d',strtotime($details->test_day)) }}</td>
            <th rowspan="2" class="detail_header">作成者</th>
            <td rowspan="2" class="detail_data">{{ $details->author }}<br>
                (作成日時：{{date('Y/m/d H:i',strtotime($details->created_at))}})</td>
        </tr>
        <tr>
            <th class="detail_header">材齢</th>
            <td class="detail_data detail_border">{{ $details->age }}日</td>
        </tr>
        <tr>
            <th colspan="4" class="detail_comment">コメント</th>
        </tr>
        <tr>
            <td  colspan="4" class="detail__comment">@foreach ($comments as $comment)
                <div class="comment_box">
                    <p class="comment_user">{{ $comment->enterer }}（{{ date('Y/m/d H:i',strtotime($comment->created_at)) }}）</p>
                    <p class="comment_detail">{{ $comment->comment }}</p>
                </div>
                @endforeach</td>
        </tr>
    </table>
</div>

<div class="detail_back">
    <a href="#" onclick="history.back()"><i class="fa-solid fa-circle-arrow-left"></i>戻る</a>
</div> 