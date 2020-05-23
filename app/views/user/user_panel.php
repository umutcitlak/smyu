<section>
	<article>
		<div class="head"><?php echo $values['article_content'][0]['user_name']; ?></div>
		<div class="content">
            <div class="content-left">
                <div class="user-thumbnail"><img src="<?php echo $values['article_content'][0]['user_image']; ?>" width="100%"/></div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label id="label-file" for="input-file" onclick="document.getElementById('label-file').innerHTML='Resim Sec';">Resmi Degistir</label><input type="file" name="user_image" id="input-file" /><br><br>
                    <input type="submit" value="RESMI KAYDET"><br><br>
                </form>
                <div class="content-head">Seviye: <span style="font-weight: normal; color: #61605c">unknown</span></div>
                <div class="content-head">Odev: <span style="font-weight: normal; color: #61605c">2</span></div>
            </div>
            <div class="content-right">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="content-date">Baglanti: <span style="font-weight: normal">(ornek: https://www.instagram.com/gnusnotunix)</span></div>
                    <input type="url" name="user_url" value="<?php echo $values['article_content'][0]['user_url']; ?>" minlength="0" maxlength="70" pattern=".{0,70}" title="En az 0, en cok 70 karakterlik url" ><br><br>
                    <div class="content-date">Hakkimda:</div>
                    <textarea name="user_bio" minlength="0" maxlength="5000" pattern=".{0,5000}" title="En az 0, en cok 5000 karakterlik metin" ><?php echo $values['article_content'][0]['user_bio']; ?></textarea><br><br>
                    
                    <input type="submit" value="PROFILI GUNCELLE"><br><br>
                    
                </form>
            </div>
		</div>
	</article>
	<aside>
		<div class="head">Hizli Baglantilar</div>
        <div class="content">
            <div class="bar">
                <ul>
                    <li><a href="#">Odevlerim</a></li>
                    <li><a href="?url=notices">Tüm Duyurular</a></li>
                    <li><a href="?url=user&no=<?php echo $values['article_content'][0]['user_no']; ?>">Profilimi Goster</a></li>
                    <li><a href="?url=changepassword">Sifremi Degistir</a></li>
                    <li><a href="?url=logout">Cikis Yap</a></li>
                </ul>
            </div>
        </div>
	</aside>
</section>