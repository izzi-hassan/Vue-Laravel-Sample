@extends('layouts.page')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="row align-center align-middle header collapse">
        <div class="gradient-container small-12 columns">
            <div class="row align-center">
                <div class="small-10 medium-7 columns">
                    <h1>{{ $page->heading }}</h1>
                    <span class="subheading">Lorem Ipsum Dolor Sit Amet More lorem ipsum Morbi mollis enim urna, something something lorem ipsum</span>
                </div>
            </div>
        </div>
    </div>
@endsection