<?php
	echo"<form action='http://140.114.95.72/index.php?forget=1' method='post'>";
	echo"Please type your Email:";
	echo"<input type='text' name='email'>";
	echo"<br><input type='submit' value='Send'></input>";
	echo"</form>";
	if(isset($_POST['email']))
	{
		$email=$_POST['email'];
		$sql="Select * from `account` where `username` = '".$email."'";
		$result=execute_sql($sql, $link, "Flycircuit");
		if(sql_numrows($result)==0)
		{
			echo"No such account,Please check it again";
		}
		else
		{
			$row=get_row($result);
			$password=$row['password'];
			$subject = "Flycircuit website"; //信件標題
			$msg = "YOUR PASSWORD: $password";
			$headers = "Flycircuit2.0 website"; //寄件者
			mail($email,$subject, $msg, $headers);	
		 	echo"The email has been sent";

		}
	}
?>
