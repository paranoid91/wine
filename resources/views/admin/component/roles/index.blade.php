@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('admin.user_groups') }}
        <a href="{{ action('Admin\RolesController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        @if(count($roles) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#ID</th><th>{{trans('admin.title')}}</th><th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td><a href="{{ action('Admin\RolesController@edit',$role->id) }}" class="col-lg-11">{{$role->name}}</a></td>
                        <td>
                            <a href="{{ action('Admin\RolesController@edit',$role->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\RolesController@destroy',$role->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" align="center">{!! str_replace('/?', '?', $roles->render()) !!}</td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>

@include('admin.modals.remove',['item'=>trans('admin.sure')])

@stop