@extends('admin.master')

@section('content') {{-- master @yield(content)--}}

<div class="panel panel-default">
    <div class="panel-heading">
        {{trans('admin.sections')}}
        <a href="{{ action('Admin\CatController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#ID</th><th>{{trans('admin.title')}}</th><th>{{trans('admin.sort')}}</th><th></th>
            </tr>
            </thead>
            <tbody id="sections">
                  {{parseAndPrintTree($categories,$cat)}}
            </tbody>
        </table>
        <tfoot>
        <tr>
            <td colspan="7" align="center">{!! str_replace('/?', '?', $categories->render()) !!}</td>
        </tr>
        </tfoot>
    </div>
</div>
@include('admin.modals.remove',['item'=>trans('admin.sec_sure')])
@stop