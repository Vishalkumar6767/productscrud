<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product CRUD</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- Font Awesome icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
</head>
<body class="{{ !request()->cookie('sidebar-toggle') ? '' : 'toggle-sidebar' }}">
    @if (!in_array(request()->path(), ['signup', 'login']))
        <div class="container">
            @include('partials.topbar')
            <main id="wrapper">
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">
                        <div class="main-content">
                            @yield('content')
                        </div>
                    </div>
                    @include('partials.footer')
                </div>
            </main>
        </div>
    @else
        <!-- For registration and login pages, render only the content without top bar -->
        <div class="container">
            @yield('content')
        </div>
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="{{ asset('js/app.js') }}"></script> 

</body>
</html>
