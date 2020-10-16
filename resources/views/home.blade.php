@extends('layouts.app')

@section('content')
    <div class="section section-buttons">
        <div class="container">
            <div class="title">
                <h2>Latest Videos</h2>
                @if (request()->has('search') && request()->get('search') != '')
                    <p style="margin-top: 10px">
                        You are search on <b>{{ request()->get('search') }}</b> || <a href="{{ route('fhome') }}">Reset</a>
                    </p>
                @endif
            </div>
            @include('front-end.shared.video-row')
        </div>
    </div>
@endsection
