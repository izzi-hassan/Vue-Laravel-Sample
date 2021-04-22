@extends('layouts.login')

@section('title')
    Login
@endsection

@section('content')

    <div id="offcanvas-sign-in">
        <div class="row align-center collapse">
            <div class="small-12 medium-8 columns large-right" id="login-box-content">
                <div class="row align-center">
                    <div class="shrink columns text-center">
                        <h3>Sign-in to <strong>get started</strong></h3>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="columns">
                        <ul class="providers-list">
                            <li>
                                <a href="/login/twitter" class="twitter-bg" title="Continue with Twitter" id="twitter-login">
                                    <i class="fa fa-twitter"></i> Continue with Twitter
                                    <span class="graphic-link-under-text">we will <span class="text-emphasis">never</span> post as you</span>
                                </a>
                            </li>
                            <li>
                                <a href="/login/facebook" class="fb-bg" title="Continue with Facebook" id="facebook-login">
                                    <i class="fa fa-facebook"></i> Continue with Facebook
                                    <span class="graphic-link-under-text">we will <span class="text-emphasis">never</span> post as you</span>
                                </a>
                            </li>
                            <li>
                                <a href="/login/linkedin" class="linked-in-bg" title="Continue with LinkedIn" id="linked-in-login">
                                    <i class="fa fa-linkedin"></i> Continue with LinkedIn
                                    <span class="graphic-link-under-text">we will <span class="underlined italic">never</span> post as you</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row align-center">
                    <div class="shrink columns text-center">
                        <p>By signing-up with Facebook or Twitter, we will start you off by automatically importing your profile image and name.<br><br>We will never post as you without your permission.</p>
                        <p>For more info, please read our <a href="/login/faq" title="Frequently Asked Questions about Login">Login FAQ</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection