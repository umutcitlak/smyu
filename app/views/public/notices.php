<section>
	<article>
		<div class="head">Tum Duyurular <?php echo count($values["article_content"]); ?> Adet</div>
		<?php if(!empty($values["article_content"])) foreach($values["article_content"] as $notices ) {?>
		<div class="content">
			<div class="content-left">
				<div class="content-thumbnail"><img src="<?php echo $notices["notice_file_href"]; ?>" width="100%" /></div>
			</div>
			<div class="content-right">
				<div class="content-date"><?php echo $notices["notice_date"]; ?></div>
				<div class="content-head"><a href="?url=notice&id=<?php echo $notices["notice_id"]; ?>"><?php echo $notices["notice_head"]; ?></a></div>
				<div class="content-body"><?php echo substr($notices["notice_body"], '0', '220')." ..."; ?></div>
			</div>
			</div>
		<?php } ?>	
	</article>
	<aside>
		<div class="head">Rastgele 5 Duyuru</div>
		<?php if(!empty($values["aside_content"])) foreach($values["aside_content"] as $notices ) { ?>	
		<div class="content">	
			<div class="content-head"><a href="?url=notice&id=<?php echo $notices['notice_id']; ?>"><?php echo $notices["notice_head"]; ?></a></div>
			<div class="content-body"><?php echo substr($notices["notice_body"] ,'0','50')." ..."; ?></div>
		</div>
		<?php }	?>
	</aside>
</section>