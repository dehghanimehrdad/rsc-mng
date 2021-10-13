<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ url(mix('css/app.css')) }}" rel="stylesheet">
</head>
<body>
<div id="app"></div>

<script src="{{ url(mix('js/app.js')) }}"></script>
</body>
</html>
