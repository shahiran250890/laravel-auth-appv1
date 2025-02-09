<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (!empty($user))
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="getProfile">{{ __('Profile') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="getProduct">{{ __('Product') }}</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>
    @if(!empty($user))
        getProfile();
        $('#getProfile').on('click', function(){
            getProfile();
        });
        function getProfile(){
            let accessToken = '{{"Bearer ".$user["accessToken"]}}';
            $("#product").addClass("hidden");
            loadingScreenBefore();

            $.ajax({
                url: "https://dummyjson.com/auth/me",
                type: "GET",
                headers: {
                    "Authorization": accessToken
                },
                dataType: "json",
                success: function (data) {

                    $("#response").removeClass("hidden");
                    $("#userRole").text(data.role.toUpperCase());
                    $("#userName").text(data.firstName + " " + data.lastName);
                    $("#userEmail").text(data.email);
                    $("#userGender").text(data.gender);
                    $("#userImage").attr("src", data.image);
                    $("#userPhone").text(data.phone);

                    $("#userCard").removeClass("d-none"); // Show card

                    Swal.close();
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    showError();
                }
            });
        }

        let table;
        function productTable(){
            table = $('#productsTable').DataTable({
                processing: true,
                serverSide: false, // Since we're getting data from an external API, we don't need server-side processing
                ajax: {
                    url: "{{ route('product') }}", // The AJAX route
                    type: 'GET'
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'name' },
                    { data: 'price', name: 'price' },
                    { data: 'category', name: 'category' },
                    { data: 'stock', name: 'stock' }
                ]
            });
        }
        $('#getProduct').on('click', function(){
            $("#response").addClass("hidden");
            // If DataTable is already initialized, destroy it and reinitialize
            if ($.fn.dataTable.isDataTable('#productsTable')) {
                // Clear the current data in the table
                table.clear();

                // Reload the data by redrawing the table
                table.ajax.reload();
            } else {
                productTable();
            }

            $("#product").removeClass("hidden");

        });
    @endif

    function loadingScreenBefore(){
        Swal.fire({
            title: 'Fetching data...',
            text: 'Please wait while we retrieve the data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    }

    function showError(){
        // Show error alert
        Swal.fire({
            title: 'Error!',
            text: 'Failed to fetch data. Please try again.',
            icon: 'error'
        });
    }

</script>
</html>
