@extends('admin.master')

@section('content')
 <div class="panel panel-default">
  <div class="panel-heading">
   {{ trans('admin.menus') }}
   <a href="{{ action('Admin\MenuBuilderController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>
  </div>

  <div class="panel-body">

   <table class="table table-hover">
    <thead>
    <tr>
     <th>#ID</th><th>{{trans('admin.menu_name')}}</th><th>{{trans('admin.lang')}}</th>
    </tr>
    </thead>
    <tbody>
@if(count($items) > 0)
    @foreach($items as $item)
     <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->name }}</td>
      <td>{{ $item->lang }}</td>
      <td>
       <a href="{{ action('Admin\MenuBuilderController@edit',$item->id) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
       <a class="remove-modal" data-toggle="modal" data-target="#RemoveModal" data-url="{{ action('Admin\MenuBuilderController@destroy',$item->id) }}" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
      </td>
     </tr>
    @endforeach
@endif
    </tbody>
    <tfoot>
    <tr>
     <td colspan="6" align="center">{!! str_replace('/?', '?', $items->render()) !!}</td>
    </tr>
    </tfoot>
   </table>
  </div>
 </div>
 @include('admin.modals.remove',['item'=>trans('items.sure')])
@stop