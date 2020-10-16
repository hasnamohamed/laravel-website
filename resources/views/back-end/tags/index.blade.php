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
    @component('back-end.shared.table', ['pageTitle' => $pageTitle, 'pageDes' => $pageDes])
        {{-- @slot('nav_title')
        {{ $pageTitle }}
        @endslot --}}
        @slot('addButton')
            <div class="col-md-4 text-right">
                <a href="{{ route($routeName . '.create') }}" class="btn btn-white btn-round">
                    Add {{ $sModuleName }}
                </a>
            </div>
        @endslot
        <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th class="text-right">
                            Control
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                        <!--Rows means Users-->
                        <tr>
                            <td>
                                {{ $row->id }}
                            </td>
                            <td>
                                {{ $row->name }}
                            </td>
                            <td class="td-actions text-right">
                                @include('back-end.shared.button.edit')
                                @include('back-end.shared.button.delete')

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $rows->links() !!}
        </div>
    @endcomponent
@endsection
