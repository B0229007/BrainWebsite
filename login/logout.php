<?php
	if($_SESSION['user'])
	{
		session_destroy();
	}
	header("Location: http://140.114.95.72/index.php?logoutsucess=1");
?>
