<?
	$lop = empty($_SESSION['user_id'])?'<li><a href="login.tml">Login</a></li>':'<li><a href="profile.tml">Profile</a></li>';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/styles.css">
	<title>Arkadia</title>

	<style>
	    .register-btn {
	        margin-top: 15px;
	        font-size: 2rem;
            background: #a30311;
            color: #fcf614;
            border: none;
            cursor: pointer;
	    }

	    .form-product {
	        position: relative;
	        padding-top: 200px;
	        font-size: 2rem;
            background: #909090;
            color: #fcf614;
            height: 100vh;
	    }

	    .form-order-changes p:nth-child(1){
	        margin-top: 0;
	    }

	    .form-order-changes {
        	padding-top: 200px;
        }
	</style>
	
</head>
<body>

	<!----------------HEADER------------------>

	<header class="head">
		<div class="container">
			<div class="head-flex">
				<div class="logo">
					<span>ARKADIA</span>
				</div>
				<nav class="navigation">
					<ul>
						<li><a href="home.tml">Home</a></li>
						<li><a href="contact.tml">Contact</a></li>
						<li><a href="order.tml">Order</a></li>
						<?=$lop?>
						
					</ul>
				</nav>
			</div>
		</div>
	</header>

	<!----------------HEADER-END----------------->
	
