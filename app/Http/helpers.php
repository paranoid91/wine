<?php
if (! function_exists('get_role_permissions'))
{
    /**
     * @param $name
     * @return array|bool
     */
    function get_role_permissions($name,$extra = [])
    {
        if(Illuminate\Support\Facades\Auth::check()){
            $auth = Illuminate\Support\Facades\Auth::user();
            $array = $auth->roles[0]->permissions;
            if(is_array($array)){
                if(count($extra) > 0 && isset($array[$name])){
                    $array[$name] = $array[$name] + $extra;
                }
                if(array_key_exists($name,$array)){
                    return array_keys($array[$name]);
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
}


if(! function_exists('get_modules')){
    /**
     * @return mixed
     */
    function get_modules(){
        $module_list = App\Models\Admin\Module::where('status',1)->orderBy('sort','asc')->get();
        return $module_list;
    }
}


if(! function_exists('get_module_names')){
    /**
     * @param array $except
     * @return array|bool
     */
    function get_module_names($except = array()){
        if(count(get_modules()) > 0){
            $module_names_array = array();
            $module_names = get_modules();
            foreach($module_names as $item):
                if(!in_array($item->name,$except)){
                    $module_names_array[] = $item->name;
                }
            endforeach;
            return $module_names_array;
        }else{
            return false;
        }
    }
}


if(! function_exists('CatList')){
    /**
     * @param $categories
     * @param int $parent
     * @param int $i
     * @return array
     */
    function CatList($categories,$parent = 0, $i = 0){
        $line = ($i == 0) ? '' : '-';
        for($a=0;$a<$i;$a++){
            $line .= $line;
        }
        $i++;
        $result = array();
        if(!is_null($categories) && count($categories) > 0) {
            foreach($categories as $key => $cat) :
                if($cat->parent == $parent) {
                    unset($categories[$key]);
                    $result[$cat->id]['name'] = $cat->name;
                    $result[$cat->id]['child'] = CatList($categories, $cat->id, $i);
                }
            endforeach;
        }
        return $result;
    }
}


if (! function_exists('parseAndPrintTree'))
{
    function parseAndPrintTree($tree, $root=0,$i=0)
    {

        $line = ($i == 0) ? '' : '-';
        for($a=0;$a<$i;$a++){
            $line .= $line;
        }
        $i++;
        if(!is_null($tree) && count($tree) > 0) {
            foreach($tree as $child => $parent) {
                if($parent->parent == $root) {
                    unset($tree[$child]);
                    echo '<tr> <td>'.$parent->id.'</td> <td><a href="'.action("Admin\\CatController@showSubCat",$parent->id).'">'.$line.' '.trans($parent->name).'</a></td> <td>'.$parent->slug.'</td><td>';

//                    if($root > 0){
//                        echo '<input type="number" value="'.$parent->sort.'" min="-128" max="127" data-url="'.action('Admin\CatController@sort',$parent->id).'" data-token="'.csrf_token().'" style="width:60px;">';
//                    }
                    echo '</td><td>';
                    if($root > 0 or Auth::user()->hasRole('Super Admin')):
                        echo'<a href="'.action('Admin\CatController@edit',$parent->id).'"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                         <a class="remove-modal" data-toggle="modal" data-target="#RemoveModal" data-url="'.action('Admin\CatController@destroy',$parent->id).'" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
                    endif;
                    echo '</td>';
                    parseAndPrintTree($tree, $parent->id,$i);
                    echo '</tr>';

                }
            }
        }
    }
}

if(!function_exists('get_cat_json')){
    function get_cat_json($id,$categories){
        $cats = array();
        $output = '';
        if(count($categories) > 0){
            foreach($categories as $item):

                if($item->parent == $id){
                    $cats['id'] = $item->id;
                    $cats['text'] = $item->name;
                    $output .= json_encode($cats,JSON_UNESCAPED_UNICODE);
                    $output .= ',';
                }
            endforeach;
        }
        return (strlen($output) > 1) ? substr($output,0,(strlen($output)-1)) : '';
    }
}


if(!function_exists('get_cat_array')){
    function get_cat_array($id,$categories){
        $cats = array();
        if(count($categories) > 0 && $id > 0){
            foreach($categories as $item):
                if($item->parent == $id){
                    $cats[$item->id] = trans('admin.'.$item->name);
                }
            endforeach;
        }
        return $cats;
    }
}

if(! function_exists('get_trans')){
    function get_trans($file,$name){
        return trans($file.'.'.$name);
    }
}

if(! function_exists('idAsKey')){
    function idAsKey($array,$name = 'name'){
        $result = [];
        if(count($array) > 0){
            foreach($array as $key=>$item){
                $result[$item->id] = $item->$name;
            }
        }
        return $result;
    }
}

if(! function_exists('NameAsKey')){
    function NameAsKey($array,$name = 'name'){
        $result = [];
        if(count($array) > 0){
            foreach($array as $key=>$item){
                $result[$item->$name] = $item->$name;
            }
        }
        return $result;
    }
}

if(!function_exists('get_languages')){
    function get_languages($lang_id = 0,$lang = '',$query = ''){
        $languages = Config::get('global.languages');
        if($lang_id > 0){
            $items = (empty($query)) ? App\Models\Admin\Data::select('lang')->where('lang_id',$lang_id)->get() : $query;
            if(count($items) > 0){
                foreach($items as $item){
                    if($item->lang <> $lang){
                        unset($languages[$item->lang]);
                    }
                }
            }
        }
        return $languages;
    }
}

if(!function_exists('get_data_lang')){
    function get_data_lang($key){
        return (isset(Config::get('global.languages')[$key])) ? Config::get('global.languages')[$key] : '';
    }
}

if(!function_exists('extra_field')){
    function extra_field($array = array(),$field){
        if(count($array) > 0){
            if (array_key_exists($field,$array)){
                return array_only($array,[$field])[$field];
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}

if(!function_exists('get_cat')){
    function get_cat($array,$main = false){
        if(count($array) > 0){
            if($main){
                return array_pluck($array,'id')[1];
            }else{
                return array_pluck($array,'id');
            }
        }else{
            return null;
        }
    }
}


if(!function_exists('list_of_countries')){
    function list_of_countries(){
        $countries = Cache::rememberForever('countries_'.App::getLocale(),function(){
            return App\Country::select('*')->get();
        });
        return $countries->toArray();
    }
}


if(!function_exists('list_of_users')){
    function list_of_users(){
        $users = Cache::rememberForever('users',function(){
            return App\User::select('id','email')->where('verify',1)->get();
        });
        return $users;
    }
}

if(!function_exists('list_of_companies')){
    function list_of_companies(){
        $companies = Cache::rememberForever('user_company',function(){
            return App\Models\Admin\Company::select('id','company_name')->get();
        });
        return $companies;
    }
}

if(!function_exists('list_of_studios')){
    function list_of_studios(){
        $studios = Cache::rememberForever('studios',function(){
            return App\Studio::select('id','name')->get();
        });
        return $studios;
    }
}


if(!function_exists('get_file_by_type')){
    function get_file_by_type($files,$type='movie',$status=0,$size=150){
        $result = array();
        if(count($files) > 0){
            foreach($files as $key=>$file){
                if($file->type == $type && $file->status == $status){
                    $result[$key]['path'] = $file->file_path.$file->name.'_'.$size.'.'.$file->ext;
                    $result[$key]['id'] = $file->id;
                }
            }
        }
        return $result;
    }
}


if(!function_exists('get_poster')){
    function get_poster($files,$size){
        $result = false;
        if(count($files) > 0){
            $result = array();
            foreach($files as $key=>$file){
                if($file->type == 'image' && $file->status == 1){
                    if(!empty($file->file_path) && !empty($file->ext)){
                        $result['path'] = $file->file_path.$file->name.'_'.$size.'.'.$file->ext;
                        $result['id'] = $file->id;
                    }else {
                        $result['id'] = $file->id;
                        if($size <= 0){
                            $result['path'] = $file->name;
                        }else{
                            if($size == 122){
                                $result['path'] = str_replace('files','thumbs',$file->name);
                            }else{
                                $explode = explode('/',$file->name);
                                $filename = $explode[(count($explode) - 1)];
                                $result['path'] = str_replace($filename,$size.'/'.$filename,str_replace('files','thumbs',$file->name));
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }
}


if(!function_exists('get_filename')){
    function get_filename($files,$html=false){
        if(count($files) > 0){
            if($html != false){
                return (isset($files['path'])) ? $files['path'] : '';
            }else{
                return (isset($files['path'])) ? '<img src="'.asset($files['path']).'" width="100%" />' : '';
            }
        }
    }
}


if(!function_exists('get_categories')){
    function get_categories($parent){
        $categories = Cache::rememberForever('categories_'.$parent,function() use ($parent){
            return App\Models\Admin\Cat::select('id','name','icon')->where('parent',$parent)->get();
        });
        return $categories;
    }
}

if(!function_exists('translate_items')){
    function translate_items($categories,$name='name'){
        $cat = [];
        if(count($categories) > 0){
            foreach($categories as $item){
                $cat[$item->id]['name'] = trans('front.'.$item->$name);
                $cat[$item->id]['icon'] = (strpos($item->icon,'uploads') == true) ? '<span style="display:inline-block"><img src="'.asset($item->icon).'"></span>' : '<span class="'.$item->icon.'" style="display:inline-block"></span>';
            }
        }
        return $cat;
    }
}

if(!function_exists('numbers_array')){
    function numbers_array($start,$end,$operator = ''){
        $numbers = [];
        for($i=$start;$i<=$end;$i++){
            $numbers[] = $i.$operator;
        }
        return $numbers;
    }
}

if(!function_exists('get_sid')){
    function get_sid($sid,$data){
        $result = Cache::rememberForever($sid.'_'.\App::getLocale(),function() use ($sid,$data){
            if(is_numeric($sid)){
                return $data->where('id',$sid)->where('lang',\App::getLocale())->first();
            }else{
                $get = $data->select('lang_id')->whereSlug($sid)->first();
                return $data->where('lang_id',$get->lang_id)->where('lang',\App::getLocale())->first();
            }
        });
        return $result;
    }
}

if(!function_exists('get_cats')){
    function get_cats(){
        $cats = Cache::rememberForever('cats',function() {
            return App\Models\Admin\Cat::select('id','name','parent')->get();
        });
        return $cats;
    }
}

if(!function_exists('get_cat_by_parent')){
    function get_cat_by_parent($id){
        $cats = array();
        if(count(get_cats()) > 0){
            $i=0;foreach(get_cats() as $item):
                if(is_array($id)){
                    if(in_array($item->parent,$id)){
                        $cats[$i]['id'] = $item->id;
                        $cats[$i]['parent'] = $item->parent;
                        $cats[$i]['name'] = $item->name;
                    }
                }else{
                    if($item->parent == $id){
                        $cats[$i]['id'] = $item->id;
                        $cats[$i]['parent'] = $item->parent;
                        $cats[$i]['name'] = $item->name;
                    }
                }

                $i++;
            endforeach;
        }
        return $cats;
    }
}

if(!function_exists('get_pages')){
    function get_pages($num,$cat = 1){
        $pg = array();
        if(!is_array($num)){
            $category = $num;
        }else{
            $category  = $cat;
        }

        $pages = Cache::rememberForever('pages_'.$category .'_'.\App::getLocale() ,function() use ($category){
            return App\Models\Admin\Data::select('id','slug','title','text')->where('lang',\App::getLocale())->bycat('pages')->published()->get();
        });
        if(is_array($num) && count($num) > 0){
            foreach($pages as $page){
                if(in_array($page->id,$num)){
                    $pg[] = $page;
                }
            }
            return $pg;
        }else{
            return $pages;
        }
    }
}

if(!function_exists('get_setting')){
    function get_setting($name){
        $value = false;
        $setting = Cache::rememberForever('settings_'.\App::getLocale(),function() {
            return App\Setting::select('value','name')->where('lang',\App::getLocale())->first();
        });
        if($setting){
            if($setting->name == $name){
                $value = $setting->value;
            }
            return $value;
        }else{
            return false;
        }
    }
}

if(!function_exists('bootstrap_menu')){
    function bootstrap_menu($list){
        $output = '';
        if(count($list) > 0){
            foreach($list as $l){
                $l->superselect = str_replace(url('/'),url('/').'/'.\App::getLocale(),$l->superselect);
                if(isset($l->children) && count($l->children) > 0){
                    $children = '<ul class="dropdown-menu">'.bootstrap_menu($l->children).'</ul>';
                    $icon = '<i class="fa fa-caret-down"></i>';
                    $dropdown = 'dropdown';
                }else{
                    $children = '';
                    $icon = '';
                    $dropdown = '';
                }
                if(Request::url() != url('/') && $l->superselect == Request::url()){
                    $active = 'active';
                }else{
                    if(Request::url() == $l->superselect or Request::url() == str_replace('/'.\App::getLocale(),'',$l->superselect)){
                        $active = 'active';
                    }else{
                        $active = '';
                    }
                }
                $output .= '<li class="'.$dropdown.' '.$active.'"><a href="'.$l->superselect.'">'.$l->title.' '.$icon.'</a> '.$children.'</li>';
            }
        }

        return $output;
    }
}

if(!function_exists('post_content')){
    function post_content($content) {
        if(false !== strpos($content,'[')){
            preg_match_all("/\[[^\]]*\]/", $content, $matches);
            if(count($matches) > 0){
                foreach($matches as $match){
                    if(count($match) > 0){
                        foreach($match as $m){
                            $r1 = str_replace('[','',$m);
                            $r2 = str_replace(']','',$r1);
                            $r3 = explode('.',$r2);
                            if(file_exists(base_path('resources/views/'.join('/',$r3).'.blade.php'))){
                                $placed = view($r2,compact('items'));
                                $content = str_replace($m,$placed,$content);
                            }
                        }
                        return html_entity_decode($content);
                    }
                }
            }
        }
        return html_entity_decode($content);
    }
}


if(!function_exists('save_request_session')){
    function save_request_session($request,$session_name){
        if(isset($request['reset']) && $request['reset'] > 0){
            session()->forget($session_name);
        }elseif(count($request) > 1){
            session([$session_name=>$request]);
            return session($session_name);
        }elseif(count(session($session_name)) > 0){
            return session($session_name);
        }else{
            return false;
        }
    }
}


if(!function_exists('is_key')){
    function is_key($object,$key){
        if(isset($object[$key])){
            return $object[$key];
        }
    }
}

if(!function_exists('explode_url')){
    function explode_url($url,$index = 0,$sep = '/'){
        if(!empty($url)){
            $explode = explode($sep,$url);
            if(count($explode) > 0){
                if(isset($explode[$index])){
                    return $explode[$index];
                }else{
                    return '';
                }

            }
        }
    }
}

if(!function_exists('get_permalink')){
    function get_permalink(){
        $url = URL::to('/');
        $current = URL::current();
        $languages = Config::get('global.languages');
        if(!empty($url) && !empty($current)){
            $result = str_replace($url,'',$current);
            if(str_replace('/','',explode_url($result)) != Config::get('app.locale')){
                $result = str_replace(\App::getLocale().'/','',$result);
            }

            $result = (in_array(str_replace('/','',$result),array_keys($languages))) ? '' : $result;
            return $result;
        }
    }
}

if(!function_exists('get_title')){
    function get_title(){
        return Config::get('global.title');
    }
}

if(!function_exists('get_meta')){
    function get_meta(){
        $output = '<meta name="description" content="'.str_limit(strip_tags(Config::get('global.description')),150).'"/>
                   <meta name="keywords" content="'.Config::get('global.keywords').'"/>
                  <meta property="og:type" content="article" />
                  <meta property="og:title" content="'.Config::get('global.title').'" />
                  <meta property="og:description" content="'.str_limit(strip_tags(Config::get('global.description')),300).'" />
                  <meta property="og:image"  content="'.url(Config::get('global.img')).'" />';
        return $output;
    }
}

if(!function_exists('set_meta')){
    function set_meta($request){
        if($request){
            Config::set('global.title',$request->title);
            Config::set('global.description',$request->text);
            Config::set('global.img',$request->img);
        }
    }
}

if(!function_exists("selectProdCat")){

    function selectProdCat($cat)
    {
        return \DB::select("SELECT `id`,`parent`,`name` FROM `is_categories` WHERE `parent` = (SELECT `id` FROM `is_categories` WHERE `name` = '{$cat}')");
    }
}

if(!function_exists('get_image')){
    /**
     * @param $file
     * @param int $size
     * @return mixed|string
     */
    function get_image($file, $size = 0){
        if(count($file) > 0){
            if(empty($file->file_path) && empty($file->ext)){
                if($size <= 0){
                    return $file->name;
                }else{
                    if ($size == 122) {
                        if(file_exists(str_replace('files', 'thumbs', $file->name))){
                            return str_replace('files', 'thumbs', $file->name);
                        }else{
                            return $file->name;
                        }
                    } else {
                        $explode = explode('/', $file->name);
                        if(count($explode) > 0){
                            $filename = $explode[(count($explode) - 1)];
                            $new_img = str_replace($filename, $size . '/' . $filename, str_replace('files', 'thumbs', $file->name));
                        }else{
                            $new_img = '';
                        }

                        if(file_exists($new_img) && !empty($new_img)){
                            return $new_img;
                        }else{
                            return $file->name;
                        }
                    }
                }
            }else{
                return '/'.$file->file_path.$file->name.'_'.$size.'.'.$file->ext;
            }
        }
    }
}

if(!function_exists('unset_by_value')){
    /**
     * @param $array
     * @return mixed
     */
    function unset_by_value($array){
        if(count($array) > 0){
            foreach($array as $key=>$ar){
                if($ar == 0){
                    unset($array[$key]);
                }
            }
        }
        return $array;
    }
}

if(!function_exists('get_thumb')){
    /**
     * @param $url
     * @param string $size
     * @return mixed
     */
    function get_thumb($url, $size = 'small'){
        if(!empty($url)){
            switch($size){
                case 'big' :
                    $img = $url;
                    break;
                case 'normal' :
                    $img = str_replace('files/','thumbs/300/',$url);
                    break;
                default:
                    $img = str_replace('files/','thumbs/',$url);
                    break;
            }
            return $img;
        }
    }
}

if(!function_exists('displayFlag'))
{
    function displayFlag()
    {
        $start = "<img src='";
        $end = "' width='24'>";

        switch(\App::getLocale()):
            case "ka": return $start. asset('frontend/img/georgian-flag.png') .$end;
            case "ru": return $start . asset('frontend/img/russian-flag.png') .$end;
            default : return $start. asset('frontend/img/united-kingdom-great-britain.png') .$end;
        endswitch;
    }
}

if(!function_exists('printSliderPics'))
{
    function printSliderPics($images)
    {
        foreach($images as $image)
        {
            echo "<div class='swiper-slide' style='background-image:url(". asset($image->name) .")'></div>";
        }
        
        return null;
    }
}