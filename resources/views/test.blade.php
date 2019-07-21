<!DOCTYPE html>
<html lang="ja" dir="ltr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
		<title>@yield('title')</title>
	</head>
	<body>
		<div id="image">
			<img src="images/avatar.jpg"/> 
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(function() {
		    $('#image').on('click', function() {
		      $(this).addClass('animated fadeOut')
		    });
		});
	</script>
	</body>
</html>