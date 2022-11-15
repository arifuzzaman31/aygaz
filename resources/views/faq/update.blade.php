@extends('layouts.main')
@section('css')
<style>
    .help-block{
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
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">FAQ List</h1>
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
                        <a href="{{route('admin-faqs')}}" class="text-muted text-hover-primary">FAQ</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">FAQ edit</li>
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
                        <h3 class="fw-bolder m-0">Update faq</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <div class="rounded border p-10">
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" action="{{route('admin-updatefaq')}}">
                        <input type="hidden" name='c_id' value="{{$c_id}}">
                        <!--begin::Accordion-->
                        <div class="accordion" id="kt_accordion_1">
                            @foreach($languages as $language)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_{{$loop->iteration}}">
                                    <button class="accordion-button fs-4 fw-bold {{$loop->iteration===1?'':'collapsed'}}" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_{{$loop->iteration}}" aria-expanded="true" aria-controls="kt_accordion_1_body_{{$loop->iteration}}">
                                        {{ucfirst($language->lang).' ('.$language->lang_code.')'}}
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_{{$loop->iteration}}" class="accordion-collapse collapse {{$loop->iteration===1?'show':''}}" aria-labelledby="kt_accordion_1_header_{{$loop->iteration}}" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Question ({{$language->lang_code}})</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="question_{{$language->lang_code}}" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Category name" value="{{$language->question}}" />
                                            <!--end::Input-->
                                            <span class="help-block"></span>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="required fw-bold fs-6 mb-2">Answer ({{$language->lang_code}})</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea type="text" name="answer_{{$language->lang_code}}" class="form-control form-control-solid mb-3 mb-lg-0 editor" placeholder="Answer">{!! $language->answer !!}</textarea>
                                            <!--end::Input-->
                                            <span class="help-block"></span>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--end::Accordion-->
						<!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-5">Status</label>
                                <!--end::Label-->
                                <!--begin::Roles-->
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="faq_status" type="radio" value="1" id="kt_modal_update_status_option_0" {{($language->status=="1")?"checked":""}} />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_status_option_0">
                                            <div class="fw-bolder text-gray-800">Active</div>
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
                                        <input class="form-check-input me-3" name="faq_status" type="radio" value="0" id="kt_modal_update_status_option_1" {{($language->status=="0")?"checked":""}}/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_status_option_1">
                                            <div class="fw-bolder text-gray-800">Inactive</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                            </div>
                            <!--end::Input group-->
                        </div>
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
<script>
    var allCkEditors = [];
    var allEditors = document.querySelectorAll('.editor');
        for (var i = 0; i < allEditors.length; ++i) {
          ClassicEditor.create(allEditors[i], {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			allCkEditors.push(editor);
		} )
		.catch( err => {
			console.error( err.stack );
		} );
        }
    
</script>
<script src="{{ URL::asset('public/backend/assets/js/custom/apps/faq-management/edit.js')}}"></script>
@stop