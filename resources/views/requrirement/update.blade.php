@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/backend/assets/js/custom/dropzone/dropzone.css')}}" rel="stylesheet" type="text/css" />
<style>
    .help-block{
        color:#f1416c;
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
                    <li class="breadcrumb-item text-dark">Requrirement edit</li>
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
                        <h3 class="fw-bolder m-0">Update service provider</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="request_update_form" class="form" action="{{route('admin-updaterequest')}}" enctype="multipart/form-data">
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
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Add Title</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Add Title" value="{{ (old('title') != "") ? old('title') : $model->title }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Description</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea name="description" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Give short descriptions of your requirement here"/>{{ (old('description') != "") ? old('description') : $model->description }}</textarea>
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-7 row">
                            <div class="form-group {{ $errors->has('AllImages') ? ' has-error' : '' }}">
                                <label class="required fw-bold fs-6 mb-2">Product Image</label>
                                <div class="col-md-12">
                                <input type="hidden" name="AllImages[is_default]" id="is_default" value="0">
                                <div class="product-image"></div>
                                <div class="image_upload_div" style="display: none;">
                                    <form action="" method="post" class="dropzone" id="my-dropzone">
                                        @csrf
                                    </form>
                                </div>
                                <div class="image_upload_div" style="width: 100%;">
                                    <form action="{{ Route('admin-request-photo') }}" method="post" class="dropzone" id="my-dropzone">
                                        @csrf
                                    </form>
                                </div>
                                </div>
                                <span class="help-block help-allimgaes"></span>
                            </div>
                            </div>
                             <!--begin::Input group-->
                             <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Add Deadline</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="date" name="deadline" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Add Deadline" value="{{ (old('deadline') != "") ? old('deadline') : $model->deadline }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <div class="moc">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 Budget">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Add Your Budget</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="budget" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Add Your Budget" value="{{ (old('budget') != "") ? old('budget') : $model->budget }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                             <div class="fv-row mb-7 Phone">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Phone</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="phone" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Phone" value="{{ (old('phone') != "") ? old('phone') : $model->phone }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>

                            </div>

                            <!--end::Input group-->
                             <div class="moc">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 mail">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Email" value="{{ (old('email') != "") ? old('email') : $model->email }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                           
                            <!--begin::Input group-->
                             <div class="fv-row mb-7 Name">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">Name</label>
                                <!--end::Label-->
                               
                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Name" value="{{ (old('name') != "") ? old('name') : $model->name }}" />
                                <!--end::Input-->
                                </div>

                                <span class="help-block"></span>

                            </div>
                            <!--end::Input group-->
                            <div class="moc">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 addres">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2 ">Address</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="address" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Address" value="{{ (old('address') != "") ? old('address') : $model->address }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7 zip">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">ZIP Code</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="zipcode" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ZIP Code" value="{{ (old('zipcode') != "") ? old('zipcode') : $model->zipcode }}" />
                                <!--end::Input-->
                                <span class="help-block"></span>
                            </div>
                            </div>
                            <!--end::Input group-->
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label class="required fw-bold">Status</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="1" {{ ($model->status == '1') ? 'checked' : '' }}> Active
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="0" {{ ($model->status == '0') ? 'checked' : '' }}> Inactive
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" value="2" {{ ($model->status == '2') ? 'checked' : '' }}> Publish
                                        </label>
                                    </div>
                                </div>
                                <span class="help-status help-block"></span>
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!--<button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>-->
                            <button type="submit" class="btn btn-primary" id="t_request_update_btn">
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
{{-- <script src="{{ URL::asset('public/backend/assets/js/custom/apps/requrirement/edit.js')}}"></script> --}}
<script src="{{ URL::asset('public/backend/assets/js/custom/dropzone/dropzone.js')}}"></script>
<script>
    function removehidden(id) {
  var csrf_token = $('meta[name=csrf-token]').attr('content');
  var r_file_name = $("#image_" + id).val();
  $("#image_" + id).remove();
  if ($('.product-image').html() === '' || $('#img_' + id).is(":checked")) {
      $('#is_default').val('0');
  }
  $('.side-images').find('#is_side_' + id).remove();
  $.ajax({
      url: full_path + 'remove-request-image',
      headers: {'X-CSRF-TOKEN': csrf_token},
      type: 'POST',
      dataType: 'json',
      data: {file_name: r_file_name},
      success: function (resp) {}
  });
}

if ($('[name="bid"]').val() != "" && $('#my-dropzone').length > 0) {
    var a = 0;
    Dropzone.options.myDropzone = {
        init: function () {
            thisDropzone = this;
            if (a == 0) {
                $.ajax({
                    type: 'GET',
                    url: full_path + 'show-request-images',
                    dataType: 'json',
                    data: {bid: $('[name="bid"]').val()},
                    success: function (data) {
                        if (data.res == 1) {
                            $.each(data.images, function (key, value) {
                                var mockFile = {name: value.name, size: value.size};
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, (full_path + '/public/uploads/admin/request_image/original/') + value.name);
                                
                                thisDropzone.emit("complete", mockFile);
                                var html = '<input type="hidden" name="AllImages[image][]" id="image_' + key + '" value=' + value.name + '><input type="hidden" name="AllImages[filetype_][]" id="filetype_' + key + '" value=' + value.file_type + '>';
                                $('.product-image').append(html);
                                if (value.is_default == 1) {
                                    $('#img_' + key).attr("checked", true);
                                    $('#side_img_' + key).prop("checked", false).attr('disabled', true);
                                    $('#is_default').val(key);
                                }
                            });
                        }
                    }
                });
                a = 1;
            }
        }
    };
}
</script>


<script>
    $(document).on('click', '#t_request_update_btn', function (event) {
        event.preventDefault();
        // ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $('#request_update_form').attr('action');
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var data = new FormData($('#request_update_form')[0]);
        // data.append('description', $('[name="description"]').val());
        data.append('status', $('[name="status"]:checked').val() ? $('[name="status"]:checked').val() : '');
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if(resp.status=="400")
                {
                Swal.fire({
                    text: resp.msg,
                    icon: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" },
                  });
                  
               }else{
                Swal.fire({
                    text: resp.msg,
                    icon: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Ok, got it!",
                    customClass: { confirmButton: "btn btn-primary" },
                  }).then(function (e) {
                    if(e.isConfirmed){
                        location.reload();
                    }
                  });
                }
                // ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.error, function (key, val) {
                    if (key == 'AllImages') {
                        $('.help-allimgaes').html(val[0]);
                        $('#request_update_form .allim').addClass('has-error');
                    } else if (key == 'status') {
                        $('.help-status').html(val[0]);
                        $('.help-status').closest('.form-group').addClass('has-error');
                    } else {
                        $('#request_update_form').find('[name="' + key + '"]').closest('.fv-row').find('.help-block').html(val[0]);
                        $('#request_update_form').find('[name="' + key + '"]').closest('.fv-row').addClass('has-error');
                    }

                });
                // ajaxindicatorstop();
            }
        });
    });
</script>
@stop