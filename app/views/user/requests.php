<section>
	<article>
		<div class="head">Tum Ödevler <?php echo count($values["article_content"]); ?> Adet</div>
		<?php if(!empty($values["article_content"])) foreach($values["article_content"] as $requests ) {?>
		<div class="content">
			<div class="content-left">
				<div class="content-thumbnail"><img src="<?php echo $requests["request_file_href"]; ?>" width="100%" /></div>
			</div>
			<div class="content-right">
				<div class="content-date">Veriliş Tarihi: <?php echo $requests["request_begin_date"]; ?> | Teslim Tarihi: <?php echo $requests["request_end_date"]; ?></div> 
				<div class="content-head"><a href="?url=request&id=<?php echo $requests["request_id"]; ?>"><?php echo $requests["request_head"]; ?></a></div>
				<div class="content-body"><?php echo substr($requests["request_body"], '0', '220')." ..."; ?></div>
			</div>
			</div>
		<?php } ?>	
	</article>
	<aside>
		<div class="head">Rastgele 5 Ödev</div>
		<?php if(!empty($values["aside_content"])) foreach($values["aside_content"] as $requests ) { ?>	
		<div class="content">	
			<div class="content-head"><a href="?url=request&id=<?php echo $requests['request_id']; ?>"><?php echo $requests["request_head"]; ?></a></div>
			<div class="content-body"><?php echo substr($requests["request_body"] ,'0','50')." ..."; ?></div>
		</div>
		<?php }	?>
	</aside>
</section>