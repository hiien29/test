<x-admin-layout>
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
                        <th>試験ID</th>
                        <th class="th_1">打設日</th>
                        <th class="th_1">試験日</th>
                        <th>材齢(日)</th>
                        <th class="th_1">配合</th>
                        <th class="th_2">現場名</th>
                        <th>結果</th>
                        <th>詳細</th>
                        <th>編集</th>
                        <th>削除</th>
                    </tr>
                    @foreach ($nottasks as $nottask)
                    <tr>
                        <td>{{ $nottask->id }}</td>
                        <td>{{ date('Y/m/d',strtotime($nottask->make_day)) }}</td>
                        <td>{{ date('Y/m/d',strtotime($nottask->test_day)) }}</td>
                        <td>{{ $nottask->age }}</td>
                        <td>{{ $nottask->type }}</td>
                        <td>{{ $nottask->site }}</td>
                        <td><a href="{{ route('admin.taskregister', ['id'=>$nottask->id]) }}"><i class="fa-solid fa-plus add2"></i></a></td>
                        <td><a href="{{ route('admin.task_detail', ['id'=>$nottask->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                        <td><a href="{{ route('admin.task_edit', ['id'=>$nottask->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                        <td><a href="{{ route('admin.task_delete', ['id'=>$nottask->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
                    </tr>
                    @endforeach
                </table>
            </div>

            

        </div>
    @endif
    

    @if (count($params)>0)
        <div class="test_count">
            <p class="text-right">全試験数：{{ $params->total() }}件（{{ $params->currentPage() }}/{{ $params->lastPage() }}）</p>
        </div>

        <div class="table_outer">
            <table class="table">
                <tr>
                    <th>試験ID</th>
                    <th class="th_1">打設日</th>
                    <th class="th_1">試験日</th>
                    <th>材齢(日)</th>
                    <th class="th_1">配合</th>
                    <th class="th_2">現場名</th>
                    <th>結果</th>
                    <th>詳細</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
                @foreach ($params as $param)
                <tr>
                    <td>{{ $param->id }}</td>
                    <td>{{ date('Y/m/d',strtotime($param->make_day)) }}</td>
                    <td>{{ date('Y/m/d',strtotime($param->test_day)) }}</td>
                    <td>{{ $param->age }}</td>
                    <td>{{ $param->type }}</td>
                    <td>{{ $param->site }}</td>
                    <td><a href="{{ route('admin.taskregister', ['id'=>$param->id]) }}"><i class="fa-solid fa-plus add2"></i></a></td>
                    <td><a href="{{ route('admin.task_detail', ['id'=>$param->id]) }}"><i class="fa-solid fa-circle-info add2"></i></a></td>
                    <td><a href="{{ route('admin.task_edit', ['id'=>$param->id]) }}"><i class="fa-regular fa-pen-to-square add2"></i></a></td>
                    <td><a href="{{ route('admin.task_delete', ['id'=>$param->id]) }}" onclick="return confirm('本当に削除しますか？')"><i class="fa-regular fa-trash-can add2"></i></a></td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="page">
            {{ $params->links() }}
        </div>
    @endif
    @if (count($params) === 0)
    <div class="text-center pt text-xl font-medium">本日実施予定の試験はありません。</div>
    @endif
</x-admin-layout>

<script src="{{ asset('js/hoge.js') }}"></script>