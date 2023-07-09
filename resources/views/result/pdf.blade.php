<!DOCTYPE html>
<html>
        <title>result_pdf</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>

            @page {
                size: A4;
                margin: 11mm;
            }
            /* 基本の文字 */
            @font-face {
                font-family: ipaexm;
                font-style: normal;
                font-weight: normal;
                src: url('{{ storage_path('fonts/ipaexm.ttf')}}');
            }
            /* 太字用 */
            @font-face{
                font-family: ipaexm;
                font-style: bold;
                font-weight: bold;
                src:url('{{ storage_path('fonts/ipaexm.ttf')}}');
            }
            /* body全体に反映する */
            body {
                font-family: ipaexm;
            }
            /* hタグに反映 */
            h1, h2 {
                font-family: ipaexm;
            }
        </style>
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    </head>
<body>
    <div class="header_pdf">
        <h1>試験成績書</h1>
        <p>発行日:{{ date('Y年m月d日',strtotime($today)) }}</p>
    </div>

    <div class="table_pdf">
        <table>
            <tr>
                <th class="pdf_border">打設日</th>
                <td class="pdf_border">{{ date('Y年m月d日',strtotime($params->make_day)) }}</td>
            </tr>
            <tr>
                <th class="pdf_border">試験日</th>
                <td class="pdf_border">{{ date('Y年m月d日',strtotime($params->test_day)) }}</td>
            </tr>
            <tr>
                <th class="pdf_border">材齢</th>
                <td class="pdf_border">{{ $params->age }}日</td>
            </tr>
            <tr>
                <th class="pdf_border">配合</th>
                <td class="pdf_border">{{ $params->type }}</td>
            </tr>
            <tr>
                <th class="pdf_border">現場名</th>
                <td class="pdf_border">{{ $params->site }}</td>
            </tr>
            <tr>
                <th class="pdf_border">試験結果</th>
                <td class="pdf_border">{{ $params->result }}N/㎟</td>
            </tr>
            <tr>
                <th>試験者</th>
                <td>{{ $params->tester }}</td>
            </tr>
        </table>
    </div>
</body>
</html>                                     