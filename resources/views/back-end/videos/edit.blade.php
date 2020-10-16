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
        <form action="{{ route($routeName . '.update', $row) }}" method="post" enctype="multipart/form-data">
            {{ @method_field('put') }}
            @include('back-end.'.$folderName.'.form')
            <button type="submit" class="btn btn-primary pull-right">Update {{ $moduleName }}</button>
            <div class="clearfix"></div>
        </form>
        @slot('md4')
            @php $url = getYoutubeId($row->youtube); @endphp
            @if ($url)
                <iframe width="250" src="https://www.youtube.com/embed/{{ $url }}" style="margin-bottom: 20px" frameborder="0"
                    allowfullscreen></iframe>
            @endif
            <img src="{{ url('uploads/' . $row->image) }}" width="250">
        @endslot
    @endcomponent
    @component('back-end.shared.edit', ['pageTitle' => 'Comments', 'pageDes' => 'here we can control comments'])
        @include('back-end.comments.index')
        @slot('md4')
            @include('back-end.comments.create')
        @endslot
    @endcomponent
@endsection
