@extends('admin.layouts.dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/css/image-previewer.css')}}" type="text/css" />
@stop


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['Plan Category', 'Plan Image', 'List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Project Plan Image</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="{{route('project_plan_category_list.get', $project_id)}}" type="button" class="btn btn-dark add-btn" id="create-btn"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Go Back</a>
                                        <a href="{{route('project_plan_image_create.get', [$project_id, $plan_category_id])}}" style="background:green;border-color:green;" type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-add-line align-bottom me-1"></i> Create</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Image</th>
                                            <th class="sort" data-sort="date">Created Date</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all" id="image-container">

                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">
                                                <img src="{{$item->image_link}}" alt="" style="height:80px; object-fit:contain;"></td>
                                            <td class="date">{{$item->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" style="background:red" onclick="deleteHandler('{{route('project_plan_image_delete.get', [$project_id, $plan_category_id, $item->id])}}')">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @else
                                    @include('admin.includes.no_result')
                                @endif
                            </div>

                            @include('admin.includes.pagination', ['data'=>$data])
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

@stop

@section('javascript')

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
