<!DOCTYPE html>
<html>
<title>result_pdf</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    /* 基本の文字 */
    @font-face {
        font-family: migmix-1p-regular;
        font-style: normal;
        font-weight: normal;
        src: url('{{ storage_path('fonts/migmix-1p-regular.ttf') }}');
    }
    /* 太字用 */
    @font-face{
        font-family: migmix-1p-bold;
        font-style: bold;
        font-weight: bold;
        src:url('{{ storage_path('fonts/migmix-1p-bold.ttf')}}');
    }
    /* body全体に反映する */
    body {
        font-family: migmix-1p-regular;
    }
    /* hタグに反映 */
    h1, h2 {
        font-family: migmix-1p-bold;
    }
</style>
<body>
<h1>あああ</h1>
<h2>
    日付 : {{ $params->make_day }}
    <br>
</h2>
<p>
    こんにちは {{ $params->test_day }} さん！

    {{ $today }}
</p>
</body>
</html>                                     