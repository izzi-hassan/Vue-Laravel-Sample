@extends('layouts.home')

@section('title'){{ $pageData->title }}@endsection

@section('content')
    <div class="row align-center align-middle heading-row">
        <div class="small-10 medium-7 columns">
            <h1 data-editor-type="basicEditor" data-edit-field="heading">{!! html_entity_decode($pageData->heading) !!}</h1>
            <p class="sub-heading" data-editor-type="basicEditor" data-edit-field="subheading">{!! html_entity_decode($pageData->subheading) !!}</p>

            <button class="mdl-button" id="home-callout-button" data-href="/get-involved">Get Involved</button>
        </div>
    </div>

    <div class="row placeholder-row-dark">&nbsp;</div>
    <div class="row placeholder-row-light">&nbsp;</div>
@endsection