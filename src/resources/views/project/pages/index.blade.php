<!DOCTYPE html>
<html lang="en">

@include('project.includes.meta', ['data' => $data])

<body>
    @include('project.includes.header', ['data' => $data])
    @include('project.includes.banner', ['data' => $data])
    @include('project.includes.about', ['data' => $data])
    @include('project.includes.table', ['data' => $data])
    @include('project.includes.gallery', ['data' => $data])
    @include('project.includes.specification', ['data' => $data])
    @include('project.includes.plan', ['data' => $data])
    @include('project.includes.location', ['data' => $data])
    @include('project.includes.amenities', ['data' => $data])
    <section class="mb-0">
        <div class="contact-holder" id="contact-section">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-lg-8 col-md-6 col-sm-12 contact-col">
                        <h2>GET COST SHEET & BROCHURE</h2>
                        <p>Click Below To Download Floorplans & Cost Sheet of Raj Viviente & Register for special offers.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary formbuttonstyler">Download Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('project.includes.creations')
    @include('project.includes.footer', ['data' => $data])


    <!-- Modal -->
    @include('project.includes.contact_modal')
</body>
<!-- Main JS -->
@include('project.includes.script', ['data' => $data])
</html>
