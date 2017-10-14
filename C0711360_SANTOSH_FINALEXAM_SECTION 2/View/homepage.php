<!Doctype html>
<html>
	<head>
		<title>Homepage</title>
	</head>
	<body>
		<h1>Sign Up</h1>
		<form method="post" action="index.php?op=signup">
			<input type="text" id="name" name="name" placeholder="name" required/>
			<input type="password" id="password" name="password" placeholder="password" required/>
			<input type="text" id="address" name="address" placeholder="address" required />
			<input type="submit" id="submitbtn" name="signupbtn" value="Signup"/>
		</form>
		<h1>Login</h1>
		<form method="post" action="index.php?op=login">
			<input type="text" id="name" name="name" placeholder="name" required/>
			<input type="password" id="password" name="password" placeholder="password" required/>
			<input type="submit" id="submitbtn" name="loginbtn" value="Login"/>
		</form>
	</body>
</html>