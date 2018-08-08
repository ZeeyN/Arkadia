<?
	session_start();
	if(!empty($_SESSION['user_id']))
		{
			echo '<meta http-equiv="Refresh" content="0; url=home.php" />';
		}
	else
	{
		if(!empty($_POST))
		{
			if(!empty($_POST['e_login']) and !empty($_POST['e_password']))
			{
				$link = sql_connect($db_host_name, $db_user, $bd_pass, $db_name);
				$query = 'SELECT * FROM Users';
				$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));
				while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) 
				{
					if($_POST['e_login'] == $line['user_login'] and $_POST['e_password'] == $line['user_password'])
					{
						$_SESSION['user_id'] = $line['user_id'];
						echo '<meta http-equiv="Refresh" content="0; url=home.php" />';
					}
					else
					{
						$f_no = true;
					}
				}
				mysqli_free_result($result);
				mysqli_close($link);
				if($f_no)
				{
					echo'Нет сочитания логина с паролем!';
				}
			}
			else
			{
				echo'Не заполнены обязательные поля!';
			}
		}
		echo '
			<main class="bgLogin">
				<section class="login container">
					<form class="login-form" method="post">
						<input type="text" name="e_login" placeholder="Login">
						<input type="password" name="e_password" placeholder="Password">
						<input type="submit" value="Login">
						<button class="register-btn-try" formaction="http://Arkadia/php?name=register">Register</button>
					</form>

				</section>
			</main>';
	}
?>