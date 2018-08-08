<?	
	if(!empty($_SESSION['time']) and !empty($_SESSION['date'])){
		$date_safer=$_SESSION['date'];
	}
	
	if(!empty($_POST['master']) and !empty($_POST['date']) and !empty($_POST['time']) and !empty($_POST['offers']) and $_POST['more']=='true')
	{
		if(!empty($_POST['end'])){
			unset($_POST['end']);}
		$line3=$db->select('SELECT time, date, master_name FROM Orders, Masters WHERE order_check="new" or order_check="in_work" and master_name="'.$_POST['master'].'"',true);
		$pr_line=$db->select('SELECT prise_offer FROM Offers WHERE name_offer="'.$_POST['offers'].'"',true);
		$ch=0;
		foreach($line3 as $value)
		{
			if($value['time']==$_POST['time'] and $value['date']==$_POST['date'] and $value['master_name']==$_POST['master'])
			{
				$ch++;
			}
		}
		if($ch==0){
				if(empty($_SESSION['master']) or $_SESSION['master']!=$_POST['master']){
					$_SESSION['master'].=$_POST['master'].', ';}
				if(empty($_SESSION['date'])){
					$_SESSION['date'].=$_POST['date'];}
				$_SESSION['time'].=$_POST['time'].', ';
				$_SESSION['offers'].=$_POST['offers'].', ';
				$_SESSION['prise'].=$pr_line['prise_offer'].', ';
				$msg='';
				echo '<meta http-equiv="Refresh" content="0; url=order.php" />';
			}
			if($ch>0){
				$msg='Запись на данную дату или время, или на диапазон в 1 час от введённого времени уже существует!';}

			
	}else{$msg='Заполните данные!';}	
	if(!empty($_POST['master']) and !empty($_POST['date']) and !empty($_POST['time']) and !empty($_POST['offers']) and $_POST['end']=='true'){
		if(!empty($_POST['more'])){
			unset($_POST['more']);}
		$line3=$db->select('SELECT time, date, master_name FROM Orders, Masters WHERE order_check="new" or order_check="in_work" and master_name="'.$_POST['master'].'"',true);
		$pr_line=$db->select('SELECT prise_offer FROM Offers WHERE name_offer="'.$_POST['offers'].'"',true);
		$ch=0;
		foreach($line3 as $value)
		{
			if($value['time']==$_POST['time'] and $value['date']==$_POST['date'] and $value['master_name']==$_POST['master'])
			{
				$ch++;
			}
		}
		if($ch==0){
				if(empty($_SESSION['master']) or $_SESSION['master']!=$_POST['master']){
					$_SESSION['master'].=$_POST['master'].', ';}
				if(empty($_SESSION['date'])){
					$_SESSION['date'].=$_POST['date'];}
				$_SESSION['time'].=$_POST['time'].', ';
				$_SESSION['offers'].=$_POST['offers'].', ';
				$_SESSION['prise'].=$pr_line['prise_offer'].', ';
				$msg='';
				echo '<meta http-equiv="Refresh" content="0; url=complete.php" />';
			}
			if($ch>0){
				$msg='Запись на данную дату или время, или на диапазон в 1 час от введённого времени уже существует!';}
	}else{$msg='Заполните данные!';}	
	if(empty($_POST) and empty($_GET['change_form']))
	{
		echo'<main>
				<section class="order">
					<div class="container">
						<form class="form-order" method="get" >
							<h3>Order form</h3>
							<label>
								<input type="radio" name="change_form" value="haircuts" >
								<span>Haircut</span>
							</label>
							<label>
								<input type="radio" name="change_form" value="manicure" >
								<span>Manicure</span>
							</label>
						   
							<p><button class="register-btn-try" formaction="http://Arkadia/php?change_form="'.$_POST['change_form'].'">Submit</button></p>
						</form>
					</div>
				</section>
			</main>';
	}
	else if($_GET['change_form']=='haircuts')
	{
		$line=$db->select('SELECT  master_name FROM Masters WHERE specialty="1"',true);
		$line2=$db->select('SELECT * FROM Offers WHERE specialty="1"',true);
		echo'<main>
				<section class="order">
					<div class="container">
						<form class="form-order form-order-changes" method="post" >
							<p>
								<select size="1" name="master" multiple-name="master" default="1">
									';
							foreach($line as $key=>$value)
							{
								echo '<option value="'.$value["master_name"].'">'.$value["master_name"].'</option>';
							}
							echo'
								</select>
							</p>
							<p><input name="date" type="date" value="'.$date_safer.'"></p>
							<p><input name="time" type="time"></p>
							<p>
								<select size="1" name="offers" multiple-name="offers">';
									foreach($line2 as $key=>$value)
									{
										echo'<option value="'.$value['name_offer'].'">'.$value['name_offer'].' - '.$value['prise_offer'].'</option>';
									}
									
								echo'</select>
							</p>
							<p><input type="reset" value="Reset"></p>
							<p><button class="order-btn-plus" type="submit" name="more" value="true">+</button>
							    <button class="order-btn-comp" type="submit" name="end" value="true">Complete</button>
							</p>
							<p>'.$msg.'</p>	
						</form>
					</div>
				</section>
			</main>';
	}
	else if($_GET['change_form']=='manicure')
	{
		$line=$db->select('SELECT  master_name FROM Masters WHERE specialty="2"',true);
		$line2=$db->select('SELECT * FROM Offers WHERE specialty="2"',true);
		echo'<main>
				<section class="order">
					<div class="container">
						<form class="form-order form-order-changes" method="post" >
							<p>
								<select size="1" name="master" multiple-name="master" default="1">
									';
							foreach($line as $key=>$value)
							{
								echo '<option value="'.$value["master_name"].'">'.$value["master_name"].'</option>';
							}
							echo'
								</select>
							</p>
							<p><input name="date" type="date" value="'.$date_safer.'"></p>
							<p><input name="time" type="time"></p>
							<p>
								<select size="1" name="offers" multiple-name="offers">';
									foreach($line2 as $key=>$value)
									{
										echo'<option value="'.$value['name_offer'].'">'.$value['name_offer'].' - '.$value['prise_offer'].'</option>';
									}
								echo'</select>
							</p>
							<p><input type="reset" value="Reset"></p>
							<p><button class="order-btn-plus" type="submit" name="more" value="true">+</button>
                            <button class="order-btn-comp" type="submit" name="end" value="true">Complete</button>
                            </p>
							<p>'.$msg.'</p>							
						</form>
					</div>
				</section>
			</main>';
	}
?>
