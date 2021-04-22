@extends('layouts.onboarding')

@section('onboard-progress')
    <i class="fa fa-check-circle icon-success"></i>
    <i class="fa fa-circle icon-disabled" ></i>
    <i class="fa fa-circle icon-disabled"></i>
@endsection

@section('intro')
    <h1>Welcome to SparkHub</h1>
    <p>Thank you <strong>{{ $firstName }}</strong> for joining us on this journey to help shape the future of inspired learning. Before you can get started, we need you to confirm a few details that we conveniently pulled from your facebook account (gotta love technology!).</p>
@endsection

@section('content')
    <div class="row collapse" id="onboarding-step-one-container">
        <div class="small-12 columns">
            <form id="complete-profile-form" method="POST" action="/complete-profile/step-one/process" data-abide novalidate>
                {{ csrf_field() }}
                <div class="row">
                    <div class="small-12 medium-6 columns">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="first-name">
                            <input class="mdl-textfield__input" type="text" name="first_name" value="{{ $firstName }}" required />
                            <label class="mdl-textfield__label" for="first-name">First Name</label>
                        </div>
                    </div>
                    <div class="small-12 medium-6 columns">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="last-name">
                            <input class="mdl-textfield__input" type="text" name="last_name" value="{{ $lastName }}" required />
                            <label class="mdl-textfield__label" for="last-name">Last Name</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 medium-6 columns username-field">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="username">
                            <input class="mdl-textfield__input" type="text" name="username"
                                   v-on:change="checkUsername"
                                   v-bind:class="{ working: isWorking}" required />
                            <label class="mdl-textfield__label" for="username">Username</label>
                        </div>
                    </div>
                </div>
                <div class="row switch-row">
                    <div class="small-12 medium-6 columns">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="hide-name" v-mdl>
                            <input type="checkbox" id="hide-name" class="mdl-switch__input">
                            <span class="mdl-switch__label">Only show my username</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" v-mdl id="preferred-email">
                            <input class="mdl-textfield__input" type="text" name="preferred_email" value="{{ $user->email }}" required />
                            <label class="mdl-textfield__label" for="preferred-email">Preferred Email Address</label>
                        </div>
                    </div>
                </div>
                <div class="row align-center space-top">
                    <div class="shrink columns">
                        <button type="submit" class="button">Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
