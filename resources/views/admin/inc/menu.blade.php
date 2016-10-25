<div class="block-list" >
    <ul>
        <?php $modules = get_modules() ?>
        @if(count($modules) > 0)

            @foreach($modules as $mod)

                @if($mod->name <> 'modules')
                    @if(is_array(get_role_permissions($mod->name)))
                        <?php $array = (in_array('index',get_role_permissions($mod->name))) ? true : false ?>
                    @else
                        <?php $array = false ?>
                    @endif
                    @if($array == true)
                        <li class="{{ (in_array($mod->name,explode('/',Route::getCurrentRoute()->uri()))) ? 'active ' : ''  }}{{$mod->name}}"><a href="{{action($mod->controller)}}" title="{{trans('admin.'.$mod->name)}}"><i class="{{$mod->icon}}"></i> <span>{{trans('admin.'.$mod->name)}}</span></a></li>
                    @endif
                @endif
            @endforeach
        @endif
        <li class="{{ (in_array('modules',explode('/',Route::getCurrentRoute()->uri()))) ? 'active' : ''  }} modules"><a href="{{action('Admin\ModulesController@index')}}" title="{{trans('admin.modules')}}"><i class="pe-7s-keypad"></i> <span>{{trans('admin.modules')}}</span></a></li>
    </ul>
    <div class="fix"></div>
    {{--<div class="nav_bars">--}}
        {{--<i onClick='$("input[name=\"active_top_slide\"]").click()' class="glyphicon {{(isset($_COOKIE['nav_bar']) != false) ? 'glyphicon-arrow-up' : 'glyphicon-arrow-left'}}"></i>--}}
        {{--<input type="checkbox" value="1" name="active_top_slide" style="display:none;" {{(isset($_COOKIE['nav_bar']) != false) ? 'checked' : ''}}>--}}
    {{--</div>--}}
</div>