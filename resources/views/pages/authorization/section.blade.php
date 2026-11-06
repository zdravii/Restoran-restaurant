<section class="page-banner d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="banner-content">
                <h2 class="text-white display-3 text-center" data-aos="fade-right" data-aos-delay="3000">Authorization</h2>
                <div class="divider" data-aos="fade-up-right" data-aos-delay="3000">
                    <div class="dot mb-2"></div>
                </div>
                @if(session('message'))
                    <div class="text-center">
                        <p class="text-success fw-bold fs-5">{{ session('message') }}</p>
                    </div>
                @endif
                @if(session('error'))
                    <div class="text-center">
                        <p class="text-danger fw-bold fs-5">{{ session('error') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
