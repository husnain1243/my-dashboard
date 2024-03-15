<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{!! $pages->meta_desc ?? '' !!}">
    <title>{{ $pages['pages']->seo_title ?? '' }}</title>
    
    @php
        $favicon = "";
        if(isset($settings->extras)){
            $extras = json_decode($settings->extras ?? '' ,true);
            $favicon = $extras['site-logo'];     
        }
    @endphp
    <link rel="icon" href="/media_uploads/{{$favicon}}" type="image/x-icon">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script> {!! $pages['pages']->header_scripts ?? '' !!} </script>

    {!! $settings->header_scripts ?? '' !!}

</head>

<body>

    <style>
        .preloader{
            background-color: rgba(255 , 255 , 255 , 0.6);
            box-shadow: 0 8px 32px 0 rgba( 31 , 38 , 135 , 0.37);
            backdrop-filter: blur(9.5px);
            -webkit-backdrop-filter: blur (9.5px);
            height: 100vh;
            width: 100%;
            z-index: 999999;
            display: flex;
        }
        .preloaderstop{
            display: none !important;
        }
    </style>
    @php
        $preloader = "";
        if(isset($settings->extras)){
            $site_preloader = json_decode($settings->extras ,true);
            $preloader = $site_preloader['site-logo'];
        }
        
    @endphp
    
    @if($preloader == 'true')
    <div id="preloader" class="preloader justify-content-center align-items-center top-0 position-fixed">
        <img src="/media_uploads/{{$preloader}}" alt={{$preloader}} class="w-25 img-fluid d-block m-auto">
    </div>
    @endif

    {!! $settings->nav_html ?? '' !!}

    <div class="htmlcode">

        {!! eval('?>' . Blade::render($pages['pages']->html ?? abort(404), ['blogs' => $blogData]) . '<?php'); !!}

    </div>

    {!! $settings->footer_html ?? '' !!}

    <style>    {!! $settings->nav_css ?? '' !!} </style>

    {!! $settings->footer_scripts ?? '' !!}

    {!! $pages['pages']->footer_scripts ?? '' !!}

    <script>
        $(document).ready(function(){
            $('#preloader').addClass('preloaderstop');
        });
    </script>

</body>
</html>
