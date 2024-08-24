<?php
if (!empty($_POST['name']) && !empty($_POST['comment'])) {
    $name = $_POST['name'];
    $alamat = $_POST['alamat'];
    $comment = $_POST['comment'];

    date_default_timezone_set('Asia/Jakarta'); // Waktu Cirebon
    $currentTime = time();

    $text = stripslashes(htmlspecialchars($comment));
    $initial = strtoupper($name[0]);

    // Format pesan baru dengan waktu posting
    $content = "
    <div class='wish'>
        <div class='wish-badge'>$initial</div>
        <div class='wish-description'>
            <b>Nama</b>: $name<br>
            <b>Alamat</b>: $alamat<br>
            <b>Pesan</b>: $text
            <div class='timestamp' style='font-size: 0.8em; margin-top: 5px;'>baru saja</div>
            <div class='timestamp-hidden' data-time='$currentTime'></div>
        </div>
    </div>";

    // Membaca konten yang ada di base.html
    $existingContent = '';
    if (file_exists('base.html')) {
        $existingContent = file_get_contents('base.html');
    }

    // Menyimpan pesan baru di bagian paling atas
    $newContent = $content . $existingContent;

    $fp = fopen("base.html", 'w');
    fwrite($fp, $newContent);
    fclose($fp);

    echo $content;
}
?>