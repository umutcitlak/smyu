<section>
	<article>
		<div class="head"><?php echo $values['article_content'][0]['user_name']; ?></div>
		<div class="content">
			<div class="content-left">
				<div class="user-thumbnail"><img src="<?php echo $values['article_content'][0]['user_image']; ?>" width="100%" /></div>
			</div>
			<div class="content-right">
				<div class="content-date"><?php echo "HAKKIMDA"; ?></div>
				<div class="content-head"><a href="<?php echo $values['article_content'][0]['user_url']; ?>" target="_blank"><?php echo $values['article_content'][0]['user_url']; ?></a></div><br>
				<div class="content-body"><?php echo $values['article_content'][0]['user_bio']; ?></div>
			</div>
		</div>
	</article>
	<aside>
		<div class="head">Hizli Baglantilar</div>
		<div class="content">
			<div class="bar">
				<ul>
					<li><a href="https://obs.cumhuriyet.edu.tr/">OBS Ogrenci Bilgi Sistemi</a></li>
					<li><a href="http:./sqlmanager/">SQL Manager</a></li>
					<li><a href="http:./webexamsys/">WEB Exams</a></li>
					<li><a href="http:./phpweb/">PHP Server</a></li>
					<li><a href="ftp:./">FTP Server</a></li>
					<li><a href="http://www.cumhuriyet.edu.tr/haber/">Haberler</a></li>
					<li><a href="http://www.cumhuriyet.edu.tr/etkinlik/">Etkinlikler</a></li>
					<li><a href="http://www.cumhuriyet.edu.tr/duyuru/">Duyurular</a></li>
					<!--Cu-Radio <li><audio controls="" autoplay="autoplay"><source src="http://95.173.162.186:9804/;stream.mp3" type="audio/mp3">Tarayıcınız Desteklemiyor</audio></li> Cu-Radio-->
				</ul>
			</div>
		</div>
	</aside>
</section>