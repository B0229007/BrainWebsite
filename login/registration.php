<?php
echo"<div class='opentable'>";
        echo"<center>";
                echo"<font class='title'>";
                        echo"<b>User Login</b>";
                echo"</font>";
        echo"</center>";
echo"</div>";
echo"<br>";

//session_start();
	if(isset($_POST['authnum']) && isset($_POST['authtext']))
	{
		$authnum = $_POST["authnum"];
		$authtext = $_POST["authtext"];

		include_once("codes.php");
		$atext=mb_substr(num2text($authnum),0,5,"UTF-8");
		if ($authtext!=$atext) 
		{
			echo"<h1 style='color:red'>Wrong codes</h1>";
		} 
		else 
		{
				
			if(isset($_POST['username'])||isset($_POST['password']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];
				//$_Session=$username;
				$sql="SELECT * FROM `account` where `username`='".$username."'";
				$result=execute_sql($sql, $link, "Flycircuit");
				$row=get_row($result);
				$dbusername=$row['username'];
				$dbpassword=$row['password'];
				$competence=$row['competence'];
				if($username!=''||$password!='')
				{
					if($username==$dbusername&&$password==$dbpassword)
					{
						$_SESSION['user']=$username;
						$_SESSION['competence']=$competence;
						header("Location: http://140.114.95.72/index.php?loginsucess=1");
					}
					else if($username==$dbusername)
					{
						echo"<h1 style='color:red'>You have type wrong password</h1>";
					}
					else
						echo"<h1 style='color:red'>No such account</h1>";
				}
				else 
				{
					echo"<h1 style='color:red'>Please type your email and password</h1>";
				}
			}
		}
	}
//session_destroy();	
	
	
    // 產生種子與驗證碼, 產生六位數字
    srand((double) microtime() * 1000000);
    while(($authnum = rand() % 1000000) < 100000);
	
	
	
	
echo"<div class='opentable'>";
        echo"<form action='index.php?login=1&&account=1' method='post'>";
                echo"<b>User Login</b>";
                echo"<br><br>";
                echo"<table border='0'>";
                    echo"<tbody>";
						echo"<tr><td>Your Register Email:</td>";
						echo"<td><input type='text' name='username' size='30' maxlength='50'></td></tr>";
						echo"<tr><td>Password:</td>";
						echo"<td><input type='password' name='password' size='15' maxlength='20'></td></tr>";
						echo"<tr><td colspaa='2'>Security Code:";
						echo"<img src='/login/authimg.php?authnum=".$authnum."'></td></tr>";
						echo"<tr><td colspan='2'>Type Security Code:";
						echo"<input type='text' name='authtext' class='file' size='6'></td></tr>";
						echo"<input type='hidden' name='authnum' value=".$authnum."";
                    echo"</tbody>";
                echo"</table>";
                echo"<input type='submit' value='Login'></input>";
        echo"</form><br>";
        echo"<center>";
	echo"<font class='content'>If you forget your password. Please<a href='http://140.114.95.72/index.php?forget=1'>click here</a>.</font>";
		echo"<br><font class='content'>[ <a href='http://140.114.95.72/index.php?new=1'>New User Register</a> ]</font>";
        echo"</center>";
echo"</div>";
?>
