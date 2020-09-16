<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Dashboard - Midone - Tailwind HTML Admin Template</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('theme/images/logo.svg') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ url('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('theme/css/custom.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body class="app">
  
  {{ print_r($data) }}
</body>

</html>
