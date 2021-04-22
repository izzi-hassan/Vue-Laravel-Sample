@extends('layouts.microsite')

@section('title')
    {{ $pageData->title }}
@endsection

@section('content')
    <section class="white-bg">
        <div class="row collapse align-center">
            <div class="small-11 medium-10 large-8 columns">
                {!! $pageData->content !!}
            </div>
        </div>
    </section>
    <section class="orange-bg flush-bottom">
        <div class="row collapse align-center">
            <div class="small-11 medium-10 large-8 columns">
                <h3>Together, we can spark a difference</h3>
                <h4 class="subhead">Everyday we broadcast a stream of creativity &amp; inspirational gold across channels that you love.</h4>
                <p>Unlock a customized, personalized experience, as well as offereing you a voice in our community and rewards</p>
            </div>
        </div>
        <div class="row collapse align-center responsive-image-container">
            <div class="small-11 medium-10 large-8 columns">
                <img src="/images/visitor/home/macbook.jpg">
            </div>
        </div>
    </section>
    <section class="white-bg">
        <div class="row collapse align-center">
            <div class="small-11 medium-10 large-8 columns">
                <h2>Let's make a positive impact on what is 100% of our future.</h2>
                <p class="subhead">Be a part of the journey</p>

                <div class="row collapse">
                    <div class="small-11 medium-10 columns shrink">
                        <div class="story">
                            <div class="row story-level align-spaced align-middle">
                                <div class="small-12 medium-6 story-callout text-center"><span>Inspiration</span></div>
                                <div class="small-12 medium-6 story-text"><span>Our community is a hub of expertise and knowledge that provides our global audience of parents, caregivers and teachers, with daily inspiration to spark their imagination.</span></div>
                            </div>
                            <div class="row story-level align-spaced align-middle">
                                <div class="small-12 medium-6 story-callout text-center"><span>Stimulation</div>
                                <div class="small-12 medium-6 story-text"><span>Our community is a hub of expertise and knowledge that provides our global audience of parents, caregivers and teachers, with daily inspiration to spark their imagination.</span></div>
                            </div>
                            <div class="row story-level align-spaced align-middle">
                                <div class="small-12 medium-6 story-callout text-center"><span>Creativity</div>
                                <div class="small-12 medium-6 story-text"><span>Our community is a hub of expertise and knowledge that provides our global audience of parents, caregivers and teachers, with daily inspiration to spark their imagination.</span></div>
                            </div>
                            <div class="row story-level align-spaced align-middle">
                                <div class="small-12 medium-6 story-callout text-center"><span>Fun</div>
                                <div class="small-12 medium-6 story-text"><span>Our community is a hub of expertise and knowledge that provides our global audience of parents, caregivers and teachers, with daily inspiration to spark their imagination.</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blue-bg">
        <div class="row collapse align-center">
            <div class="columns shrink">
                <h2>Be a part of the Journey</h2>
            </div>
        </div>
        <div class="row collapse align-center">
            <div class="columns shrink">
                <button class="mdl-button clear-button">Find out how</button>
            </div>
        </div>
    </section>
@endsection