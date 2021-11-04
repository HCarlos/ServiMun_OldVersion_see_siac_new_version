<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }}</title>

<link href="{{ asset('images/favicon/favicon.png') }}" rel="shortcut icon">
<link href="{{ asset('images/favicon/favicon-72-72.png') }}" rel="shortcut icon" sizes="72x72">
<link href="{{ asset('images/favicon/favicon-114-114.png') }}" rel="apple-touch-icon" sizes="114x114">
<link href="{{ asset('images/favicon/favicon-157-157.png') }}" rel="apple-touch-icon" sizes="157x157">
<link href="https://fonts.googleapis.com/css?family=Raleway|PT+Sans+Narrow|Roboto:400,400i,500,500i|Roboto+Mono|Roboto+Condensed|Kaushan+Script&effect=3d-float" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"><!-- third party css -->
<link href="{{ asset('css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />
<!-- App css -->
<link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/app.css' )}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">

<link href="{{ asset('css/ace-fonts.css') }}" rel="stylesheet">
<link href="{{ asset('css/basic.css') }}" rel="stylesheet">
<link href="{{ asset('css/buttons.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/icons.min.css.map') }}" rel="stylesheet">

<link href="{{ asset('css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('css/select.bootstrap4.css') }}" rel="stylesheet">


<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">

<link href="{{ asset('css/atemun.css') }}" rel="stylesheet"  type="text/css">
<link rel="stylesheet"  href="{{ URL::asset('/css/servimun.css') }}"  />

@yield('styles')
