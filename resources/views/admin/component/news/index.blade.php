@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('admin.news') }}
        <a href="{{ action('Admin\NewsController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        @if(count($news) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>{{trans('admin.img')}}</th>
                    <th>{{trans('admin.title')}}</th>
                    <th>{{trans('admin.lang')}}</th>
                    <th>{{trans('admin.created_at')}}</th>
                    <th>{{trans('admin.updated_at')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td class="thumb_100"><img src="{{get_poster($item->files,300)['path'] }}" width="100"/></td>
                        <td><a href="{{ action('Admin\NewsController@edit',$item->id) }}" class="col-lg-11">{{$item->title}}</a></td>
                        <td>{{get_data_lang($item->lang)}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            <a href="{{ action('Admin\NewsController@edit',$item->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\NewsController@destroy',$item->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7" align="center">{!! str_replace('/?', '?', $news->render()) !!}</td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>

@include('admin.modals.remove',['item'=>trans('admin.sure')])

@stop