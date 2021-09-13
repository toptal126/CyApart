<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/assets/bootstrap/bootstrap.min.css">
	<script src="/assets/bootstrap/jquery.min.js"></script>
	<script src="/assets/bootstrap/bootstrap.min.js"></script>
	<script src="/assets/bootstrap/popper.min.js"></script>

</head>
<style type="text/css">
	html,
body {
	height: 100%;
}

body {
	display: -ms-flexbox;
	display: -webkit-box;
	display: flex;
	-ms-flex-align: center;
	-ms-flex-pack: center;
	-webkit-box-align: center;
	align-items: center;
	-webkit-box-pack: center;
	justify-content: center;
	padding-top: 40px;
	padding-bottom: 40px;
	background-image: url("/assets/img/bg-login-img.jpg")
}

.form-signin {
	width: 100%;
	max-width: 330px;
	padding: 15px;
	margin: 0 auto;
}
.form-signin .checkbox {
	font-weight: 400;
}
.form-signin .form-control {
	position: relative;
	box-sizing: border-box;
	height: auto;
	padding: 10px;
	font-size: 16px;
}
.form-signin .form-control:focus {
	z-index: 2;
}
.form-signin input[type="email"] {
	margin-bottom: -1px;
	border-bottom-right-radius: 0;
	border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
	margin-bottom: 10px;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}
</style>
<body>
	<form class="form-signin" action="/login" method="post">
		<h1 class="h3 mb-3 font-weight-normal text-white">Please sign in </h1>
		<h4 class="text-danger"><?= $message ?></h4>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<div class="checkbox mb-3 text-white">
			<label>
				<input type="checkbox" value="remember-me" name="rememberbe"> Remember me
			</label>
		</div>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	</form>
</body>
<script src="/assets/js/apartArray.js" type="text/javascript"></script>
<script src="/assets/js/apartArray1.js" type="text/javascript"></script>

<script type="text/javascript">
	var openLen = openArray.length;
	var allLen = apartArray.length;
	var soldArray = Array();
	console.log(apartArray[0]);
	var cnt = 0;
	var flg = 0;

	for (var j = allLen - 1; j >= 0; j--) {
		flg = 0;
		for (var i = openLen - 1; i >= 0; i--) {
			if (openArray[i].title == apartArray[j].page.attrs.name.value){
				flg = 1;
				break;
			}
		}
		if (flg)
			continue;
		soldArray.push({});
		soldArray[cnt].id = j + 70;
		soldArray[cnt].good_sqm = apartArray[j].page.attrs.area.value;
		soldArray[cnt].path = apartArray[j].coordinates;
		soldArray[cnt].price = soldArray[cnt].good_sqm * 50000;
		soldArray[cnt].cost = 0;
		soldArray[cnt].status = 0;
		soldArray[cnt].bedroom = apartArray[j].page.attrs.bedrooms.value;
		soldArray[cnt].title = apartArray[j].page.attrs.name.value;
		// console.log(j);
		soldArray[cnt].apart_id = soldArray[cnt].title.replace(' ', '').toLowerCase();
		soldArray[cnt].image = apartArray[j].page.image.source.url.split('/').at(-1);
		cnt ++;
	}
	console.log(soldArray);
	/*
	for (var i = openLen - 1; i >= 0; i--) {
		for (var j = allLen - 1; j >= 0; j--) {
			if (openArray[i].title == apartArray[j].page.attrs.name.value){
				openArray[i].path = apartArray[j].coordinates;
				openArray[i].status = 1;
				openArray[i].cost = 0;

				openArray[i].address = '';
				openArray[i].image = apartArray[j].page.image.source.url.split('/').at(-1);
				openArray[i].room_images = '';

				openArray[i].id = i + 30;
				if (openArray[i].terrace_sqm) openArray[i].terrace_sqm = openArray[i].terrace_sqm;
				else openArray[i].terrace_sqm = 0;
				if (openArray[i].balcony_sqm) openArray[i].balcony_sqm = openArray[i].balcony_sqm;
				else openArray[i].balcony_sqm = 0;
				if (openArray[i].story) openArray[i].story = openArray[i].story; else openArray[i].story = 0;
				if (openArray[i].floor) openArray[i].floor = openArray[i].floor; else openArray[i].floor = 0;
				openArray[i].apart_id = openArray[i].title.replace(' ', '').toLowerCase();
				
				cnt ++;
				break;
			}
		}
	}*/

	console.log(openArray);

	// console.log(apartArray[10]);
	console.log(apartArray[0].page.attrs.status.value); // forSale sold
	console.log(apartArray[0].page.image.source.url); // image
	console.log(apartArray[0].page.attrs.name.value); // title
	console.log(apartArray[0].page.attrs.area.value); // good_sqm
	console.log(apartArray[0].page.attrs.bedrooms.value); // bedroom
	console.log(apartArray[0].coordinates); // path
</script>	
</html>
