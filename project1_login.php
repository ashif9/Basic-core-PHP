<?php
	session_start();
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
	{
		header("Location: project1_index.php");
	}

?>

<html>

<body>
	<form action="project1_login.php" method="POST">
		UserName<input type="text" name="user_name">
		<br>
		PassWord<input type="password" name="pass">
		<br>
		<input type="submit" name="signin" value="SignIn">
		<br>
		<input type="submit" name="signup" value="SignUp">
	</form>
</html>

<?php
		

	$host="localhost";
	$user="root";
	$password="";
	$con=mysqli_connect($host, $user, $password);
	mysqli_select_db($con,"project1");
	

	if(isset($_POST['signin']))
	{
		
		$name=$_POST['user_name'];
		$pass=$_POST['pass'];
		echo $name;
		echo $pass;
			$qry="select *from register where user_name='$name';";
			$result=mysqli_query($con,$qry);
			//echo $result;
			$num=mysqli_num_rows($result);
			echo $num;

			if(!$num)
			{
				die('Data not found: '. mysqli_error($con));
			}
			
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			$N=$row['user_name'];
			$M=$row['pass'];
		}

		if($name==$N && $pass==$M)
		{
			$_SESSION['loggedin']=true;
			header("Location: project1_login.php");
			
			session_start();
				{
					$_SESSION['myname']=$name;
				}
		}
		else{
			echo'Please Enter correct password';
		}
	}
	elseif(isset($_POST['signup']))
	{
		header("Location: project1_reg.php");
	}
	
?>