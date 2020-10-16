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
        <form action="{{ route($routeName . '.update', $row) }}" method="post">
            {{ @method_field('put') }}
            @include('back-end.'.$folderName.'.form')
            <button type="submit" class="btn btn-primary pull-right">Update {{ $moduleName }}</button>
            <div class="clearfix"></div>
        </form>
    @endcomponent
@endsection
