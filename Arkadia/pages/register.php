<?
	$link=sql_connect($db_host_name, $db_user, $bd_pass, $db_name);
	if (!empty($_POST['r_name']) and !empty($_POST['r_login']) and !empty($_POST['r_password'])and !empty($_POST['r_phone']) and !empty($_POST['rpt_password']) and ($_POST['r_password']==$_POST['rpt_password']))
		{
			$result = mysqli_query ($link,"INSERT INTO `Users` (`user_id`,`user_name`, `user_login`,`user_password`,`user_phone`, `user_check`) VALUES ('NULL','".$_POST['r_name']."','".$_POST['r_login']."','".$_POST['r_password']."','".$_POST['r_phone']."','normal_user')")or die('Запрос не удался: ' . mysqli_error($link));
			$r_a=$result?'Информация занесена в базу данных':'Информация не занесена в базу данных';
			echo '<meta http-equiv="Refresh" content="0; url=login.php" />';
			
		}		
		echo '
				<main class="bgLogin">
					<section class="login container">
						<form class="registration-form" method="post">
							<input type="text" name="r_name" placeholder="name">
							<input type="text" name="r_login" placeholder="login">
							<input type="password" name="r_password" placeholder="password">
							<input type="password" name="rpt_password" placeholder="password repeat">
							<input type="tel" name="r_phone" placeholder="phone">
							<input type="reset" value="Reset">
							<input class="sub-registr" type="submit" value="Register">
							<font color="red">'.$r_a.'</font>
						</form>
					</section>
				</main>';
?>