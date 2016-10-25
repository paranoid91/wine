<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024, maximum-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/styles.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/font-awesome/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/bootstrap/css/bootstrap-datetimepicker.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/css/flag_css/flag-icon.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admin/css/menu/jquery.domenu-0.48.53.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/fancybox/source/jquery.fancybox.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/TabStylesInspiration/css/normalize.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/TabStylesInspiration/css/tabs.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/TabStylesInspiration/css/tabstyles.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lib/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}"/>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="{{asset('lib/jquery/js/jquery-1.12.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/jquery/js/jquery-ui.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/bootstrap/tags/chosen.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/bootstrap/js/moment-with-locales.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/bootstrap/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/TabStylesInspiration/js/modernizr.custom.js')}}"></script>
    <script>
        jQuery(function ($) {
            $('.yearpicker').datetimepicker({
                format: 'YYYY',
                locale:moment.locale('ka')
            });
            $('.datepicker').datetimepicker({
                format: 'DD/MM/YYYY',
                locale:moment.locale('ka')
            });
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY HH:mm',
                locale:moment.locale('ka')
            });
        });
    </script>
    <script type="text/javascript" src="{{asset('admin/lib/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector:'textarea.tinymce',
            theme: "modern",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
            toolbar2: "link unlink anchor | image media imgal | boldcolor forecolor backcolor  | print preview code | fontselect fontsizeselect",
            image_advtab: true ,
            external_filemanager_path:"{{ asset('filemanager') }}/",
            filemanager_title:"Filemanager" ,
            external_plugins: { "filemanager" : "{{ asset('/filemanager/plugin.min.js') }}"}

        });
    </script>
    <script type="text/javascript" src="{{asset('lib/fancybox/source/jquery.fancybox.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.fancybox').fancybox({
                'width'		: 900,
                'height'	: 600,
                'type'		: 'iframe',
                'autoSize'    	: false
            }).resize();
        });
    </script>

</head>
<div class="wrapper">
    @include('admin.inc.nav')
    <div class="container">

