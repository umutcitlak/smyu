<section>
	<article>
        <div class="head">Yeni Ödev Ekle</div>
        <div class="content">
            <form action="" method="POST">
                <input type="text" id="" name="request_head" value="" placeholder="Başlık..." maxlength="70" required><br>
                <textarea id="" name="request_body" rows="20" placeholder="Gövde..." required></textarea><br>
                <label for="lessons">Ders Seçimi: </label>
                <select id="lessons" name="request_li_id_fk">
                <?php foreach($values['article_content'] as $lesson){  ?>
                <option value="<?php echo $lesson['li_id'];?>"><?php echo $lesson['li_name'];?></option>
                <?php } ?>
                </select>
                <label for="">Teslim Tarihi: </label>
                <input type="date" name="request_end_date" size="15" value="<?php echo date('Y-m-d'); ?>"> 
                <input type="checkbox" name="request_status" value="published">
                <label for="request_status">Ödevi Yayınla</label>
                <input type="submit" value="KAYDET" />
            </form>
        </div>
	</article>
</section>