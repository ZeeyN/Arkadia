<?
	$p_line=$db->select('SELECT user_name FROM Users WHERE user_id="'.$_SESSION['user_id'].'"',true);	
//================================TIME_JOB==========================//
	$temp_time=$_SESSION['time'];									//
	$exp_time=explode(', ',$temp_time);								//
	array_pop($exp_time);											//
	$unique_time=array_unique($exp_time);							//
	$t_min=min($unique_time);										//
	$t_max_temp=explode(':',max($unique_time));						//
	$t_max_temp[0]++;												//
	$t_max=implode(':',$t_max_temp);								//
//==================================================================//
//===============================OFFER_JOB==========================//
	$temp_offer=$_SESSION['offers'];								//
	$exp_offer=explode(', ',$temp_offer);							//
	array_pop($exp_offer);											//
	$unique_offer=array_unique($exp_offer);							//
//==================================================================//	
//===============================MASTERS_JOB========================//
	$temp_masters=$_SESSION['master'];								//
	$exp_masters=explode(', ', $temp_masters);						//
	array_pop($exp_masters);
	$i=0;
	$m_end=count($exp_masters);
	while($i<$m_end){
		$insert_masters[$i]=$db->select('SELECT id_master FROM Masters WHERE master_name="'.$exp_masters[$i].'"',true);
		$i++;
	}	
	$unique_master=array_unique($exp_masters);						//
//==================================================================//
//======================PRISE_JOB===================================//
	$temp_prise=$_SESSION['prise'];									//
	$exp_prise=explode(', ',$temp_prise);							//
	array_pop($exp_prise);											//
	foreach($exp_prise as $numberz){								//
		$total_prise=$total_prise+$numberz;							//
	}																//
//==================================================================//
//======================COMPLETE_BUTTON_JOB=================================================================================================================================================================================================================================================//
	if($_POST['total_complete']){																																																															//
		$iter=0;																																																																			//
		$end=count($exp_time);																																																																//
		while($iter<$end){																																																																	//
			$db->request("INSERT INTO `Orders` (`id_order`,`time`,`date`,`id_master`,`order_check`,`id_user`,`order_offers`,`order_prise`) VALUES ('NULL','".$exp_time[$iter]."','".$_SESSION['date']."','".$insert_masters[$iter]['id_master']."','new','".$_SESSION['user_id']."','".$exp_offer[$iter]."','".$exp_prise[$iter]."')");	//
			$iter++;																																																																		//
		}
		unset($_SESSION['master'],$_SESSION['date'],$_SESSION['time'],$_SESSION['offers'],$_SESSION['prise']);
		echo '<meta http-equiv="Refresh" content="0; url=profile.php" />';//
	}																																																																						//
//==========================================================================================================================================================================================================================================================================================//
//======================RESET_BUTTON_JOB========================================================================//
	if($_POST['reset_order']){																					//
		unset($_SESSION['master'],$_SESSION['date'],$_SESSION['time'],$_SESSION['offers'],$_SESSION['prise']);	//
		echo '<meta http-equiv="Refresh" content="0; url=order.php" />';										//
	}																											//
//==============================================================================================================//
	echo'
	<div style="background: #909090;">
	    <h3>Last check</h3>
	    <form class="form-order" style="height: 100vh;" method="post">
        		<p>Name: '.$p_line['user_name'].'</p>
        		<br>
        		<p>Date: <input type="date" value="'.$_SESSION['date'].'" readonly></p>
        		<br>
        		<p>Time: From:<input type="time" value="'.$t_min.'" readonly> To: <input type="time" value="'.$t_max.'" readonly></p>
        		<br>
        		<p>Offers: <textarea cols="35" rows="5" readonly>';
        		foreach($unique_offer as $item){
        			echo $item.' ';
        		}
        		echo'</textarea></p>
        		<br>
        		<p>Master(-s): <textarea cols="35" rows="5" readonly>';
        		foreach($unique_master as $mstrs){
        			echo $mstrs.' ';
        		}
        		echo'</textarea></p>
        		<br>
        		<p>Total prise: <input type="text" value="'.$total_prise.'" readonly></p>
        		<br>
        		<button class="register-btn-try" type="submit" name="total_complete" value="true">Complete order</button>
        		<button class="register-btn-try" type="submit" name="reset_order" value="true">Reset order</button>
        	</form>
	</div>';
?>