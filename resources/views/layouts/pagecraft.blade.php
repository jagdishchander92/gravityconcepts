<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PageCraft - Live Preview')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
     <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body style="margin:0;padding:20px;background:#f0f2f5;font-family:'Segoe UI',system-ui,sans-serif;line-height:1.6;">
    <div style="max-width:1200px;margin:0 auto;">
        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:12px;border-radius:8px;margin-bottom:20px;border-left:4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>