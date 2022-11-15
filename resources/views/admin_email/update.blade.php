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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Email List</h1>
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
                    
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('adminemail')}}" class="text-muted text-hover-primary">Email</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Email edit</li>
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
                        <h3 class="fw-bolder m-0">Update Email</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <div class="rounded border p-10">
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form_eml" class="form" action="{{ Route('admin-updateeml', ['id' => $model[0]->id]) }}">
                        <input type="hidden" name='id' value="{{$model[0]->id}}">
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">About</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="about" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Slug" value="{{ (old('about') != "") ? old('about') : $model[0]->about }}"  />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Subject  </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="subject" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Page Name" value="{{ (old('subject') != "") ? old('subject') : $model[0]->subject }}"/>
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->

                              <!--begin::Input group-->
                              <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Variable  </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <u   disabled  class="form-control form-control-solid mb-3 mb-lg-0" >
                                    {!!$model[0]->variable !!}
                                    
                                </u>
                                
                                <!--end::Input-->
                                <span class="text-danger">**Please don't change above variable in the Variable section</span>
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Body  </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                 <!--begin::Input-->
                                 <textarea name='body' id="editor" placeholder="body">{{ (old('body') != "") ? old('body') : $model[0]->body }}</textarea>
                                 <!--end::Input-->

                                {{-- <input type="text" name="body" id="editor" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Page Name" value="{{ (old('body') != "") ? old('body') : $model[0]->body }}"/> --}}
                                <!--end::Input-->
                                <span class="help-block"></span>
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

<script src="{{ URL::asset('public/backend/assets/js/custom/apps/admin_email/edit.js')}}"></script>
<script>
    var myEditor;
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
                        myEditor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
</script>
@stop