<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

	<body>

		<div class="tab">
		  <button class="tablinks" onclick="openCity(event, 'London')"><i class="fa fa-comment"></i></button>
		  <button class="tablinks" onclick="openCity(event, 'Paris')"><i class="fa fa-user-plus"></i></button>
		  <button class="tablinks" onclick="openCity(event, 'Tokyo')"><i class="fa fa-sun-o"></i></button>
		</div>

		<div id="London" class="tabcontent">
		  <h3>London</h3>
		  <p>London is the capital city of England.</p>
		</div>

		<div id="Paris" class="tabcontent">
		  <h3>Paris</h3>
		  <p>Paris is the capital of France.</p> 
		</div>

		<div id="Tokyo" class="tabcontent">
		  <h3>Tokyo</i></h3>
		  <p>Tokyo is the capital of Japan.</p>
		</div>

		<script>
		function openCity(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		}
	</script>
     
</body>
</html>