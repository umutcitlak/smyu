<section>
	<article>
        <div class="head">Sifremi Degistir</div>
        <div class="content">
            <form action="" method="POST">
                <br>
                <input type="password" name="user_password" placeholder="Mevcut Şifrenizi Giriniz" minlength="6" maxlength="10" pattern=".{6,10}" title="En az 6, en cok 10 karakterlik şifre" required><br>
                <input type="password" name="user_password_1" placeholder="Yeni Şifrenizi Belirleyiniz" minlength="6" maxlength="10" pattern=".{6,10}" title="En az 6, en cok 10 karakterlik şifre" required><br>
                <input type="password" name="user_password_2" placeholder="Yeni Şifrenizi Tekrarlayiniz" minlength="6" maxlength="10" pattern=".{6,10}" title="En az 6, en cok 10 karakterlik şifre" required><br><br>

                <input type="submit" value="ŞİFREMİ DEGİSTİR"><br><br>

                <?php $usr_no=$_SESSION['user_no']; echo ("<a href='?url=panel&no=$usr_no'>Vazgec</a>");?><br><br>

            </form>
        </div>
	</article>
</section>