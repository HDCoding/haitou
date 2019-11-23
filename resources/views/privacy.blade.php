<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="landing-2 default-style">
<head>
    <title>{{ setting()->site_title }} :: Politica de Privacidade</title>

    @include('layouts.site_head')
</head>

<body>
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

@include('layouts.includes.index_blocks')

<div class="bg-white">

    <!-- Block -->
    <div class="landing-block pb-5">
        <div class="container px-3">

            <div class="col-md-10 col-lg-8 col-xl-7 text-center p-0 mx-auto">
                <div class="display-3 text-primary mb-4">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <h1 class="display-4 font-secondary font-weight-semibold mb-5">Politica de Privacidade</h1>
                <div class="text-muted">
                    {!! setting()->getPrivacyHtml() !!}
                </div>
            </div>

        </div>
    </div>
    <!-- / Block -->

</div>

@include('layouts.includes.index_footer')

<!-- Core scripts -->
<script src="{{ secure_asset('vendor/popper/popper.js') }}"></script>
<script src="{{ secure_asset('js/bootstrap.js') }}"></script>
<!-- Page -->
<script src="{{ secure_asset('js/pages/landing.js') }}"></script>
</body>
</html>
