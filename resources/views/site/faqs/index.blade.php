@extends('layouts.dashboard')

@section('title', 'F.A.Q')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">F.A.Q</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @foreach($categories as $key => $category)
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-danger">{{ $category->name }}</h4>
                        <!-- Accordian-part -->
                        <div id="accordian-part">
                            <div id="accordian-3">
                                @foreach($faqs as $faq)
                                    @if($category->id == $faq->category_id)
                                    <div class="card m-b-0">
                                        <div class="card-header bg-white p-l-0">
                                            <h5 class="m-b-0">
                                                <a href="#" class="collapsed link" id="headingTwo" data-toggle="collapse" data-target="#faq-{{ $faq->id }}" aria-expanded="false" aria-controls="faq-{{ $faq->id }}">
                                                    Q{{ $faq->id }}. {{ $faq->question }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="faq-{{ $faq->id }}" class="collapse" aria-labelledby="headingTwo" data-parent="#faq-{{ $faq->id }}">
                                            <div class="card-body p-l-0">
                                                {!! $faq->answerHtml() !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <!-- End accordian-part -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
