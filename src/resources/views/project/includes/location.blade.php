@if($data->ProjectLocation && $data->ProjectConnectivity->count() > 0)
<section class="mt-5">
    <div class="connectivity-holder" id="location-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <h2 class="main-title text-center">
                        {!!$data->location_heading!!}
                    </h2>
                    {!!$data->ProjectLocation->description!!}
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 map-col">
                    <iframe
                        src="{{$data->ProjectLocation->location}}"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 image-col">
                    <img src="{{ $data->ProjectLocation->map_image_link }}" alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-col">
                    <h2 class="main-title text-center">
                        {!!$data->connectivity_heading!!}
                    </h2>
                    <div class="row">
                        @foreach ($data->ProjectConnectivity as $item)
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h6>{{$item->title}}</h6>
                            <ul class="row align-items-center justify-content-between">
                                @foreach ($item->points_list as $i)
                                <li class="col-lg-12 col-md-12 col-sm-12">
                                    <i class="fas fa-check"></i>
                                    {{$i}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endif
