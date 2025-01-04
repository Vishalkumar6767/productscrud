<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product CRUD</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('quill/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('remixicon/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> <!-- You can use Font Awesome for icons -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Add your custom styles if necessary -->
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
</head>
<body class="{{ !request()->cookie('sidebar-toggle') ? '' : 'toggle-sidebar' }}">
    <div class="container">
        <!-- Header Section -->
        <!-- <header>
            <nav>
                <ul>
                    <li><a href="{{ route('products.index') }}">Products</a></li>
                    <li><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Logout</a></li>
                </ul>
            </nav>
        </header> -->

        <!-- Main Content Section -->

        <main id="wrapper">
           
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('partials.topbar') <!-- Include Topbar -->
                    <div class="main-content">
                        @yield('content') <!-- Dynamic Content -->
                    </div>
                </div>
                @include('partials.footer') <!-- Include Footer -->
            </div>
        </main>
       

        {{-- <!-- Footer Section -->
        <footer>
            <p>&copy; 2025 Product CRUD System. All rights reserved.</p>
        </footer>
    </div> --}}

    <script src="{{ asset('js/app.js') }}"></script> <!-- Your JS files -->
</body>
</html>
