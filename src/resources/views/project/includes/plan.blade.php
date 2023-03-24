<section class="m-0">
    <div class="plan-holder" id="plan-section">
        <div class="container">
            <div class="row justify-content-between align-items-center plan-header">
                <h2 class="main-title">
                    Master & <span>Unit Plans</span>
                </h2>
                <button data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Download PDF <i class="fas fa-download"></i>
                </button>
            </div>
            <div class="tab-holder">
                <div class="tab-panels">
                    <div class="row flex-wrap justify-content-between">
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <ul class="tabs">
                                <li data-panel-name="panel1" class="active">Master Plan</li>
                                <li data-panel-name="panel2">East Facing</li>
                                <li data-panel-name="panel3">West Facing</li>
                            </ul>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-12" style="position: relative;" id="floor-container">
                            <div class="loader-div-tab">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                            <div id="panel1" class="panel active">
                                <div class="tab-regular slider">
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/1.jpg') }}" class="w-100"
                                            alt="">
                                    </div>
                                </div>
                            </div>

                            <div id="panel2" class="panel">
                                <div class="tab-regular slider">
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/2.jpg') }}" class="w-100" alt="">
                                    </div>
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/3.jpg') }}" class="w-100" alt="">
                                    </div>
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/4.jpg') }}" class="w-100" alt="">
                                    </div>
                                </div>
                            </div>

                            <div id="panel3" class="panel">
                                <div class="tab-regular slider">
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/5.jpg') }}" class="w-100" alt="">
                                    </div>
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/6.jpg') }}" class="w-100" alt="">
                                    </div>
                                    <div class="slider-img">
                                        <img src="{{ asset('assets/images/plans/7.jpg') }}" class="w-100" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
