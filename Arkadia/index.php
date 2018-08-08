<?
	include('utils/includes.php');
	$arr=$_SERVER['REQUEST_URI'];
	$step1=explode('/', $arr);
	$step2=explode('.', $step1[1]);
	session_start();
	include ('top.php');	
	if($step1[1]=='' or $step2[0]=='home' or $step2[0]=='index'){
		include('pages/home.php');}
	
	else if($step2[0]=='contact'){
		include('pages/contact.html');}
	
	else if($step2[0]=='order'){
		user_check();
		include('pages/order.php');
	}
	else if($step2[0]=='login'){
		include('pages/login.php');}
	
	else if($step2[0]=='profile'){
		include('pages/profile.php');}
	
	else if($_GET['name']=='register'){
		include('pages/register.php');}
	
	else if($_GET['change_form']=='haircuts'){
		include('pages/order.php');}
		
	else if($_GET['change_form']=='manicure'){
		include('pages/order.php');}
		
	else if($step2[0]=='complete'){
		include('pages/complete.php');}
		
	else if($step2[0]=='admin'){
		include('pages/admin.php');
	}
	else if($step2[0]=='admin_list'){
		include('pages/admin_list.php');
	}	
	include('footer.html');	
?>