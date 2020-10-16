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
    @component('back-end.shared.create', ['pageTitle' => $pageTitle, 'pageDes' => $pageDes])
        <!--, ['nav_title'=>'Home Page'])  that a way and there are another way to do!-->
        <form action="{{ route($routeName . '.store') }}" method="post">
            @include('back-end.'.$folderName.'.form')
            <button type="submit" class="btn btn-primary pull-right">Add {{ $moduleName }}</button>
            <div class="clearfix"></div>
        </form>
    @endcomponent
@endsection
