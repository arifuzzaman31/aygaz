<html lang="en">
    <head>
        <script type="text/javascript">
            var full_path = '<?= url('/') . '/'; ?>';
        </script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
        <link rel="shortcut icon" href="{{ URL::asset('public/backend/assets/media/logos/favicon.ico')}}" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ URL::asset('public/backend/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/backend/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    </head>
    <body id="kt_body" class="bg-body">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
                <!--begin::Authentication - Sign-in -->
                <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                        <!--begin::Aside-->
                        <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                                        <!--begin::Content-->
                                        <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                                                <!--begin::Logo-->
                                                <a href="../../demo1/dist/index.html" class="py-9 mb-5">
                                                        <img alt="Logo" src="{{ URL::asset('public/backend/assets/media/logos/logo-2.svg')}}" class="h-60px" />
                                                </a>
                                                <!--end::Logo-->
                                                <!--begin::Title-->
                                                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to {{env('PROJECT_NAME', 'GRC')}} Admin</h1>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing {{env('PROJECT_NAME', 'GRC')}}
                                                <br />with great build tools</p>
                                                <!--end::Description-->
                                        </div>
                                        <!--end::Content-->
                                        <!--begin::Illustration-->
                                        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ URL::asset('public/backend/assets/media/illustrations/sketchy-1/13.png')}}"></div>
                                        <!--end::Illustration-->
                                </div>
                                <!--end::Wrapper-->
                        </div>
                        <!--end::Aside-->
                        <!--begin::Body-->
                        @yield('content')
                        
                        <!--end::Body-->
                </div>
                <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Root-->
        <!--end::Main-->
        <!--begin::Javascript-->
        <script>var hostUrl = "assets/";</script>
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{ URL::asset('public/backend/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{ URL::asset('public/backend/assets/js/scripts.bundle.js')}}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="{{ URL::asset('public/backend/assets/js/custom/authentication/sign-in/general.js')}}"></script>
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    </body>
</html>