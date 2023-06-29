<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験結果</h1>
        </div>
    </x-slot>
    
    <form action="{{ route('admin.result_search') }}" method="GET">
        @csrf
        <div class="search_outer">
            <div>
                <label>期間（試験日）</label>
                <input type="date" name="start_day" value="{{ old('start_day') }}">
                <span>~</span>
                <input type="date" name="end_day" value="{{ old('end_day') }}">
            </div>
            <div class="search_type">
                <label>配合</label>
                <input type="text" name="type" value="{{ old('type') }}">
            </div>
            <div class="search_age">
                <label>材齢</label>
                <input type="text" name="age" value="{{ old('age') }}" class="search__age"> 日
            </div>
        </div>

        <div class="search_btn">
            <button><i class="fa-solid fa-magnifying-glass"></i>詳細検索</button>
            <a href="{{ route('admin.result')}}">検索解除</a>
        </div>

    </form>

    @if(!empty($searches))

    
    @if( $searches->count() === 0 )
    <p>該当する試験結果はありませんでした。</p>

    @elseif( $searches->count() > 0)

    <p>平均結果：{{ $avg }}N/㎟</p>

    <p>{{ $searches->count() }}</p>

    <div class="test_count">
        <p>全試験数：{{ $searches->count() }}件（{{ $searches->currentPage() }}/{{ $searches->lastPage() }}）</p>
    </div>

    <div class="table_outer">
        <table class="table">
            <tr>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th>材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_3">現場名</th>
                <th>試験結果</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($searches as $search)
            <tr>
                <td>{{ date('Y/m/d',strtotime($search->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($search->test_day)) }}</td>
                <td>{{ $search->age }}</td>
                <td>{{ $search->type }}</td>
                <td>{{ $search->site }}</td>
                <td>{{ $search->result }}N/㎟</td>
                <td><a href="{{ route('admin.result_detail', ['id'=>$search->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                <td><a href="{{ route('admin.result_edit', ['id'=>$search->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('admin.result_delete', ['id'=>$search->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>
        <div class="page">
            {{ $searches->links() }}
        </div>
        @endif
    @endif

    @if(empty($searches))
    <div class="table_outer">
        <table class="table">
            <tr>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th>材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_3">現場名</th>
                <th>試験結果</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                <td>{{ $param->result }}N/㎟</td>
                <td><a href="{{ route('admin.result_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                <td><a href="{{ route('admin.result_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('admin.result_delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>
        <div class="page">
            {{ $params->links() }}
        </div>
    @endif
    
</x-admin-layout>