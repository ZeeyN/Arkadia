<?
	$link=sql_connect($db_host_name, $db_user, $bd_pass, $db_name);
	$query = 'SELECT text_page FROM Pages WHERE alias="home"';
	$result = mysqli_query($link,$query) or die('Запрос не удался: ' . mysqli_error($link));
	$line=mysqli_fetch_array($result, MYSQL_ASSOC);
	$p_text = $line['text_page'];
?>

<!----------------BANNER----------------->
<div class="banner-bg">
	<div class="banner">
		<div class="container">
			<div class="banner-text">
				<p><?=$p_text?></p>
			</div>
		</div>
	</div>
</div>
<!----------------BANNER-END----------------->
<!----------------GALLERY----------------->
	<div class="gallery">
		<h2>Gallery</h2>
		<h3>male haircuts</h3>
		<div class="haircut">
			<img src="img/male/m1.jpg" alt="male hair">
			<img src="img/male/m2.jpg" alt="male hair">
			<img src="img/male/m3.jpg" alt="male hair">
			<img src="img/male/m4.jpg" alt="male hair">
			<img src="img/male/m5.jpg" alt="male hair">
			<img src="img/male/m6.jpg" alt="male hair">
		</div>
		<h3>female haircuts</h3>
		<div class="haircut">
			<img src="img/female/1.jpg" alt="male hair">
			<img src="img/female/2.jpg" alt="male hair">
			<img src="img/female/3.jpg" alt="male hair">
			<img src="img/female/4.jpg" alt="male hair">
			<img src="img/female/5.jpg" alt="male hair">
			<img src="img/female/6.jpg" alt="male hair">
		</div>
	</div>
<!----------------GALLERY-END----------------->