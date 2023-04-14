@extends('admin.layouts.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/css/image-previewer.css')}}" type="text/css" />
@stop

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Banner']])
        <!-- end page title -->

        <div class="row" id="image-container">
            @include('admin.includes.back_button', ['link'=>route('project_list.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project_banner.post', $project_id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Project Banner Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'heading', 'label'=>'Heading', 'value'=>!empty($data) ? (old('heading') ? old('heading') : $data->heading) : old('heading')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'sub_heading', 'label'=>'Sub-Heading', 'value'=>!empty($data) ? (old('sub_heading') ? old('sub_heading') : $data->sub_heading) : old('sub_heading')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.file_input', ['key'=>'banner_image', 'label'=>'Banner Image'])
                                        @if(!empty($data->banner_image_link))
                                            <img src="{{$data->banner_image_link}}" alt="" style="height:80px; object-fit:contain;">
                                        @endif
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'points', 'label'=>'Points', 'value'=>!empty($data) ? (old('points') ? old('points') : $data->points) : old('points')])
                                        <p>
                                            <code>Note : </code> Use | seperated points. eg: <i> test1| test2 </i>
                                        </p>
                                    </div>

                                    <!--end col-->
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Save</button>
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
  .addField('#heading', [
    {
      rule: 'required',
      errorMessage: 'Heading is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Heading is invalid',
    },
  ])
  .addField('#sub_heading', [
    {
      rule: 'required',
      errorMessage: 'Sub-Heading is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Sub-Heading is invalid',
    },
  ])
  .addField('#points', [
    {
      rule: 'required',
      errorMessage: 'Points is required',
    },
  ])
  .addField('#banner_image', [
    {
        rule: 'minFilesCount',
        value: 0,
        errorMessage: 'Please select a banner image',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid banner image',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

<script src="{{ asset('admin/js/pages/img-previewer.min.js') }}"></script>
<script>
    const myViewer = new ImgPreviewer('#image-container',{
      // aspect ratio of image
        fillRatio: 0.9,
        // attribute that holds the image
        dataUrlKey: 'src',
        // additional styles
        style: {
            modalOpacity: 0.6,
            headerOpacity: 0,
            zIndex: 99
        },
        // zoom options
        imageZoom: {
            min: 0.1,
            max: 5,
            step: 0.1
        },
        // detect whether the parent element of the image is hidden by the css style
        bubblingLevel: 0,

    });
</script>

@stop
