<?php
// Include file koneksi
require_once('./libraries/config/dbcon.php');

// Ambil kd_news dari URL, misalnya lewat GET method
$kd_news = isset($_GET['kd_news']) ? $_GET['kd_news'] : '';

// Query untuk mengambil data berita
$sql_news = "
    SELECT 
        n.kd_news, 
        n.judul_news, 
        n.isi_news, 
        n.tanggal_news
    FROM 
        dt_news n
    WHERE 
        n.kd_news = '$kd_news'
";
$result_news = $mysqli->query($sql_news);
$news_data = $result_news->fetch_assoc(); // Mengambil satu record berita

// Query untuk mengambil data video terkait (jika ada)
$sql_videos = "
    SELECT 
        v.nm_videonews
    FROM 
        dt_videonews v
    WHERE 
        v.kd_news = '$kd_news'
";
$result_videos = $mysqli->query($sql_videos);
$videos = [];
while ($row = $result_videos->fetch_assoc()) {
    $videos[] = $row['nm_videonews']; // Menyimpan semua video yang terkait dalam array
}

// Query untuk mengambil data foto terkait (jika ada)
$sql_photos = "
    SELECT 
        f.nm_fotonews
    FROM 
        dt_fotonews f
    WHERE 
        f.kd_news = '$kd_news'
";
$result_photos = $mysqli->query($sql_photos);
$photos = [];
while ($row = $result_photos->fetch_assoc()) {
    $photos[] = $row['nm_fotonews']; // Menyimpan semua foto yang terkait dalam array
}

// Query untuk mengambil komentar terkait (jika ada)
$sql_comments = "
    SELECT 
        c.name_commentnews, 
        c.email_commentnews, 
        c.isi_commentnews
    FROM 
        dt_commentnews c
    WHERE 
        c.kd_news = '$kd_news'
";
$result_comments = $mysqli->query($sql_comments);
$comments = [];
while ($row = $result_comments->fetch_assoc()) {
    $comments[] = $row; // Menyimpan semua komentar yang terkait dalam array
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .news-item {
            margin-bottom: 20px;
        }
        .news-content {
            margin-bottom: 10px;
        }
        .comments {
            margin-top: 30px;
        }
        .video-news, .photo-news {
            margin-bottom: 20px;
        }
        video {
            max-width: 100%;
            height: auto;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($news_data) : ?>
            <div class="news-item">
                <h1><?= $news_data['judul_news']; ?></h1>
                <p><strong>Tanggal:</strong> <?= $news_data['tanggal_news']; ?></p>
                <div class="news-content">
                    <?= $news_data['isi_news']; ?>
                </div>

                <!-- Tampilkan Video (Jika Ada) -->
                <?php if (!empty($videos)) : ?>
                    <div class="video-news">
                        <h3>Video Terkait</h3>
                        <?php foreach ($videos as $video) : ?>
                            <video controls>
                                <source src="path_to_videos/<?= $video; ?>" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Tampilkan Foto (Jika Ada) -->
                <?php if (!empty($photos)) : ?>
                    <div class="photo-news">
                        <h3>Foto Terkait</h3>
                        <?php foreach ($photos as $photo) : ?>
                            <img src="path_to_images/<?= $photo; ?>" alt="Foto Berita">
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tampilkan Komentar (Jika Ada) -->
            <div class="comments">
                <?php if (!empty($comments)) : ?>
                    <h3>Komentar</h3>
                    <?php foreach ($comments as $comment) : ?>
                        <p><strong><?= $comment['name_commentnews']; ?>:</strong> <?= $comment['isi_commentnews']; ?></p>
                        <p>Email: <?= $comment['email_commentnews']; ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada komentar.</p>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <p>Tidak ada berita ditemukan.</p>
        <?php endif; ?>

        <?php $mysqli->close(); ?>
    </div>
</body>
</html>
