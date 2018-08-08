<?
;
	function pre($arr)
	{
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
	}
	function sql_connect($db_host_name, $db_user, $bd_pass, $db_name)
	{
		$conn = mysqli_connect($db_host_name, $db_user, $bd_pass)
			or die('Не удалось соединиться: ' . mysqli_error());
		mysqli_select_db($conn,$db_name) or die('Не удалось выбрать базу данных');
		return $conn;
	}
	function user_check()
	{
		if(empty($_SESSION['user_id']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=login.php" />';
		}
		else
		{
			if(!empty($_POST))
			{
				if(!empty($_POST['xx']))
				{
					unset($_SESSION['user_id']);
					echo '<meta http-equiv="Refresh" content="0; url=login.php" />';
				}
			}		
		}
	}
	

?>