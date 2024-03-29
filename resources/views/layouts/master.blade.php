<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Page Title -->
    <title>@yield('title')</title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">


    <!-- ======= BEGIN GLOBAL MANDATORY STYLES ======= -->
    <link href="{{asset('public/assets')}}/css/material-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="{{asset('public/assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.css"/>
    <!-- ======= END BEGIN GLOBAL MANDATORY STYLES ======= -->

    <!-- ======= BEGIN PAGE LEVEL PLUGINS STYLES ======= -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/apex/apexcharts.css"/>
    <link rel="stylesheet" href="{{asset('public/assets')}}/plugins/select2/select2.min.css"/>
    <!-- ======= END BEGIN PAGE LEVEL PLUGINS STYLES ======= -->

    <link rel="stylesheet" href="{{asset('public/assets')}}/css/toastr.css">

    <!-- ======= MAIN STYLES ======= -->
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/assets')}}/css/dev.css"/>
    <!-- ======= END MAIN STYLES ======= -->

    @stack('css_or_js')
</head>

<body>
<script>
    localStorage.theme && document.querySelector('body').setAttribute("theme", localStorage.theme);
    localStorage.dir && document.querySelector('html').setAttribute("dir", localStorage.dir);
</script>

<!-- Offcanval Overlay -->
<div class="offcanvas-overlay"></div>
<!-- Offcanval Overlay -->

<!-- Preloader -->
<!-- <div class="preloader"></div> -->
<!-- End Preloader -->

<!-- Header -->
@include('layouts.partials._header')
<!-- End Header -->

<!-- Aside -->
@include('layouts.partials._aside')
<!-- End Aside -->



<!-- Wrapper -->
<main class="main-area">
    <!-- Main Content -->
@yield('content')
<!-- End Main Content -->

    <!-- Footer -->
@include('layouts.partials._footer')
<!-- End Footer -->
</main>
<!-- End wrapper -->

<!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->
<script src="{{asset('public/assets')}}/js/jquery-3.6.0.min.js"></script>
<script src="{{asset('public/assets')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/assets')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('public/assets')}}/js/main.js"></script>
<!-- ======= BEGIN GLOBAL MANDATORY SCRIPTS ======= -->

<!-- ======= BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
<script src="{{asset('public/assets')}}/plugins/select2/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.js-select').select2();
    });
</script>

{{--toastr and sweetalert--}}
<script src="{{asset('public/assets')}}/js/sweet_alert.js"></script>
<script src="{{asset('public/assets')}}/js/toastr.js"></script>
<script src="{{asset('public/assets')}}/js/dev.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    function form_alert(id, message) {
        Swal.fire({
            title: "are_you_sure",
            text: message,
            type: 'warning',
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonColor: 'var(--c2)',
            confirmButtonColor: 'var(--c1)',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#' + id).submit()
            }
        })
    }

    function route_alert(route, message) {
        Swal.fire({
            title: "are_you_sure",
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'var(--c2)',
            confirmButtonColor: 'var(--c1)',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.get({
                    url: route,
                    dataType: 'json',
                    data: {},
                    beforeSend: function () {
                        /*$('#loading').show();*/
                    },
                    success: function (data) {
                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    },
                    complete: function () {
                        /*$('#loading').hide();*/
                    },
                });
            }
        })
    }

    function route_alert_reload(route, message, reload = true) {
        Swal.fire({
            title: "are_you_sure",
            text: message,
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'var(--c2)',
            confirmButtonColor: 'var(--c1)',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.get({
                    url: route,
                    dataType: 'json',
                    data: {},
                    beforeSend: function () {
                        /*$('#loading').show();*/
                    },
                    success: function (data) {
                        if (reload) {
                            setTimeout(location.reload.bind(location), 1000);
                        }
                        toastr.success(data.message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    },
                    complete: function () {
                        /*$('#loading').hide();*/
                    },
                });
            }
        })
    }
</script>

<script>
    $("#search-form__input").on("keyup", function () {
        var value = this.value.toLowerCase().trim();
        $(".show-search-result a").show().filter(function () {
            return $(this).text().toLowerCase().trim().indexOf(value) == -1;
        }).hide();
    });


</script>

@stack('script')
<!-- ======= End BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS ======= -->
</body>

</html>
