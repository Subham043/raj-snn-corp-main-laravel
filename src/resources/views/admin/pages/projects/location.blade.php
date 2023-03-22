@extends('admin.layouts.dashboard')

@section('css')
<link href="{{ asset('admin/libs/quill/quill.core.css' ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/libs/quill/quill.bubble.css' ) }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/libs/quill/quill.snow.css' ) }}" rel="stylesheet" type="text/css" />

<style>
    #description_quill{
        min-height: 200px;
    }
</style>
@stop


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Location']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('project_list.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project_location.post', $project_id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Project Location Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'location_heading', 'label'=>'Heading', 'value'=>!empty($project) ? $project->location_heading : old('location_heading')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'location', 'label'=>'Location', 'value'=>!empty($data) ? $data->location : old('location')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.file_input', ['key'=>'map_image', 'label'=>'Map Image'])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.quill', ['key'=>'description', 'label'=>'Description', 'value'=>!empty($data) ? $data->description : old('description')])
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

<script src="{{ asset('admin/libs/quill/quill.min.js' ) }}"></script>

<script type="text/javascript">

var quillDescription = new Quill('#description_quill', {
    theme: 'snow'
});

quillDescription.on('text-change', function(delta, oldDelta, source) {
  if (source == 'user') {
    document.getElementById('description').value = quillDescription.root.innerHTML
  }
});

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#location_heading', [
    {
      rule: 'required',
      errorMessage: 'Heading is required',
    },
  ])
  .addField('#location', [
    {
      rule: 'required',
      errorMessage: 'Location is required',
    },
  ])
  .addField('#description', [
    {
      rule: 'required',
      errorMessage: 'Description is required',
    },
  ])
  .addField('#map_image', [
    {
        rule: 'minFilesCount',
        value: 1,
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

@stop
