@extends('admin.master')

@section('content') {{-- master @yield(content)--}}
<div class="panel panel-default">
    <div class="panel-heading">
        {{trans('admin.users')}}
        <a href="{{ action('Admin\UsersController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>

    <div class="panel-body">
        @if(count($users) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#ID</th><th>{{trans('admin.username')}}</th><th>{{trans('admin.email')}}</th><th>{{trans('admin.group')}}</th><th>{{trans('admin.registered_at')}}</th><th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ action('Admin\UsersController@edit',$user->id) }}" class="col-lg-11">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles[0]->name }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ action('Admin\UsersController@edit',$user->id) }}" class="btn btn-info"><i class="glyphicon glyphicon-edit" aria-hidden="true"></i></a>
                            <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\UsersController@destroy',$user->id) }}" >
                                <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6" align="center">{!! str_replace('/?', '?', $users->render()) !!}</td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>
@include('admin.modals.remove',['item'=>trans('admin.user_sure')])
@stop