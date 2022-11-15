@extends('layouts.main')

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Requrirement</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin-dashboard')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin-request')}}" class="text-muted text-hover-primary">Requrirement</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Requrirement assign service provider</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 " >
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Assign service provider</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" action="{{route('admin-assignrequest')}}">
                        <input type="hidden" name="bid" value="{{$model->id}}">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            {{-- <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-5">Type</label>
                                <!--end::Label-->
                                <!--begin::Roles-->
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="type" type="radio" value="Company" id="kt_modal_update_role_option_0" {{($model->type=="Company")?"checked":""}} />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                            <div class="fw-bolder text-gray-800">Company</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="type" type="radio" value="Indiviual" id="kt_modal_update_role_option_1" {{($model->type=="Indiviual")?"checked":""}}/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bolder text-gray-800">Indiviual</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Roles-->
                            </div>
                            <!--end::Input group--> --}}

                            <!--begin::Input group-->
                            <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <p class="col-md-7">{{$model->title}}</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <p class="col-md-7">{{$model->name}}</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <p class="col-md-7">{{$model->email}}</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                             <!--begin::Input group-->
                             <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Phone</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <p class="col-md-7">{{$model->phone}}</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <p class="col-md-7">{{$model->description}}</p>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 row">
                                <!--begin::Label-->
                                <label class=" fw-bold fs-6 mb-2 col-md-2">Assign Service Provider</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="col-md-5">
                                    <select name="service_provider_id[]" class="form-control form-control-solid select2" id="kt_select2_3" multiple>
                                    <option value="">---Select Service Provider ---</option>
                                    @php
                                        if(!empty($service_provider->service_provider_id)){
                                            $providers= explode(",",$service_provider->service_provider_id);
                                        }
                                        
                                    @endphp
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}" {{!empty($service_provider) ? (in_array($user->id,$service_provider))?"selected":"" :''}}>{{$user->name}}({{$user->email}})</option>
                                    @endforeach
                                </select>
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
             
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!--<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>-->
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@stop
@section('js')
<script src="{{ URL::asset('public/backend/assets/js/custom/apps/requrirement/assign.js')}}"></script>
@stop