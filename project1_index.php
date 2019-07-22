
<?php
	session_start();
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']==false)
		{
			header("Location:project1_login.php");
		}
		if(isset($_POST['logout']))
		{
			session_unset();
			session_destroy();
			header("Location: project1_index.php");
		}
?>


<?php
		if(isset($_SESSION['myname']) && $_SESSION['myname']==true)
		{
			echo'Hi  ',$_SESSION['myname'];	
			$name=$_SESSION['myname'];
		}

	$host="localhost";
	$user="root";
	$password="";
	$con=mysqli_connect($host, $user, $password);
	mysqli_select_db($con,"project1");
	
	$qry1="select * from $name;";
	$result1=mysqli_query($con,$qry1);
	
	echo'<br><br> Your Expenditures are:<br><br>';
	$gt=0;
	while($row=mysqli_fetch_array($result1, MYSQLI_ASSOC))
	{
		$st=$gt;
		$D=$row['day'];
		$F=$row['food'];
		$T=$row['transport'];
		$O=$row['others'];
		$To=$F+$T+$O;
		$gt=$To+$st;
		echo'|    Day---->',$D,'|    food---->',$F,'|    Transport---->',$T,'|    Others---->',$O,'|    Total---->',$To,'|    Grand Tot---->',$gt,'<br>';
	}
	
	if(isset($_POST['submit']))
	{
		$food=$_POST['food'];
		$trans=$_POST['trans'];
		$others=$_POST['others'];
		$total=$food+$trans+$others;

		$entry="INSERT INTO $name
			(food, transport, others, total)
			value
			('$food', '$trans', '$others', '$total');";
		$entr=mysqli_query($con,$entry);
		if(!$entr)
		{
			die('data cannot be saved: '. mysqli_error($con));
		}
		header("Location: project1_index.php");

	}
	elseif(isset($_POST['delete']))
	{
		$qry2="drop table $name;";
		mysqli_query($con,$qry2);
		$qry3="delete from register where name='$name';";
		mysqli_query($con,$qry3);
		$_SESSION['loggedin']=false;
		header("Location: project1_index.php");
	}
?>	

<html>
<body>
	<form action="project1_index.php" method="POST">
		<br><br>
		<input type="text" name="food" value="food">
		<input type="text" name="trans" value="transport">
		<input type="text" name="others" value="others">
		<input type="submit" name="submit" value"Submit">
		<br><br>
		<input type="submit" name="logout" value="LogOut">
		<input type="submit" name="delete" value="Delete My Account">
	</form>
</html>

