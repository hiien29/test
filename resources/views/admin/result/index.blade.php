<x-admin-layout>
    <x-slot name="header">
        <div class="header">
            <h1>試験結果</h1>
        </div>
    </x-slot>
    

{{-- 検索前--}}

    {{-- 検索画面 --}}
    @if(empty($searches))
        <form action="{{ route('admin.result_search') }}" method="GET">
            @csrf
            <div class="search_outer">
                <div>
                    <label class="block font-bold text-gray-700">期間（試験日）</label>
                    <input type="date" name="start_day" value="{{ old('start_day') }}" class="rounded-lg">
                    <span>~</span>
                    <input type="date" name="end_day" value="{{ old('end_day') }}" class="rounded-lg">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">配合</label>
                    <input type="text" name="type" value="{{ old('type') }}" class="rounded-lg">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">材齢</label>
                    <input type="text" name="age" value="{{ old('age') }}" class="rounded-lg"> 日
                </div>
                <div>
                    <label class="block font-bold text-gray-700">現場名</label>
                    <input type="text" name="site" value="{{ old('site') }}" class="rounded-lg">
                </div>
            </div>

            <div class="search_btn">
                <button class="search__btn"><i class="fa-solid fa-magnifying-glass"></i>詳細検索</button>
            </div>
        </form>

    {{-- 一覧表示 --}}
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
                    <td><a href="{{ route('admin.result_pdf',['id'=>$param->id]) }}"><i class="fa-solid fa-file-arrow-down add2"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>

            <div class="page">
                {{ $params->links() }}
            </div>

    @endif

{{-- 検索後 --}}

    {{-- 検索画面 --}}
    @if(!empty($searches))
        <form action="{{ route('admin.result_search') }}" method="GET">
            @csrf
            <div class="search_outer">
                <div>
                    <label class="block font-bold text-gray-700">期間（試験日）</label>
                    <input type="date" name="start_day" value="{{ old('start_day') ?? $request->start_day}}" class="rounded-lg">
                    <span>~</span>
                    <input type="date" name="end_day" value="{{ old('end_day') ?? $request->end_day}}" class="rounded-lg">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">配合</label>
                    <input type="text" name="type" value="{{ old('type') ?? $request->type }}" class="rounded-lg">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">材齢</label>
                    <input type="text" name="age" value="{{ old('age') ?? $request->age }}" class="rounded-lg"> 日
                </div>
                <div>
                    <label class="block font-bold text-gray-700">現場名</label>
                    <input type="text" name="site" value="{{ old('site') ?? $request->site }}" class="rounded-lg">
                </div>
            </div>

            <div class="search_btn flex justify-center">
                <a href="{{ route('admin.result') }}" class="searct___btn">検索解除</a>
                <button class="searct___btn"><i class="fa-solid fa-magnifying-glass"></i>詳細検索</button>
            </div>
        </form>

    {{-- 一覧表示 --}}

    {{-- 検索条件未記入 --}}
        @if( !$request->anyFilled(['start_day', 'end_day', 'type', 'age', 'site']))
        <p class="text-center pt text-xl font-medium">検索条件を指定してください。</p>
        @endif

    
    
    {{-- 検索結果該当なし --}}
        @if( $request->anyFilled(['start_day', 'end_day', 'type', 'age', 'site']) && $searches->count() === 0 )
        <p class="text-center pt text-xl font-medium">該当する試験結果はありませんでした。</p>
        @endif


    {{-- 検索結果該当あり --}}
        @if( $searches->count() > 0)

            <div class="test_count flex justify-between" style="margin-top: 3%;">
                <p class="text-xl font-bold text-gray-800" style="padding-left: 2%;">平均結果：{{ round($avg,1) }}N/㎟</p>
                <p>全試験数：{{ $searches->count() }}件（{{ $searches->currentPage() }}/{{ $searches->lastPage() }}）</p>
            </div>
        

            <div class="table_outer" style="margin-top: 2%;">
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
                        <td><a href=""><i class="fa-solid fa-file-arrow-down add2"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="page">
                {{ $searches->links() }}
            </div>
        @endif

    @endif

    
</x-admin-layout>