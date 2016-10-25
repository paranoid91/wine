@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">
        {{ trans('admin.pages') }}
        <a href="{{ action('Admin\PagesController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        @if(count($pages) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#ID</th>
                    <th>{{trans('admin.title')}}</th>
                    <th>{{trans('admin.lang')}}</th>
                    <th>{{trans('admin.created_at')}}</th>
                    <th>{{trans('admin.updated_at')}}</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td><a href="{{ action('Admin\PagesController@edit',$page->id) }}" class="col-lg-11">{{$page->title}}</a></td>
                        <td>{{get_data_lang($page->lang)}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>{{$page->updated_at}}</td>
                        <td>
                            <a href="{{ action('Admin\PagesController@edit',$page->id) }}" class="btn btn-info"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a class="remove-modal btn btn-danger" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\PagesController@destroy',$page->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="6" align="center">{!! str_replace('/?', '?', $pages->render()) !!}</td>
                </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>

@include('admin.modals.remove',['item'=>trans('admin.sure')])

@stop