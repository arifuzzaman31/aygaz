<!DOCTYPE html>
<html lang="en">

<head>
    <script type="text/javascript">
        var full_path = '<?= url('/') . '/' ?>';
        var base_path = '<?= url('/') . '' ?>';
    </script>
    <meta charset="UTF-8">
    <title>{{ env('PROJECT_NAME', 'WorknHour') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ URL::asset('public/backend/assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ URL::asset('public/backend/assets/plugins/custom/datatables/datatables.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('public/backend/assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ URL::asset('public/backend/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('public/backend/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script src="{{ URL::asset('public/backend/assets/js/jquery-3.6.0.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Ads: 10941292230 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-10941292230"></script>
    <script>
        window.dataLayer = window.dataLayer || \[\];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-10941292230');
    </script>
    @yield('css')
    <script>
        document.addEventListener('click', function(e) {
            if (e.target.matches('button\[type="submit"\] , \[type="submit"\] \*')) {
                var timer = setInterval(function() {
                    if (document.querySelector('\[class="swal2-icon swal2-success swal2-icon-show"\]')) {
                        gtag('event', 'conversion', {
                            'send\_to': 'AW-10941292230/YqUZCIys\_MwDEMa9m-Eo'
                        });
                        clearInterval(timer);
                    }
                }, 1000);
            }
        })
    </script>
</head>

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
    style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
                data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Brand-->
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <!--begin::Logo-->
                    <a href="{{ route('admin-dashboard') }}">
                        <img alt="Logo" src="{{ URL::asset('public/backend/assets/media/logos/logo-1-dark.svg') }}"
                            class="h-25px logo" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Aside toggler-->
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                        data-kt-toggle-name="aside-minimize">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="black" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Aside toggler-->
                </div>
                <!--end::Brand-->
                @include('partials.left')
            </div>
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Wrapper-->
                @include('partials.header')
                <!--begin::Content-->
                @yield('content')
                <!--begin::Footer-->
                @include('partials.footer')
                <!--end::Footer-->
            </div>
        </div>
    </div>
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ URL::asset('public/backend/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ URL::asset('public/backend/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ URL::asset('public/backend/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/apps/blog/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Page Custom Javascript-->
    @yield('js')
    <!--end::Javascript-->

</body>

</html>
