<?	
	if(empty($_POST)){
		echo'
		<div class="form-product">
			<h3>Hi, admin! Make your choise!</h3>
			<form clfss="login form" method="post">
				<div class="admin-btns">
					<button class="profile-btn-ex" type="submit" name="choise" value="new">Look new orders</button>
					<button class="profile-btn-ex" type="submit" name="choise" value="in_work">Look "in work" orders</button>
					<button class="profile-btn-ex" type="submit" name="choise" value="done">Look done orders</button>
				</div>
			</form>
		</div>
		';
	}	
	if(!empty($_POST['choise']) and $_POST['choise']=='new'){
		$_SESSION['list_choise']=$_POST['choise'];
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}	
	if(!empty($_POST['choise']) and $_POST['choise']=='in_work'){
		$_SESSION['list_choise']=$_POST['choise'];
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}	
	if(!empty($_POST['choise']) and $_POST['choise']=='done'){
		$_SESSION['list_choise']=$_POST['choise'];
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}
?>