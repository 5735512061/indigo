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
		<link rel="icon" href="assets/img/brand/favicon.png" type="image/png">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200&display=swap');
        </style>
		@include("/backend/layouts/css/css")
	</head>
	<body>
		<div class="main-content" id="panel">
			<div class="container-fluid mt-7">
				@yield("content")
			</div>
	    </div>
		@include("backend/layouts/js/js")
	</body>
</html>