<?php
	session_start();
	mysqli_connect($conn, "localhost","root","root");
	mysqli_select_db($conn ,"projectce");
	$strSQL = "SELECT * FROM member WHERE Username =  '".mysqli_real_escape_string($conn, $_POST['txtUsername'])."' 
	and Password = '".mysqli_real_escape_string($conn, $_POST['txtPassword'])."'";
	$objQuery = mysqli_query($conn, $strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["UserID"] = $objResult["UserID"];
			$_SESSION["Status"] = $objResult["Status"];

			session_write_close();
			
			if($objResult["Status"] == "ADMIN")
			{
				header("location:admin_page.php");
			}
			else
			{
				header("location:user_page.php");
			}
	}
	mysqli_close($conn);
?>