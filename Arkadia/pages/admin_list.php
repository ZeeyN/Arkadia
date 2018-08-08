<?	
	$new_order=$db->select('SELECT id_order, time, date, master_name, user_name, order_offers, order_prise FROM Orders INNER JOIN Users ON Orders.id_user = Users.user_id INNER JOIN Masters ON Orders.id_master = Masters.id_master WHERE order_check="'.$_SESSION['list_choise'].'"',true);		
	$new_order2=$db->select('SELECT id_order, time, date, master_name, user_name, order_offers, order_prise FROM Orders INNER JOIN Users ON Orders.id_user = Users.user_id INNER JOIN Masters ON Orders.id_master = Masters.id_master WHERE order_check="'.$_SESSION['list_choise'].'" and id_order="'.$_GET['admin_id'].'"',true);
//=============================================CHECK_CHANGER==============================================================	
	if(!empty($_SESSION['list_choise'])){
		if($_SESSION['list_choise']=='new'){
			$bm='<button class="admin-list-btn" type="submit" name="check" value="check">Check</button>';
		}
		if($_SESSION['list_choise']=='in_work'){
			$bm='<button class="admin-list-btn" type="submit" name="check" value="done">Done</button>';
		}
		if($_SESSION['list_choise']=='done'){
			$bm='';
		}
	}	
	if(!empty($_SESSION['list_choise']) and $_SESSION['list_choise']=='new' and $_POST['check']=='check'){
		$db->request('UPDATE Orders SET order_check = "in_work" WHERE id_order="'.$new_order2['id_order'].'"');
		unset($_GET['admin_id']);
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}	
	if(!empty($_SESSION['list_choise']) and $_SESSION['list_choise']=='in_work' and $_POST['check']=='done'){
		$db->request('UPDATE Orders SET order_check = "done" WHERE id_order="'.$new_order2['id_order'].'"');
		unset($_GET['admin_id']);
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}
//========================================================================================================================
//================================================UPDATER=================================================================
	if(!empty($_POST['up_date']) and !empty($_POST['up_time']) and !empty($_POST['up_offers']) and !empty($_POST['up_prise']) and $_POST['update']==true){
		$db->request('UPDATE Orders SET date="'.$_POST['up_date'].'", time="'.$_POST['up_time'].'", order_offers="'.$_POST['up_offers'].'", order_prise="'.$_POST['up_prise'].'" WHERE id_order="'.$new_order2['id_order'].'"');
		unset($_GET['admin_id']);
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}
//========================================================================================================================
	if($_POST['back_to_admin']==true){
		unset($_SESSION['list_choise']);
		echo '<meta http-equiv="Refresh" content="0; url=admin.php" />';
	}	
	if($_POST['admin_back']==true and !empty($_GET['admin_id'])){
		unset($_GET['admin_id']);
		echo '<meta http-equiv="Refresh" content="0; url=admin_list.php" />';
	}	
	if(empty($_GET['admin_id'])){
		echo'
		<main>
			<section class="profile-page">
				<div class="container">
					<div class="list-order">
						<h2>List of orders</h2>
						<form method="post"><button class="profile-btn-ex" type="submit" name="back_to_admin" value="true">Back</button></form>
						<ul>';
							foreach($new_order as $new_items){ 
								echo'<li><a href="admin_list.php?admin_id='.$new_items['id_order'].'">ID: '.$new_items['id_order'].' Name: '.$new_items['user_name'].' Date: '.$new_items['date'].' Time: '.$new_items['time'].'========> Offer: '.$new_items['order_offers'].'</a></li><br>';
							}
						echo'</ul>
					</div>
				</div>
			</section>
		</main>';
	}	
	if(!empty($_GET['admin_id'])){
		echo'
			<main>
				<section class="admin-list-page">
					<div class="container">
						<form method="post">
							<p>ID: '.$new_order2['id_order'].'</p>
							<p>Name: '.$new_order2['user_name'].'</p>
							<br>
							<p>Date: <input type="date" name="up_date" value="'.$new_order2['date'].'" ></p>
							<p>Time: <input type="time" name="up_time" value="'.$new_order2['time'].'" ></p>
							<p>Offers: <input type="text" name="up_offers" value="'.$new_order2['order_offers'].'" ></p>
							<p>Master: <input type="text" value="'.$new_order2['master_name'].'" readonly></p>
							<p>Prise: <input type="text" name="up_prise" value="'.$new_order2['order_prise'].'" ></p>
							<br>
							<button class="admin-list-btn" type="submit" name="admin_back" value="true">Back</button>
							<button class="admin-list-btn" type="submit" name="update" value="true">Update info</button>
							'.$bm.'
						</form>
					</div>
				</section>
			</main>
			';
	}
?>