<section>
	<article>
		<div class="head-alert">Latest information about COVID-19</div>
		<div class="content">
			<div class="slide" >
				<!-- Slideshow container -->
				<div class="slideshow-container">
					<div class="mySlides fade">
						<div class="numbertext">1 / 5</div>
						<img src="images/slides/slide-1.png" style="width:100%">
						<div class="text">Caption One</div>
					</div>
					<div class="mySlides fade">
						<div class="numbertext">2 / 5</div>
						<img src="images/slides/slide-2.png" style="width:100%">
						<div class="text">Caption Two</div>
					</div>
					<div class="mySlides fade">
						<div class="numbertext">3 / 5</div>
						<img src="images/slides/slide-3.png" style="width:100%">
						<div class="text">Caption Three</div>
					</div>
					<div class="mySlides fade">
						<div class="numbertext">4 / 5</div>
						<img src="images/slides/slide-4.png" style="width:100%">
						<div class="text">Caption Four</div>
					</div>
					<div class="mySlides fade">
						<div class="numbertext">5 / 5</div>
						<img src="images/slides/slide-5.png" style="width:100%">
						<div class="text">Caption Five</div>
					</div>
					<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
					<a class="next" onclick="plusSlides(1)">&#10095;</a>
				</div><br>
				<div style="text-align:center">
					<span class="dot" onclick="currentSlide(1)"></span> 
					<span class="dot" onclick="currentSlide(2)"></span> 
					<span class="dot" onclick="currentSlide(3)"></span>
					<span class="dot" onclick="currentSlide(4)"></span>
					<span class="dot" onclick="currentSlide(5)"></span>
				</div>
				<!-- -->
				<script type="text/javascript" src="js/slider.js"></script>
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
<section>
	<article>		
		<div class="head">Son 5 Duyuru</div>
		<?php if(!empty($values["article2_content"])) foreach($values["article2_content"] as $notices) {?>
		<div class="content">
			<div class="content-left">
				<div class="content-thumbnail"><img src="<?php echo $notices["notice_file_href"]; ?>" width="100%" /></div>
			</div>
			<div class="content-right">
				<div class="content-date"><?php echo $notices["notice_date"]; ?></div>
				<div class="content-head"><a href="?url=notice&id=<?php echo $notices["notice_id"]; ?>"><?php echo $notices["notice_head"]; ?></a></div>
				<div class="content-body"><?php echo substr($notices["notice_body"], '0', '220') . " ..."; ?></div>
			</div>	
		</div>
		<?php } ?>
	</article>
	<aside>
		<div class="head">Son 5 Etkinlik</div>
		<div class="content">
			<ul>
				<li>
					<div class="content-date">Wednesday, December 11, 2019</div>
					<div class="content-head"><a href="#">Undergraduate housing opens | Spring</a></div>
					<div class="content-body"><br></div>
				</li>
				<li>
					<div class="content-date">Friday, November 22, 2019</div>
					<div class="content-head"><a href="#">Grades - graduating students due</a></div>
					<div class="content-body"><br></div>
				</li>
				<li>
					<div class="content-date">Thursday, October 17, 2019</div>
					<div class="content-head"><a href="#">First day of quarter| instruction begins</a></div>
					<div class="content-body"><br></div>
				</li>
				<li>
					<div class="content-date">Thursday, October 10, 2019</div>
					<div class="content-head"><a href="#">Preliminary Study List deadline| Spring</a></div>
					<div class="content-body"><br></div>
				</li>
				<li>
					<div class="content-date">Monday, July 1, 2019</div>
					<div class="content-head"><a href="#">GSB instruction begins| Spring</a></div>
					<div class="content-body"><br></div>
				</li>
			</ul>
		</div>
	</aside>
</section>