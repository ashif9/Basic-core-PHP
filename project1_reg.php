<html>
<body>
	<form action="project1_reg.php" method="POST">
		<td>
		UserName<input type="text" name="user_name">
		<br>
		PassWord<input type="password" name="pass">
		<br>
		<input type="submit" name="signin" value="Register">
		<input type="submit" name="home" value="Home">
		<br>
		</td>
		SEX:  F<input type="radio" name="sex" value="F">
		M<input type="radio" name="sex" value="M">
	</form>
</html>

<?php
	$host="localhost";
	$user="root";
	$password="";

	$con=mysqli_connect($host, $user, $password);
	mysqli_select_db($con,"project1");
	$qry="select *from register;";
	$result=mysqli_query($con,$qry);
	$num=mysqli_num_rows($result);
	echo'Total Number of users are: ',$num;

	if(isset($_POST['signin']))
	{
			$name=$_POST['user_name'];
			$pass=$_POST['pass'];
			$entry="insert into register value('$name', '$pass');";
			mysqli_query($con,$entry);
			$create="CREATE TABLE $name(
				day int not null auto_increment primary key,
				food float null,
				transport float null,
				others float null,
				total float null);";
			$table=mysqli_query($con,$create);
			if(!$table)
			{
				die('Your data is not saved: '.mysqli_error($con));
			}
			header("Location: project1_index.php");
	}
	elseif(isset($_POST['home']))
		header("Location: project1_login.php");
	
?>