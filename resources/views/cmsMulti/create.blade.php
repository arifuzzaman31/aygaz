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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Category List</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin-cms') }}" class="text-muted text-hover-primary">CMS</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-dark">CMS edit</li>
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
                    <div class="card-header border-0 ">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Update Cms</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <div class="rounded border p-10">
                        <!--begin::Content-->
                        <div id="" class="collapse show">
                            <!--begin::Form-->
                            <form class="form" action="{{ Route('admin-createMulti', $cms->id) }}" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name='c_id' value="{{ $cms->id }}">
                                <!--begin::Card body-->
                                <div class="card-body border-top p-9">
                                    <!--begin::Input group-->
                                    {{-- <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Slug</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="slug"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Slug"
                                            value="{{ old('slug') != '' ? old('slug') : $cms->slug }}" disabled />
                                        <!--end::Input-->
                                        <span class="help-block"></span>
                                    </div> --}}
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    {{-- <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="required fw-bold fs-6 mb-2">Page Name</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="page_name"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Page Name"
                                            value="{{ old('page_name') != '' ? old('page_name') : $cms->page_name }}" />
                                        <!--end::Input-->
                                        <span class="help-block"></span>
                                    </div> --}}

                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-bold fs-6 mb-2">Link</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="link"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Link"
                                            value="" />
                                        <!--end::Input-->
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fw-bold fs-6 mb-2">Backgraound Color</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <input type="color" id="head" name="bg_color" value="#e66465">
                                            <label for="head">Select Color</label>
                                        </div>
                                        {{-- <input type="text" name="page_name"
                                            class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Page Name"
                                            value="{{ old('page_name') != '' ? old('page_name') : $cms[0]->page_name }}" /> --}}
                                        <!--end::Input-->
                                        {{-- <span class="help-block"></span> --}}
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <!--end::Input group-->
                                    {{-- @if ($cms->type == '2') --}}
                                    <!--begin::Input group-->
                                    <div class="mb-7">
                                        <!--begin::Label-->
                                        <label class="required col-lg-4 col-form-label fw-bold fs-6">Image</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            @php
                                                if ($cms->image != '') {
                                                    $image = URL::asset('public/uploads/frontend/cms/pictures/original/' . $cms->image);
                                                } else {
                                                    $image = URL::asset('public/backend/assets/media/avatars/blank.png');
                                                }
                                            @endphp
                                            <!--begin::Image input-->
                                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                                style="background-image: url('{{ $image }}')">
                                                <!--begin::Preview existing avatar-->
                                                <div class="image-input-wrapper w-125px h-125px"
                                                    style="background-image: url({{ $image }})"></div>
                                                <!--end::Preview existing avatar-->
                                                <!--begin::Label-->
                                                <label
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                    title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <!--begin::Inputs-->
                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                    <!--end::Inputs-->

                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Cancel-->
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                    title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <!--end::Cancel-->

                                            </div>
                                            <!--end::Image input-->
                                            <!--begin::Hint-->
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                            <!--end::Hint-->
                                            <span class="help-block"></span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Input group-->
                                    {{-- @endif --}}
                                </div>
                                <!--end::Card body-->
                                {{-- @if ($cms->type == '1') --}}
                                <!--begin::Accordion-->
                                <div class="accordion" id="kt_accordion_1">
                                    @foreach ($lang as $language)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="kt_accordion_1_header_{{ $loop->iteration }}">
                                                <button
                                                    class="accordion-button fs-4 fw-bold {{ $loop->iteration === 1 ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#kt_accordion_1_body_{{ $loop->iteration }}"
                                                    aria-expanded="true"
                                                    aria-controls="kt_accordion_1_body_{{ $loop->iteration }}">
                                                    {{ ucfirst($language->lang_code) . ' (' . $language->lang_code . ')' }}
                                                </button>
                                            </h2>
                                            <div id="kt_accordion_1_body_{{ $loop->iteration }}"
                                                class="accordion-collapse collapse {{ $loop->iteration === 1 ? 'show' : '' }}"
                                                aria-labelledby="kt_accordion_1_header_{{ $loop->iteration }}"
                                                data-bs-parent="#kt_accordion_1">
                                                <div class="accordion-body">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-bold fs-6 mb-2">Title</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <input type="text" name="{{ $language->lang_code }}title"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            placeholder="Title" value="" />
                                                        <!--end::Input-->
                                                        <span class="help-block"></span>
                                                    </div>

                                                    <div class="fv-row mb-7">
                                                        <!--begin::Label-->
                                                        <label class="required fw-bold fs-6 mb-2">Description
                                                            ({{ $language->lang_code }})
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <textarea class="form-control editor" id="editer{{ $loop->iteration }}" name="{{ $language->lang_code }}"
                                                            placeholder="Content"></textarea>
                                                        <!--end::Input-->
                                                        <span class="help-block"></span>
                                                    </div>
                                                    <!--end::Input group-->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @csrf
                                <!--end::Accordion-->
                                {{-- @endif --}}
                                <!--begin::Actions-->
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <!--<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>-->
                                    <button type="submit" class="btn btn-primary" id="">
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
                })
                .then(editor => {
                    allCkEditors.push(editor);
                })
                .catch(err => {
                    console.error(err.stack);
                });
        }
    </script>
    <script src="{{ URL::asset('public/backend/assets/js/custom/apps/cms/edit.js') }}"></script>
@stop
