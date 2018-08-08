<?
//=============================DB_REQUESTS==========================================================================================//	
	$pr_line=$db->select('SELECT * FROM Users WHERE user_id="'.$_SESSION['user_id'].'"',true);										//
	$o_line=$db->select('SELECT * FROM Orders WHERE id_user="'.$_SESSION['user_id'].'"',true);										//
	$o_line2=$db->select('SELECT * FROM Orders WHERE id_user="'.$_SESSION['user_id'].'" and id_order="'.$_GET['id'].'"',true);		//
	$m_line=$db->select('SELECT master_name FROM Masters WHERE id_master="'.$o_line2['id_master'].'"',true);						//
//==================================================================================================================================//	
	if(!empty($_POST['back']) and $_POST['back']==true){
		unset($_GET['id']);
		echo '<meta http-equiv="Refresh" content="0; url=profile.php" />';
	}	
	if(!empty($_POST['exit']) and $_POST['exit']==true){
		unset($_SESSION['user_id']);
		echo '<meta http-equiv="Refresh" content="0; url=home.php" />';
	}	
	if(!empty($_GET['id'])){
		echo'
		<div style="background: #909090;">
		    <form class="form-product container" method="post">
		    <p>Name: '.$pr_line['user_name'].'</p>
		    <br>
		    <p>Date: <input type="date" value="'.$o_line2['date'].'" readonly></p>
		    <br>
		    <p>Time: <input type="time" value="'.$o_line2['time'].'" readonly></p>
		    <br>
		    <p>Offers: <input type="text" value="'.$o_line2['order_offers'].'" readonly></p>
		    <br>
		    <p>Master: <input type="text" value="'.$m_line['master_name'].'" readonly></p>
		    <br>
		    <p>Prise: <input type="text" value="'.$o_line2['order_prise'].'" readonly></p>
		    <br>
		    <button class="register-btn-try" type="submit" name="back" value="true">Back</button>
		    </form>
		</div>
		';
	}
	if(empty($_GET['id'])){	
		if($pr_line['user_check']=='admin'){
			$a_msg='<p>Hi, admin! Want to <a href="admin.php">enter</a>?<p>';
		}else{$a_msg='';}		
		echo'<main>
			<section class="profile-page">
				<div class="container">
					<p>'.$pr_line['user_name'].'</p>
					'.$a_msg.'
					<form method="post"><button class="profile-btn-ex" type="submit" name="exit" value="true">Exit</button></form>
					<div class="list-order">
						<h2>List of orders</h2>
						<ul>';
							foreach($o_line as $orders){ 
								echo'<li><a href="profile.php?id='.$orders['id_order'].'">Date: '.$orders['date'].' Time: '.$orders['time'].'========> Offer: '.$orders['order_offers'].'</a></li><br>';
							}
						echo'</ul>
					</div>
				</div>
			</section>
		</main>';
	}
?>