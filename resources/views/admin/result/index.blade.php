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
                    <input type="date" name="start_day" value="{{ old('start_day') }}" class="rounded-lg" id="make_day">
                    <span>~</span>
                    <input type="date" name="end_day" value="{{ old('end_day') }}" class="rounded-lg" id="test_day">
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
                <button class="search__btn"><i class="fa-solid fa-magnifying-glass"></i>検索</button>
            </div>
        </form>

    {{-- 一覧表示 --}}

        <div style="width: 85%; margin: 2% auto 0; flex" class="flex justify-between items-end">
            <form action="{{ route('admin.result') }}" method="GET">
                <p style="font-size: .9rem;">表示件数</p>
                <label class="selectbox-003">
                    <select name="limit" onchange="this.form.submit()">
                        <option value="10" {{ $limit == 10 ? 'selected' : '' }}>10件</option>
                        <option value="20" {{ $limit == 20 ? 'selected' : '' }}>20件</option>
                        <option value="30" {{ $limit == 30 ? 'selected' : '' }}>30件</option>
                        <option value="40" {{ $limit == 40 ? 'selected' : '' }}>40件</option>
                    </select>
                </label>
            </form>
            <p>全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
        </div>
        {{-- <p class="mt-6 text-right" style="margin-right: 10%;">全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p> --}}
        <div class="table_outer">
            <table class="table">
                <tr>
                    <th>試験ID</th>
                    <th class="th_1">打設日</th>
                    <th class="th_1">試験日</th>
                    <th>材齢(日)</th>
                    <th class="th_1">配合</th>
                    <th class="th_3">現場名</th>
                    <th class="th_4">試験結果</th>
                    <th>詳細</th>
                    <th>編集</th>
                    <th>削除</th>
                    <th>PDF</th>
                </tr>
                @foreach ($params as $param)
                <tr>
                    <td>{{ $param->id }}</td>
                    <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                    <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                    <td>{{ $param->age }}</td>
                    <td>{{ $param->type }}</td>
                    <td>{{ $param->site }}</td>
                    <td>{{ $param->result }}N/㎟</td>
                    <td><a href="{{ route('admin.result_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                    <td><a href="{{ route('admin.result_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                    <td><a href="#" data-url="{{ route('admin.result_delete', ['id'=>$param->id]) }}"  onclick="return Delete(this)"><i class="fa-regular fa-trash-can add2"></i></a></td>
                    {{-- <td>
                        <form action="{{ route('admin.result_delete', ['id'=>$param->id]) }}" method="GET" id="deleteForm">
                            <button type="button" onclick="return Delete()"><i class="fa-regular fa-trash-can add2"></i></button>
                        </form>
                    </td> --}}
                    <td><a href="{{ route('admin.result_pdf',['id'=>$param->id]) }}"  target="_blank"><i class="fa-solid fa-file-arrow-down add2"></i></a></td>
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
                    <input type="date" name="start_day" value="{{ old('start_day') ?? $session['start_day'] ?? '' }}" class="rounded-lg" id="make_day">
                    <span>~</span>
                    <input type="date" name="end_day" value="{{ old('end_day') ?? $session['end_day'] ?? ''}}" class="rounded-lg" id="test_day">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">配合</label>
                    <input type="text" name="type" value="{{ old('type') ?? $session['type'] ?? '' }}" class="rounded-lg">
                </div>
                <div>
                    <label class="block font-bold text-gray-700">材齢</label>
                    <input type="text" name="age" value="{{ old('age') ?? $session['age'] ?? ''}}" class="rounded-lg"> 日
                </div>
                <div>
                    <label class="block font-bold text-gray-700">現場名</label>
                    <input type="text" name="site" value="{{ old('site') ?? $session['site'] ?? ''}}" class="rounded-lg">
                </div>
            </div>

            <div class="search_btn flex justify-center">
                <a href="{{ route('admin.result') }}" class="search___btn">検索解除</a>
                <button class="search____btn"><i class="fa-solid fa-magnifying-glass"></i>再検索</button>
            </div>
        </form>

    {{-- 一覧表示 --}}

    {{-- 検索条件未記入 --}}
        @if(!empty($nosearch))
        <p class="text-center pt text-xl font-medium">検索条件を指定してください。</p>
        @endif


    
    
    {{-- 検索結果該当なし --}}
        {{-- @if( $rq->anyFilled(['start_day', 'end_day', 'type', 'age', 'site']) && $searches->count() === 0 ) --}}
        @if( $searches->count() === 0 && empty($nosearch))
        <p class="text-center pt text-xl font-medium">該当する試験結果はありませんでした。<br>再度検索条件を入力してください。</p>
        @endif

    {{-- 検索結果該当あり --}}
        @if( $searches->count() > 0 )
            <div class="flex test__count">
                <p class="text-xl font-bold statistic_font" style="margin-right: 24px;">平均結果：{{ round($avg,1) }}N/㎟</p>
                <p class="text-xl font-bold statistic_font mx-6">最小値：{{ $min }}N/㎟</p>
                <p class="text-xl font-bold statistic_font mx-6">最大値：{{ $max }}N/㎟</p>
            </div>

            <p class="mt-6 text-right" style="margin-right: 5%;">全試験数：{{ $searches->total() }}件（{{ $searches->currentPage() }}/{{ $searches->lastPage() }}）</p>
        
            <div class="table_outer" style="width: 90%;margin-top: 2%;">
                <table class="table">
                    <tr>
                        <th>試験ID</th>
                        <th class="th_1">打設日</th>
                        <th class="th_1">試験日</th>
                        <th>材齢(日)</th>
                        <th class="th_1">配合</th>
                        <th class="th_3">現場名</th>
                        <th class="th_4">試験結果</th>
                        <th>詳細</th>
                        <th>編集</th>
                        <th>削除</th>
                        <th>PDF</th>
                    </tr>
                    @foreach ($searches as $search)
                    <tr>
                        <td>{{ $search->id }}</td>
                        <td>{{ date('Y/m/d',strtotime($search->make_day)) }}</td>
                        <td>{{ date('Y/m/d',strtotime($search->test_day)) }}</td>
                        <td>{{ $search->age }}</td>
                        <td>{{ $search->type }}</td>
                        <td>{{ $search->site }}</td>
                        <td>{{ $search->result }}N/㎟</td>
                        <td><a href="{{ route('admin.result_detail', ['id'=>$search->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></a></td>
                        <td><a href="{{ route('admin.result_edit', ['id'=>$search->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                        <td><a href="#" data-url="{{ route('admin.result_delete', ['id'=>$search->id]) }}"  onclick="return Delete(this)"><i class="fa-regular fa-trash-can add2"></i></a></td>
                        <td><a href="{{ route('admin.result_pdf',['id'=>$search->id]) }}"  target="_blank"><i class="fa-solid fa-file-arrow-down add2"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="page">
                {{ $searches->appends(request()->query())->links() }}
            </div>
        @endif

    @endif

    
</x-admin-layout>
<script src="{{ asset('js/register.js') }}"></script>