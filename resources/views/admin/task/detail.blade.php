<x-admin-layout>
    <div>
        <div>
            <p>打設日</p>
            <p>{{ $details->make_day }}</p>
        </div>
        <div>
            <p>試験日</p>
            <p>{{ $details->test_day }}</p>
        </div>
        <div>
            <p>材齢</p>
            <p>{{ $details->age }}日</p>
        </div>
        <div>
            <p>配合</p>
            <p>{{ $details->test_day }}</p>
        </div>
        <div>
            <p>現場</p>
            <p>{{ $details->site }}</p>
        </div>
        <div>
            <p>作成者</p>
            <p>{{ $details->author }}</p>
        </div>
        <div>
            <p>編集者</p>
            @if ($details->editor === null)
                {{ '未編集' }}
            @endif
            <p>{{ $details->editor }}</p>
        </div>
        <div>
            <p>コメント</p>
            <p>{{ $details->comment }}</p>
        </div>
    </div>
    <div>
        <a href="{{ route('admin.test') }}">戻る</a>
    </div>
</x-admin-layout>