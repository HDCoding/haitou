@extends('layouts.dashboard')

@section('subtitle', 'F.A.Q')

@section('content')

    <h3 class="text-center font-weight-bold py-3 mb-4">F.A.Q</h3>
    <hr class="border-light container-m--x my-0">

    <div class="row mt-4">
        <div class="col-lg-4 col-xl-3" id="fixo">
            <div>
                @foreach($categories as $key => $category)
                    <a href="#categ-{{ $category->id }}" id="scroll" class="media align-items-center bg-lighter text-dark py-3 px-4">
                        <div class="{{ $category->icon }} ui-w-30 text-center text-xlarge"></div>
                        <div class="media-body ml-3" id="categ-{{ $category->id }}">{{ $category->name }}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col">
            @foreach($categories as $key => $category)
                <h4 class="media align-items-center my-4">
                    <div class="{{ $category->icon }} ui-w-60 text-center text-large"></div>
                    <div class="media-body ml-1" id="categ-{{ $category->id }}">{{ $category->name }}</div>
                </h4>
                @foreach($faqs as $faq)
                    @if($category->id == $faq->category_id)
                        <div class="bg-white ui-bordered mb-2">
                            <a href="#faq-{{ $faq->id }}" class="d-flex justify-content-between text-dark py-3 px-4" data-toggle="collapse">
                                {{ $faq->question }}
                                <span class="collapse-icon"></span>
                            </a>
                            <div id="faq-{{ $faq->id }}" class="collapse text-muted">
                                <div class="px-4 pb-3">
                                    {!! $faq->getAnswerHtml() !!}
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                <hr class="my-5">
            @endforeach
        </div>
    </div>

@endsection

@section('script')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function(){
            // Add smooth scrolling to all links
            $("#scroll").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    let hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        });

        $(function() {
            let offset = $("#fixo").offset();
            let topPadding = 15;
            $(window).scroll(function() {
                if ($(window).scrollTop() > offset.top) {
                    $("#fixo").stop().animate({
                        marginTop: $(window).scrollTop() - offset.top + topPadding
                    });
                } else {
                    $("#fixo").stop().animate({
                        marginTop: 0
                    });
                }
            });
        });
    </script>
@endsection
