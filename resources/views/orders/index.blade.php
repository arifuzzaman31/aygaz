@extends('layouts.main')
@section('css')
    <style>
        .help-block {
            width: 100%;
            margin-top: 0.5rem;
            font-size: .925rem;
            color: #f1416c;
        }
    </style>
@stop
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Orders List</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin-dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Orders</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">Orders List</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            {{-- <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-category-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search category" />
                        </div> --}}
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-category-table-toolbar="base">
                                <!--begin::Add category-->
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_category">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Add Cylinder</button> --}}
                                <!--end::Add category-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-category-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <span class="me-2" data-kt-category-table-select="selected_count"></span>Selected
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-category-table-select="delete_selected">Delete Selected</button>
                            </div>
                            <!--end::Group actions-->
                            <!--begin::Modal - Add task-->
                            <div class="modal fade" id="kt_modal_add_category" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" role="dialog" aria-labelledby="kt_modal_add_category" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content">
                                        <!--begin::Modal header-->
                                        <div class="modal-header" id="kt_modal_add_category_header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder" id="add-cylinder">View Order Details</h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                                                aria-label="Close">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                            height="2" rx="1" transform="rotate(-45 6 17.3137)"
                                                            fill="black" />
                                                        <rect x="7.41422" y="6" width="16" height="2"
                                                            rx="1" transform="rotate(45 7.41422 6)"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--end::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                            <!--begin::DataShow-->
                                            <p style="display: inline-block;">Service Type: -
                                            <h5 style="display: inline-block;" id="type"> </h5>
                                            </p>
                                            <p style="display: inline-block;">Cylinder Weight: -
                                            <h5 style="display: inline-block;" id="weight"> </h5>
                                            </p>
                                            <p style="display: inline-block;">Cylinder Price: -
                                            <h5 style="display: inline-block;" id="price"> </h5>
                                            </p>
                                            <hr>
                                            <p style="display: inline-block;">Name: -
                                            <h5 style="display: inline-block;" id="name"> </h5>
                                            </p>
                                            <p style="display: inline-block;">phone: -
                                            <h5 style="display: inline-block;" id="phone"></h5>
                                            </p>
                                            <p style="display: inline-block;">address: -
                                            <h5 style="display: inline-block;" id="address"></h5>
                                            </p>
                                            <p style="display: inline-block;">thana: -
                                            <h5 style="display: inline-block;" id="thana"></h5>
                                            </p>
                                            <p style="display: inline-block;">district: -
                                            <h5 style="display: inline-block;" id="district"></h5>
                                            </p>
                                            <p style="display: inline-block;">message: -
                                            <h5 style="display: inline-block;" id="message"></h5>
                                            </p>
                                            <p style="display: inline-block;">created_at: -
                                            <h5 style="display: inline-block;" id="create_at"></h5>
                                            </p>
                                            <!--end::DataShow-->
                                            <form action="{{ Route('admin_order_status') }}" method="post"
                                                style="display: flex;justify-content: space-evenly;align-items: center;">
                                                @csrf
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="1" id="flexRadioDefault1">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        Accepted
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="0" id="flexRadioDefault2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        Rejected
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="hidden" id="req_id" name="id" value="">
                                                    <input type="submit" value="update Status" class="btn btn-info">
                                                </div>
                                            </form>
                                        </div>
                                        <!--end::Modal body-->
                                        {{-- <form id="kt_modal_add_category_form" action="#"></form> --}}

                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Modal - Add task-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        {{-- <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_categorys .form-check-input" value="0" />
                                    </div> --}}
                                    </th>
                                    <th class="min-w-125px">#</th>
                                    <th class="min-w-125px">Cylinder Price</th>
                                    <th class="min-w-125px">Cylinder WEIGHT</th>
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Phone</th>
                                    <th class="min-w-125px">Created Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                                {{-- {{ $orders }} --}}

                                @foreach ($orders as $key => $list)
                                    <tr>
                                        <td></td>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $list->price }} </td>
                                        <td>{{ $list->weight }} KG</td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->phone }}</td>
                                        <td>{{ $list->create_at }}</td>
                                        <td>
                                            <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_category"
                                                onclick="dataEdit({{ json_encode($list) }});">View</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <script>
                        function dataEdit(arr) {
                            // alert( arr.name );
                            $('#type').text(arr.service_type)
                            $('#weight').text(arr.weight)
                            $('#price').text(arr.price)
                            $('#name').text(arr.name)
                            $('#phone').text(arr.phone)
                            $('#address').text(arr.address)
                            $('#thana').text(arr.thana)
                            $('#district').text(arr.district)
                            $('#message').text(arr.message)
                            $('#create_at').text(arr.create_at)

                            $('#req_id').val(arr.id)
                            if (arr.status == 1) {
                                $("#flexRadioDefault1").attr("checked", true);
                            } else {
                                $("#flexRadioDefault2").attr("checked", true);
                            }
                        }
                    </script>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@stop
@section('js')
    <script src="{{ URL::asset('public/backend/assets/js/custom/apps/category-management/table.js') }}"></script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/apps/category-management/add.js') }}"></script>
    </script>
@stop
