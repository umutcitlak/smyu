<header>
	<div class="hdr-top">
		<div class="hdr-top-logo"><a href="./"><img src="images/hdr-logo.png"/></a></div>
		<div class="hdr-top-login">
		<?php
		if(isset($_SESSION['user_role'])&&$_SESSION['user_role']!="guest"){
			$usr_no=$_SESSION['user_no'];
			$usr_name=$_SESSION['user_name'];
			$usr_role=$_SESSION['user_role'];
			if($usr_role=="user"){
				echo ("<a href='?url=panel&no=$usr_no'>$usr_name</a> • <a href='?url=logout'>cikis</a>");
			} else if($usr_role=="advisor"){
				echo ("<a href='?url=advisor&no=$usr_no'>$usr_name</a> • <a href='?url=logout'>cikis</a>");
			} else if($usr_role=="admin"){
				echo ("<a href='?url=admin&no=$usr_no'>$usr_name</a> • <a href='?url=logout'>cikis</a>");
			} else echo ("<a href='?url=login'>giris</a>");
		} else echo ("<a href='?url=login'>giris</a>");
		?>
		</div>
	</div>
	<div class="hdr-bottom">
		<div class="hdr-bottom-logo"><a href="./"><img src="images/logo.png"/></a></div>
		<div class="hdr-bottom-text">BILGISAYAR TEKNOLOJILERI</div>
		<div class="hdr-bottom-search"><input type="search" id="" name="" value="" placeholder="Elastik Arama..." /></div>
	</div>
</header>
