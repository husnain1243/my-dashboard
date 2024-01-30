<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{!! $pages->meta_desc ?? '' !!}">
    <title>{{ $pages['pages']->seo_title ?? '' }}</title>

    @php
        $extras = json_decode($settings['nav_project_data'] ?? '', true);
        $favicon = $extras['favicon'] ?? '';
    @endphp

    <link rel="icon" href="/{{$favicon}}" type="image/x-icon">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    {!! $pages['pages']->header_scripts ?? '' !!}

    {!! $settings->header_scripts ?? '' !!}

</head>

<body>

    {!! $settings->nav_html ?? '' !!}

    <div class="htmlcode">

        {!! eval('?>' . Blade::render($pages['pages']->html ?? abort(404), ['blogs' => $blogs]) . '<?php'); !!}

    </div>

    {!! $settings->footer_html ?? '' !!}

    {!! $settings->nav_css ?? '' !!}

    {!! $pages['pages']->footer_scripts ?? '' !!}

    {!! $settings->footer_scripts ?? '' !!}

</body>
</html>
