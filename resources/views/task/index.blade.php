<x-app-layout>
    <x-slot name="header">
        <div class="header">
            <h1>当日</h1>
        </div>
    </x-slot>

    @if (count($nottasks)>0)
        <div class="nottask_outer">
        
            <div class="nottask_header">
                <p id="nottask_btn"><i class="fa-solid fa-triangle-exclamation"></i>{{'完了していないタスクがあります'}}</p>
            </div>

            <div class="nottask table_outer" style="margin-top: 2%;" id="nottask">
                <table class="table">
                    <tr>
                        <th class="th_1">打設日</th>
                        <th class="th_1">試験日</th>
                        <th>材齢(日)</th>
                        <th class="th_1">配合</th>
                        <th class="th_2">現場名</th>
                        @if(Auth::user()->department_number === '001')
                        <th class="th_5">結果</th>
                        @endif
                        <th>詳細</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    @foreach ($nottasks as $nottask)
                    <tr>
                        <td>{{ date('Y/m/d',strtotime($nottask->make_day)) }}</td>
                        <td>{{ date('Y/m/d',strtotime($nottask->test_day)) }}</td>
                        <td>{{ $nottask->age }}</td>
                        <td>{{ $nottask->type }}</td>
                        <td>{{ $nottask->site }}</td>
                        @if(Auth::user()->department_number === '001')
                        <td><a href="{{ route('taskregister', ['id'=>$nottask->id]) }}"><i class="fa-solid fa-plus add2"></i></a></td>
                        @endif
                        <td><a href="{{ route('task_detail', ['id'=>$nottask->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                        <td><a href="{{ route('task_edit', ['id'=>$nottask->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                        <td><a href="{{ route('task_delete', ['id'=>$nottask->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
    

    <div class="test_count">
        <p class="mt-6 text-right" >全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
    </div>

    <div class="table_outer" style="margin-top: 2%;">
        <table class="table">
            <tr>
                <th class="th_1">打設日</th>
                <th class="th_1">試験日</th>
                <th>材齢(日)</th>
                <th class="th_1">配合</th>
                <th class="th_2">現場名</th>
                @if(Auth::user()->department_number === '001')
                <th class="th_5">結果</th>
                @endif
                <th>詳細</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
            @foreach ($params as $param)
            <tr>
                <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                <td>{{ $param->age }}</td>
                <td>{{ $param->type }}</td>
                <td>{{ $param->site }}</td>
                
                @if(Auth::user()->department_number === '001')
                <td><a href="{{ route('taskregister', ['id'=>$param->id]) }}"><i class="fa-solid fa-plus add2"></i></a></td>
                @endif
                <td><a href="{{ route('task_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                <td><a href="{{ route('task_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                <td><a href="{{ route('task_delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="page">
        {{ $params->links() }}
    </div>
</x-app-layout>

<script src="{{ asset('js/hoge.js') }}"></script>