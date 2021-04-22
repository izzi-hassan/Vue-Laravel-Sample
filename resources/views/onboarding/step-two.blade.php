@extends('layouts.onboarding')

@section('onboard-progress')
    <i class="fa fa-check-circle icon-success"></i>
    <i class="fa fa-circle icon-success" ></i>
    <i class="fa fa-circle icon-disabled"></i>
@endsection

@section('intro')
    <h1>Subscribe to Content Channels</h1>
    <p>Let’s start off by finding <strong>the right content for you!</strong>  Please select at least 3 channels to subscribe to in order for us to provide you with an experience tailored to your interests (you can update them at anytime).</p>
@endsection

@section('content')
    <div class="row collapse" id="onboarding-step-two-container">
        <div class="small-12 columns">
            <div class="row">
                <div class="small-12 columns">
                    <channel-subscriber v-bind:channels="{{ $channels }}"></channel-subscriber>

                    <div class="row align-right">
                        <div class="columns shrink">
                            <button class="button" data-href="{{ URL::route('app-entry') }}">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
