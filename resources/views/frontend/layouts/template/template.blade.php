<!DOCTYPE html>
<html class="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no"/>
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>ANDAMAN INDIGO PHUKET</title>
		<meta name="author" content="codepixer">
		<meta name="description" content="">
		<meta name="keywords" content="">
        <style>
			@import url('https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap');
		</style>
		@include("/frontend/layouts/css/css")
	</head>
	<body>
        @include("frontend/layouts/navbar/navbar")
		<main id="main" style="margin-top: 10rem !important;">
            @yield("content")
		</main>
        @include("frontend/layouts/footer/footer")
		@include("frontend/layouts/js/js")
	</body>
</html>