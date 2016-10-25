@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

        <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('admin.modules') }}
                <a href="{{ action('Admin\ModulesController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
            </div>

            <div class="panel-body">
                @if(count($modules)>0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#ID</th><th>{{trans('admin.name')}}</th><th>{{trans('admin.controller')}}</th><th>{{trans('admin.status')}}</th><th></th>
                    </tr>
                    </thead>
                    <tbody id="sortable"  data-route="{{action('Admin\ModulesController@sort',1)}}" data-token="{{csrf_token()}}">

                    @foreach($modules as $module)
                        <tr class="ui-state-default" data-id="{{$module->id}}">
                            <td>{{ $module->id }}</td>
                            <td>{{ $module->name }}</td>
                            <td>{{ $module->controller }}</td>
                            <td align="left"><a class="item-status" data-route="{{ action('Admin\ModulesController@active',$module->id) }}" data-token="{{csrf_token()}}">{!! ($module->status == 1) ? '<i class="glyphicon glyphicon-eye-open"></i>' : '<i class="glyphicon glyphicon-eye-close"></i>' !!}</a></td>
                            <td>
                                <a href="{{ action('Admin\ModulesController@edit',$module->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\ModulesController@destroy',$module->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
                @else
                    <div class="alert alert-info alert-important">
                        {{trans('admin.no_records')}}
                    </div>
                @endif
            </div>

            @include('admin.modals.remove',['item'=>trans('admin.module_alert')])
        </div>

@stop