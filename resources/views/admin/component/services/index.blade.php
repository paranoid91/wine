@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('admin.services') }}
        <a href="{{ action('Admin\ServicesController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        @if(count($services) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>{{trans('admin.img')}}</th>
                    <th>{{trans('admin.title')}}</th>
                    <th>{{trans('admin.lang')}}</th>
                    <th>{{trans('admin.created_at')}}</th>
                    <th>{{trans('admin.status')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>
                            <img src="{{get_thumb($service->poster)}}" width="100px">
                        </td>
                        <td><a href="{{ action('Admin\ServicesController@edit',$service->id) }}" class="col-lg-11">{{$service->title}}</a></td>
                        <td>{{get_data_lang($service->lang)}}</td>
                        <td>{{$service->created_at}}</td>
                        <td>
                            <i class="{{($service->is_publish > 0) ? 'fa fa-check':'fa fa-close'}}" style="color:{{($service->is_publish > 0) ? 'green':'red'}};"></i>
                        </td>
                        <td>
                            <a href="{{ action('Admin\ServicesController@edit',$service->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\ServicesController@destroy',$service->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7" align="center">{!! str_replace('/?', '?', $services->render()) !!}</td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>

@include('admin.modals.remove',['item'=>trans('admin.sure')])

@stop