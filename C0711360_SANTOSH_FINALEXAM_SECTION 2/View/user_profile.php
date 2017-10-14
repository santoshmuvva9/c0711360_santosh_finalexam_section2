<!Doctype html>
<html>
	<head>
		<title>user profile</title>
	</head>
	<body>
		<p><?php print "$user->name"; ?></p><br/>
		<p><?php print "$user->address"; ?></p>
		<a href="index.php?op=logout">Logout</a>
	</body>
</html>