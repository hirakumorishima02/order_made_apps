<!DOCTYPE html>
<html lang="ja" dir="ltr">
	<head>
		<meta charset="utf-8">
		<!--MaterializeCSS-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<title>@yield('title')</title>
	</head>
	<body>
		<input type="text" class="datepicker">

		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<script>
			$( function() {
			  $( ".datepicker" ).datepicker({format: 'yyyy-mm-dd'});
			} );
		</script>
	</body>
</html>