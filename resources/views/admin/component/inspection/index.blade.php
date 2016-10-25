@extends('admin.master')
@section('content') {{-- master @yield(content)--}}
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title left"><strong>ავტოექსპერტიზა</strong></h3>
                <a href="{{ action('Admin\InspectionController@create') }}" class="btn btn-success right"><i class="fa fa-plus"></i> {{trans('admin.add')}}</a><div class="fix"></div>

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td><strong>ID</strong></td>
                            <td><strong>მზღვეველი</strong></td>
                            <td><strong>მარკა</strong></td>
                            <td><strong>მოდელი</strong></td>
                            <td class="text-center"><strong>ნომერი</strong></td>
                            <td class="text-center"><strong>ვინკოდი</strong></td>
                            <td class="text-center"><strong>გამოშვების წელი</strong></td>
                            <td class="text-center"><strong>გარბენი</strong></td>
                            <td class="text-center"><strong>ძრავის მოცულობა</strong></td>
                            <td class="text-center"><strong>მფლობელი</strong></td>
                            <td class="text-center"><strong>მფლობელის სტატუსი</strong></td>
                            <td class="text-center"><strong>ტელეფონი</strong></td>
                            <td class="text-center"><strong>პერსონალური აი-დი</strong></td>
                            <td class="text-right"><strong>მიღების თარიღი</strong></td>
                            <td class="text-right"><strong>აქტის შედგენის თარიღი</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                        <?php $owner_status = ['ფოზიკური პირი','იურიდიული პირი'];?>
                        @foreach($inspections as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{is_key($item->categories,1)['name']}}</td>
                                <td>{{is_key($item->categories,2)['name']}}</td>
                                <td>{{is_key($item->categories,3)['name']}}</td>
                                <td class="text-center">{{$item->registration_number}}</td>
                                <td class="text-center">{{$item->vincode}}</td>
                                <td class="text-center">{{$item->year}}</td>
                                <td class="text-center">{{$item->mileage}} {{($item->length == 0) ? 'კმ':'მლ'}}</td>
                                <td class="text-center">{{$item->engine_volume}}</td>
                                <td class="text-center">{{$item->owner}}</td>
                                <td class="text-center">{{is_key($owner_status,$item->law)}}</td>
                                <td class="text-center">{{$item->phone}}</td>
                                <td class="text-center">{{$item->personal_id}}</td>
                                <td class="text-right">{{$item->receipted_at}}</td>
                                <td class="text-right">{{$item->executed_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop