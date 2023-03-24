<!DOCTYPE html>
<html lang="en">

@include('project.includes.meta')

<body>
    @include('project.includes.header')
    @include('project.includes.banner')
    @include('project.includes.about')
    @include('project.includes.table')
    @include('project.includes.gallery')
    @include('project.includes.specification')
    @include('project.includes.plan')
    @include('project.includes.location')
    @include('project.includes.amenities')
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
    @include('project.includes.footer')


    <!-- Modal -->
    @include('project.includes.contact_modal')
</body>
<!-- Main JS -->
@include('project.includes.script')

</html>
