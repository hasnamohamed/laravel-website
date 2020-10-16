@extends('back-end.layout.app')
@section('title')
    {{ $pageTitle }}
@endsection
@section('content')
    @component('back-end.layout.header')
        <!--, ['nav_title'=>'Home Page'])  that a way and there are another way to do!-->
        @slot('nav_title')
            <!--here i write the variable -->
            {{ $pageTitle }}
        @endslot
    @endcomponent
    @component('back-end.shared.edit', ['pageTitle' => $pageTitle, 'pageDes' => $pageDes])
        @include('back-end.'.$folderName.'.form')
    @endcomponent
@endsection
