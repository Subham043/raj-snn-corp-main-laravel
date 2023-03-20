@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project_list.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Projects</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="{{route('project_create.get')}}" style="background:green;border-color:green;" type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-add-line align-bottom me-1"></i> Create</a>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <form  method="get" action="{{route('project_list.get')}}">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" name="search" class="form-control search" placeholder="Search..." value="@if(app('request')->has('search')) {{app('request')->input('search')}} @endif">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Project Name</th>
                                            <th class="sort" data-sort="customer_name">Project Slug</th>
                                            <th class="sort" data-sort="status">Project Status</th>
                                            <th class="sort" data-sort="status">Publish Status</th>
                                            <th class="sort" data-sort="date">Created Date</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="customer_name">{{$item->slug}}</td>
                                            @if($item->project_status == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Completed</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-danger text-uppercase">Upcoming</span></td>
                                            @endif
                                            @if($item->publish_status == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-danger text-uppercase">Draft</span></td>
                                            @endif
                                            <td class="date">{{$item->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    {{-- <div class="edit">
                                                        <a href="{{route('image_display', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">View</a>
                                                    </div> --}}
                                                    <div class="edit">
                                                        <a href="{{route('project_update.get', $item->id)}}" style="background:yellow;color:black;border-color:yellow;" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" style="background:red" onclick="deleteHandler('{{route('project_delete.get', $item->id)}}')">Delete</button>
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
