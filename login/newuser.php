<script>
	function getvalue(password1,password2,warning,submit)
	{
		if(document.getElementById(password1).value!=document.getElementById(password2).value)
		{
			document.getElementById(warning).innerHTML="Password is different";
			document.getElementById(submit).disabled= true;
			
		}
		else
		{
			document.getElementById(warning).innerHTML="";
			document.getElementById(submit).disabled= false;
		}
	}
</script>
<?php
	echo"<form action='http://140.114.95.72/index.php?new=1' method='post'>";
	echo"<p><strong>New user registration</strong></p>";
	echo"<br>";
	echo"EMAIL:";
	echo"<input type='text' name='email' id='email'>";
	echo"<br><br>Password:";
	echo"<input type='password' name='password' id='password1'>";
	echo"<br><br>Re-type Password:";
	echo"<input type='password'  id='password2' onchange=getvalue('password1','password2','warning','submit')><p style='color:red'id='warning'></p>";
	echo"<input type='submit' id='submit' value='submit'disabled>";
	echo"</form>";
	if(isset($_POST['email']))
	{
		$email=$_POST['email'];
		$sql1="Select * from `account` where `username`='".$email."'";
		$result=execute_sql($sql1, $link,"Flycircuit");		
		if(sql_numrows($result)!=0)
		{
			echo"The account has been registerd before.Please check it again";
		}
		else
		{
                	$password=$_POST['password'];
			$sql2="INSERT INTO `account` (`username` ,`password`,`competence`)VALUES ('".$email."','".$password."','1');";
			$result=execute_sql($sql2, $link,"Flycircuit");
			$msg=
               		"You have been registered Successfully\n
                	";
                	$subject = "Flycircuit website";
                	$headers = "Flycircuit2.0 website";
			mail($email,$subject,$msg,$header);
                	echo"<h3>The mail has sent.Please wait for a minute</h3>";
			echo"<meta http-equiv='refresh' content=\"2;url= 'http://140.114.95.72/index.php'\">";
		}
	}
?>
