<template>
    <div id="offcanvas-menu" class="offcanvas-full-screen" data-off-canvas data-transition="overlap">
        <div class="row align-right collapse">
            <div class="small-12 medium-8 large-6 columns offcanvas-inner">
                <div class="row gray-bg align-stretch collapse">
                    <div class="small-10 columns overlay-menu-title">
                        Community
                        <button class="mdl-button mdl-js-button show-border float-right" data-href="/sign-out">
                            <i class="fa fa-user" aria-hidden="true"></i> Sign-Out
                        </button>
                    </div>
                    <div class="small-2 columns dark-close-bg align-middle">
                        <div class="row align-center align-middle align-center shrink full-height">
                            <div class="shrink columns">
                                <button class="offcanvas-full-screen-close dark-close" aria-label="Close menu" type="button" data-close>
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-center collapse">
                    <div class="small-11 columns">
                        <div class="row collapse">
                            <div class="small-12 columns">
                                <h4>Explore</h4>
                            </div>
                        </div>
                        <div class="row button-list collapse">
                            <div class="small-12 columns">
                                <div class="row">
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button new">
                                            <i class="fa fa-lightbulb-o"></i> Ideas
                                        </button>
                                    </div>
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-star-half-o"></i> Product Reviews
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-file-text-o"></i> Posts
                                        </button>
                                    </div>
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-group"></i> Ask An Expert
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-leaf"></i> Activities
                                        </button>
                                    </div>
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-comments-o"></i> Discussions
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-film"></i> Videos
                                        </button>
                                    </div>
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-quote-left"></i> Inspirational Quotes
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-question-circle"></i> Answers
                                        </button>
                                    </div>
                                    <div class="small-12 medium-6 columns">
                                        <button type="button" class="icon-button">
                                            <i class="fa fa-puzzle-piece"></i> Fun Facts
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-center">
                    <div class="small-11 medium-10 columns">
                        <div class="row popout-menu-heading">
                            <div class="columns">
                                <h4>Browse</h4>
                            </div>
                        </div>
                        <div class="row button-list collapse">
                            <div class="small-12 columns">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-right share-button">
                    <button class="mdl-button mdl-js-button show-border show-for-medium">
                        <i class="fa fa-user" aria-hidden="true"></i> Share<span class="under-text">us with your friends</span>
                    </button>
                </div>

                <div class="row align-right popout-menu-footer">
                    <ul class="menu">
                        <li>
                            <a href="/about" title="About">About</a>
                        </li>
                        <li>
                            <a href="/terms" title="Terms">Terms</a>
                        </li>
                        <li>
                            <a href="/privacy" title="Privacy">Privacy</a>
                        </li>
                        <li>
                            <a href="/more" title="More">More</a>
                        </li>
                    </ul>
                </div>
                <div class="row align-right popout-menu-disclaimer">
                    <img src="/images/shared/logo.png" title="SparkHub Logo" /> SparkHub Ltd. &copy; 2017
                </div>
            </div>
        </div>
    </div>
</template>