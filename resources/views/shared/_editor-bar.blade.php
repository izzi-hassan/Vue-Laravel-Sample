<div data-sticky-container id="editor-bar-container">
    <div class="top-bar sticky" id="editor-top-bar" data-sticky data-anchor="1" data-margin-top="0">
        <div class="top-bar-title">
            <a href="/" title="Sparkhub - Inspired Living">
                <img src="/images/shared/logo-dark.png" alt="SparkHub Logo" class="logo" />
            </a>
        </div>
        @isset($create)
            <div class="top-bar-left">
                <h3>@yield('title')</h3>
                <div id="update-progress" class="mdl-progress mdl-js-progress mdl-progress__indeterminate hide"></div>
            </div>
        @endisset
        @empty($create)
        <div class="top-bar-left">
            <h3>Editing: {{ $pageData->title }} (/{{ $pageData->uri }})</h3>
            <div id="update-progress" class="mdl-progress mdl-js-progress mdl-progress__indeterminate hide"></div>
        </div>
        @endempty
        <div class="top-bar-right">
            <!-- TODO: implement share button -->
            {{--<button class="mdl-button share-button {{ $publishButtonClass }}" data-page-id="{{ $pageData->id }}">
                Share</i>
            </button>--}}
            @isset($create)
                <button class="mdl-button publish-button {{ $publishButtonClass }}">
                    Publish&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            @endisset

            @empty($create)
                <button class="mdl-button publish-button {{ $publishButtonClass }}" data-page-id="{{ $pageData->id }}">
                    Publish&nbsp;<i class="fa fa-angle-down" aria-hidden="true"></i>
                </button>
            @endempty
        </div>
    </div>
</div>