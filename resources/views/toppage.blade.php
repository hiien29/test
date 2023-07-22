{{-- <x-guest-layout> --}}

    {{-- <div class="text-center">
        <a href="{{ route('admin.login') }}">管理者の方はこちら</a>
    </div>
    <div class="text-center mt-10">
        <a href="{{ route("login") }}">従業員の方はこちら</a>
    </div> --}}
{{--     
    <div class="flex">
        <div class="select">
            <p>管理者の方はこちら</p>
        </div>

        <div class="select">
            <p>従業員の方はこちら</p>
        </div>
    </div> --}}
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">
    
            <title>{{ config('app.name', 'Laravel') }}</title>
    
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
            <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    
            <!-- Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body class="font-sans text-gray-900 antialiased">

            
            <div class="min-h-screen sm:pt-0 bg-gray-100 flex items-center">

                {{-- <div class="flex justify-center" style="margin-bottom: 100px;">
                    <img src="{{ asset('img/logo.png') }}" alt="" style="height: 200px;">
                </div> --}}
                <div class="flex select_inner">
                    <div class="bg-white shadow-md overflow-hidden select_box">
                        <a href="{{ route('admin.login') }}">
                        <p><img src="{{ asset('img/admin.png') }}" alt=""></p>
                        <p class="select_font">管理者の方はこちら</p>
                        </a>
                    </div>
                    <div class="bg-white shadow-md overflow-hidden select_box">
                        <a href="{{ route('login') }}">
                        <p><img src="{{ asset('img/user.png') }}" alt=""></p>
                        <p class="select_font">従業員の方はこちら</p>
                        </a>
                    </div>
                </div>
                
            </div>

        </body>
    </html>
