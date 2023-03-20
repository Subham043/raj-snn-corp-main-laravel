@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Create']])
        <!-- end page title -->

        <div class="row">
        <div class="row g-4 mb-3">
                <div class="col-sm-auto">
                    <div>
                        <a href="{{route('project_list.get')}}" type="button" class="btn btn-dark add-btn" id="create-btn"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Go Back</a>
                    </div>
                </div>
            </div>
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
                                        <div>
                                            <label for="name" class="form-label">Project Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                                            @error('name')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="slug" class="form-label">Project Slug</label>
                                            <input type="text" class="form-control" name="slug" id="slug" value="{{old('slug')}}">
                                            @error('slug')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="email" class="form-label">Project Email</label>
                                            <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                                            @error('email')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="phone" class="form-label">Project Phone</label>
                                            <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}">
                                            @error('phone')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="address" class="form-label">Project Address</label>
                                            <textarea class="form-control" name="address" id="address">{{old('address')}}</textarea>
                                                @error('address')
                                                    <div class="invalid-message">{{ $message }}</div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="header_logo" class="form-label">Header Logo</label>
                                            <input class="form-control" type="file" name="header_logo" id="header_logo">
                                            @error('header_logo')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="footer_logo" class="form-label">Footer Logo</label>
                                            <input class="form-control" type="file" name="footer_logo" id="footer_logo">
                                            @error('footer_logo')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                        <div>
                                            <label for="facebook" class="form-label">Facebook</label>
                                            <input type="text" class="form-control" name="facebook" id="facebook" value="{{old('facebook')}}">
                                            @error('facebook')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="instagram" class="form-label">Instagram</label>
                                            <input type="text" class="form-control" name="instagram" id="instagram" value="{{old('instagram')}}">
                                            @error('instagram')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="youtube" class="form-label">Youtube</label>
                                            <input type="text" class="form-control" name="youtube" id="youtube" value="{{old('youtube')}}">
                                            @error('youtube')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        <div>
                                            <label for="linkedin" class="form-label">Linkedin</label>
                                            <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{old('linkedin')}}">
                                            @error('linkedin')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                        <div>
                                            <label for="meta_title" class="form-label">Meta Title</label>
                                            <textarea class="form-control" name="meta_title" id="meta_title">{{old('meta_title')}}</textarea>
                                            @error('meta_title')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="meta_description" class="form-label">Meta Description</label>
                                            <textarea class="form-control" name="meta_description" id="meta_description">{{old('meta_description')}}</textarea>
                                            @error('meta_description')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="og_locale" class="form-label">Og Locale</label>
                                            <textarea class="form-control" name="og_locale" id="og_locale">{{old('og_locale')}}</textarea>
                                            @error('og_locale')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="og_type" class="form-label">Og Type</label>
                                            <textarea class="form-control" name="og_type" id="og_type">{{old('og_type')}}</textarea>
                                            @error('og_type')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="og_description" class="form-label">Og Description</label>
                                            <textarea class="form-control" name="og_description" id="og_description">{{old('og_description')}}</textarea>
                                            @error('og_description')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="og_site_name" class="form-label">Og Site Name</label>
                                            <textarea class="form-control" name="og_site_name" id="og_site_name">{{old('og_site_name')}}</textarea>
                                            @error('og_site_name')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <div>
                                            <label for="og_image" class="form-label">Og Image</label>
                                            <input class="form-control" type="file" name="og_image" id="og_image">
                                            @error('og_image')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="meta_header" class="form-label">Meta Header</label>
                                            <textarea class="form-control" name="meta_header" id="meta_header">{{old('meta_header')}}</textarea>
                                            @error('meta_header')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        <div>
                                            <label for="meta_footer" class="form-label">Meta Footer</label>
                                            <textarea class="form-control" name="meta_footer" id="meta_footer">{{old('meta_footer')}}</textarea>
                                            @error('meta_footer')
                                                <div class="invalid-message">{{ $message }}</div>
                                            @enderror
                                        </div>
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
