<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Commerce | @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('formValidation/css/formValidation.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?ver=1.1">

    @yield('PageCss')
    <style>
        .note-editor.note-frame.card, .note-editing-area {
            height: 350px;
        }
        .hidden{
            display: none;
        }
        .upload-block{
            width: 100%;
            border: double 2px #fcb415;
            height: 100%;
            text-align: center;
            padding: .7rem;
            border-radius: 5px;
            margin: 0 auto;
        }
        .upload-block i{
            font-size: 2rem;
            color: #fcb415;
            display: block;
        }
        .upload-block span{
            font-size: .6rem;
            color: #fcb415;
        }
        .img-thumbnail {
            padding: .25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            box-shadow: 0 1px 2px rgb(0 0 0 / 8%);
            width: 300%;
            height: 200px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layouts.admin.includes.app_header')

        @include('layouts.admin.includes.app_sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('layouts.admin.includes.app_modal')
        @include('layouts.admin.includes.app_footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('formValidation/js/formValidation.js') }}"></script>
    <script src="{{ asset('formValidation/js/framework/bootstrap.min.js') }}"></script>
    <script src="{{ asset('formValidation/js/globalValidationCustom.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/image_preview.js') }}"></script>



    @yield('PageJs')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    <script>
        $(function () {
            $.widget.bridge('uibutton', $.ui.button)
        })
        $('.btn-delete').on('click', function (e){
            e.preventDefault();
            console.log('sdfasdf');
            $('#deleteModal').find('form').attr('action', $(this).data('href'));
            $('#deleteModal').modal('show');
        })
    </script>
</body>
</html>
