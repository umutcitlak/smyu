<nav>
	<div class="menu">
		<ul><?php
			function public_menu($li_id = 0){
				global $conn;
				$query = mysqli_query($conn, "SELECT * FROM smyu_menu WHERE li_parent_id = $li_id") or die(mysqli_error($conn));
				if (mysqli_affected_rows($conn)){
					while ($row = mysqli_fetch_assoc($query)){ ?>
					<li><a href="<?php echo $row["li_href"]; ?>" title="<?php echo $row["li_title"]; ?>"><?php echo $row["li_name"]; ?></a>
						<ul><li><?php public_menu($row["li_id"]); ?></ul></li><?php
					}
				} else return false;
			} public_menu(); ?>			
		</ul>
		<ul style="float: right">
			<li></li>
		</ul>
	</div>
</nav>
