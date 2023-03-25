@if($data->ProjectSpecification->count() > 0)
<section>
    <div class="amenities-holder" id="amenities-section">
        <div class="container">
            <div class="text-center">
                <h2 class="main-title">
                    {!!$data->specification_heading!!}
                </h2>
            </div>
            <div class="row mt-5 justify-sm-around">
                @foreach ($data->ProjectSpecification as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 amenities-col">
                    <img src="{{ $item->icon_image_link }}" alt="">
                    <p>{{$item->title}}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
