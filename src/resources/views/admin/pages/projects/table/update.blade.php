@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Table', 'Update']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('project_table_list.get', $data->project_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project_table_update.post', [$project_id, $data->id])}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Project Table Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'unit', 'label'=>'Unit', 'value'=>old('unit') ? old('unit') : $data->unit])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'type', 'label'=>'Type', 'value'=>old('type') ? old('type') : $data->type])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Update</button>
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
  .addField('#unit', [
    {
      rule: 'required',
      errorMessage: 'Unit is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Unit is invalid',
    },
  ])
  .addField('#type', [
    {
      rule: 'required',
      errorMessage: 'Type is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Type is invalid',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

@stop
