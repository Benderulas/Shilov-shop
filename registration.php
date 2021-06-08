<?php



$login = $_POST['login'];
$pass = $_POST['password'];
$hash = '2';
$ip = '2';
$first_name = $_POST['first_name'];
$second_name = $_POST['second_name'];
$email = $_POST['email'];



$res = $mysqli->query("SELECT login "
            . "FROM users "
            . "WHERE login = '" . $login . "'");

	
$res = $res->fetch_assoc();

if ($login == $res['login']) 
{
	echo("login is used already, please, select new one.");
}
else 
{
	$mysqli->query("INSERT INTO users(login, password, hash, ip, first_name, second_name, email) "
        . "VALUES('$login', '$pass', '$hash', '$ip', '$first_name', '$second_name', '$email')");

	$_SESSION['is_auth'] = true;
	$_SESSION['login'] = $login;
	header("Location: http://test/");
}
?>