@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Create']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('project_list.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project_create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Project Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'name', 'label'=>'Project Name', 'value'=>old('name')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'slug', 'label'=>'Project Slug', 'value'=>old('slug')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'email', 'label'=>'Project Email', 'value'=>old('email')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'phone', 'label'=>'Project Phone', 'value'=>old('phone')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'address', 'label'=>'Project Address', 'value'=>old('address')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'header_logo', 'label'=>'Header Logo'])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'footer_logo', 'label'=>'Footer Logo'])
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRightDisabled" name="project_status" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckRightDisabled">Project Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRightDisabled2" name="publish_status" checked>
                                                    <label class="form-check-label" for="flexSwitchCheckRightDisabled2">Publish Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!--end col-->

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Social Media</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'facebook', 'label'=>'Facebook', 'value'=>old('facebook')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'instagram', 'label'=>'Instagram', 'value'=>old('instagram')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'youtube', 'label'=>'Youtube', 'value'=>old('youtube')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'linkedin', 'label'=>'Linkedin', 'value'=>old('linkedin')])
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">SEO Details</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_title', 'label'=>'Meta Title', 'value'=>old('meta_title')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_description', 'label'=>'Meta Description', 'value'=>old('meta_description')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_locale', 'label'=>'Og Locale', 'value'=>old('og_locale')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_type', 'label'=>'Og Type', 'value'=>old('og_type')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_description', 'label'=>'Og Description', 'value'=>old('og_description')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_site_name', 'label'=>'Og Site Name', 'value'=>old('og_site_name')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.file_input', ['key'=>'og_image', 'label'=>'Og Image'])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_header', 'label'=>'Meta Header', 'value'=>old('meta_header')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_footer', 'label'=>'Meta Footer', 'value'=>old('meta_footer')])
                                    </div>


                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Create</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <!--end col-->
        </div>
        <!--end row-->



    </div> <!-- container-fluid -->
</div><!-- End Page-content -->



@stop


@section('javascript')


<script type="text/javascript">

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#name', [
    {
      rule: 'required',
      errorMessage: 'Project Name is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Project Name is invalid',
    },
  ])
  .addField('#slug', [
    {
      rule: 'required',
      errorMessage: 'Project Slug is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Project Slug is invalid',
    },
  ])
  .addField('#phone', [
    {
        rule: 'customRegexp',
        value: /^[0-9]*$/,
        errorMessage: 'Project Phone is invalid',
    },
  ])
  .addField('#address', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Project Address is invalid',
    },
  ])
  .addField('#facebook', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Facebook is invalid',
    },
  ])
  .addField('#instagram', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Instagram is invalid',
    },
  ])
  .addField('#youtube', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Youtube is invalid',
    },
  ])
  .addField('#linkedin', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Linkedin is invalid',
    },
  ])
  .addField('#header_logo', [
    {
        rule: 'minFilesCount',
        value: 1,
        errorMessage: 'Please select a header logo',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid header logo',
    },
  ])
  .addField('#footer_logo', [
    {
        rule: 'minFilesCount',
        value: 1,
        errorMessage: 'Please select a footer logo',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid footer logo',
    },
  ])
  .addField('#og_image', [
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid og image',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

@stop
