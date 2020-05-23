<section>
	<article>
		<div class="head">Tum Icerikler <?php echo count($values["article_content"]); ?> Adet</div>
		<?php if(!empty($values["article_content"])) foreach($values["article_content"] as $contents ) {?>
		<div class="content">
			<div class="content-left">
				<div class="content-thumbnail"><img src="<?php echo $contents["image_href"]; ?>" width="100%" /></div>
			</div>
			<div class="content-right">
				<div class="content-date"><?php echo $contents["content_date"]; ?></div>
				<div class="content-head"><a href="?url=content&id=<?php echo $contents["content_id"]; ?>"><?php echo $contents["content_head"]; ?></a></div>
				<div class="content-body"><?php echo substr($contents["content_body"], '0', '220')." ..."; ?></div>
			</div>
			</div>
		<?php } ?>	
	</article>
	<aside>
		<div class="head">Rastgele 5 Icerik</div>
		<?php if(!empty($values["aside_content"])) foreach($values["aside_content"] as $contents ) { ?>	
		<div class="content">	
			<div class="content-head"><a href="?url=content&id=<?php echo $contents['content_id']; ?>"><?php echo $contents["content_head"]; ?></a></div>
			<div class="content-body"><?php echo substr($contents["content_body"] ,'0','50')." ..."; ?></div>
		</div>
		<?php }	?>
	</aside>
</section>