<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{!! $page->meta_desc ?? '' !!}">
    <title>{{ $page->seo_title ?? '' }}</title>
    
    @php
        $favicon = "";
        if(isset($settings->extras)){
            $extras = json_decode($settings->extras ?? '' ,true);
            $favicon = $extras['site-logo'];     
        }
    @endphp
    <link rel="icon" href="/media_uploads/{{$favicon}}" type="image/x-icon">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {{ $page->header_scripts ?? '' }}

    {!! $settings->header_scripts ?? '' !!}
    {!! $all_site_settings->header_scripts ?? '' !!}

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

    {!! $all_site_settings->site_header ?? '' !!}

    <div class="htmlcode">

        {!! Blade::render($page->html ?? abort(404))  !!}

    </div>

    {!! $all_site_settings->site_footer ?? '' !!}

    {!! $settings->footer_scripts ?? '' !!}
    {!! $all_site_settings->footer_scripts ?? '' !!}

    {!! $page->footer_scripts ?? '' !!}

    <script>
        $(document).ready(function(){
            $('#preloader').addClass('preloaderstop');
        });
    </script>

    <style>{!! $all_site_settings->site_css ?? '' !!}</style>
    <style>{!! $settings->nav_css ?? '' !!}</style>


</body>
</html>
