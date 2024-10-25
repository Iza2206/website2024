<?php
// Cek apakah file ini benar-benar ada
$kd_news = isset($_GET['kd_news']) ? $_GET['kd_news'] : '';
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar
// Query untuk mengambil 1 video terbaru terkait kd_news
$sql_videos = "
    SELECT 
        v.nm_videonews
    FROM 
        dt_videonews v
    WHERE 
        v.kd_news = '$kd_news'
    ORDER BY 
        v.tgl_input DESC
    LIMIT 1
";
$result_videos = $mysqli->query($sql_videos);
$video = $result_videos->fetch_assoc(); // Mengambil 1 video terbaru

// Query untuk mengambil 3 foto terbaru terkait kd_news
$sql_photos = "
    SELECT 
        f.nm_fotonews
    FROM 
        dt_fotonews f
    WHERE 
        f.kd_news = '$kd_news'
    ORDER BY 
        f.tgl_input DESC
    LIMIT 3
";
$result_photos = $mysqli->query($sql_photos);
$photos = [];
while ($row = $result_photos->fetch_assoc()) {
    $photos[] = $row['nm_fotonews']; // Menyimpan foto dalam array
}
// Tampilkan video jika ada, jika tidak tampilkan gambar

// Cek apakah kd_news sudah diisi
if (!empty($kd_news)) {
    // Query untuk mengambil data berita dengan prepared statement
    $sql_news = "
        SELECT 
            n.kd_news, 
            n.judul_news, 
            n.isi_news, 
            n.tanggal_news
        FROM 
            dt_news n
        WHERE 
            n.kd_news = ?
    ";
    
    // Persiapkan statement
    if ($stmt = $mysqli->prepare($sql_news)) {
        // Bind parameter kd_news ke statement
        $stmt->bind_param('s', $kd_news);
        
        // Eksekusi statement
        $stmt->execute();
        
        // Ambil hasil query
        $result_news = $stmt->get_result();
        
        // Cek apakah ada data yang ditemukan
        if ($result_news->num_rows > 0) {
            // Ambil data berita
            $news_data = $result_news->fetch_assoc();
            $judul_news = $news_data['judul_news'];
            $isi_news = $news_data['isi_news'];
            
            // Hitung panjang teks isi_news dan bagi menjadi dua
            $isi_length = strlen($isi_news); // Hitung jumlah karakter
            $half_length = ceil($isi_length / 2); // Hitung setengah dari jumlah karakter, pembulatan ke atas

            // Cari posisi titik terakhir di bagian pertama teks
            $last_period_pos = strrpos(substr($isi_news, 0, $half_length), '.');

            // Jika ada titik, potong teks sampai titik terakhir, jika tidak, potong di setengah teks
            if ($last_period_pos !== false) {
                $isi_excerpt_1 = substr($isi_news, 0, $last_period_pos + 1); // Bagian pertama hingga titik terakhir
                $isi_excerpt_2 = substr($isi_news, $last_period_pos + 1); // Bagian kedua setelah titik
            } else {
                // Jika tidak ada titik, tetap potong di setengah
                $isi_excerpt_1 = substr($isi_news, 0, $half_length); // Bagian pertama
                $isi_excerpt_2 = substr($isi_news, $half_length); // Bagian kedua
            }
            
        } else {
            echo "Berita tidak ditemukan.";
        }
        
        // Tutup statement
        $stmt->close();
    } else {
        echo "Error dalam mempersiapkan statement.";
    }
} else {
    echo "Kode berita tidak valid.";
}

?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?php include './Teamplate/header/meta.php'; ?>
    <?php include './Teamplate/header/css.php'; ?>
</head>

<body>
    <?php include './Teamplate/header/loader.php'; ?>
    <!-- Header Area -->
    <header class="header">
        <?php include './Teamplate/header/topbar.php'; ?>
        <?php include './Teamplate/header/navbar.php'; ?>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Berita Detail</h2>
                        <ul class="bread-list">
                            <li>
                                <a href="/website/">Home</a>
                            </li>
                            <li>
                                <i class="icofont-simple-right"></i>
                            </li>
                            <li class="active">Berita Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
		<!-- Single News -->
		<section class="news-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="row">
							<div class="col-12">
								<div class="single-main">
									<!-- News Head -->
									<div class="news-head">
										<?php if ($video): ?>
											<video controls>
												<source src="../Admin/Gambar/Berita/video/<?php echo htmlspecialchars($video['nm_videonews']); ?>" type="video/mp4">
												Your browser does not support the video tag.
											</video>
										<?php elseif (!empty($photos)): ?>
											<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($photos[0]); ?>" alt="#">
										<?php else: ?>
											<img src="img/default.jpg" alt="#"> <!-- Gambar default jika tidak ada foto atau video -->
										<?php endif; ?>
									</div>
									<!-- News Title -->
									 <br>
									<h1 class="news-title"><a href="news-single.html"><?php echo htmlspecialchars($judul_news); ?></a></h1>
									<!-- News Text -->
									<div class="news-text">
										<p><?php echo $isi_excerpt_1; ?></p>
										
										<div class="image-gallery">
											<div class="row">
												<?php if ($video): ?>
													<!-- Jika ada video, tampilkan 2 foto lainnya -->
													<?php if (count($photos) >= 2): ?>
														<div class="col-lg-6 col-md-6 col-12">
															<div class="single-image">
																<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($photos[1]); ?>" alt="#">
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-12">
															<div class="single-image">
																<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($photos[2]); ?>" alt="#">
															</div>
														</div>
													<?php endif; ?>
													<?php else: ?>
														<!-- Jika tidak ada video, tampilkan foto jika ada lebih dari 1 -->
													<?php if (count($photos) > 1): ?>
														<div class="col-lg-6 col-md-6 col-12">
															<div class="single-image">
																<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($photos[1]); ?>" alt="#">
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-12">
															<div class="single-image">
																<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($photos[2]); ?>" alt="#">
															</div>
														</div>
													<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
										<p><?php echo $isi_excerpt_2; ?></p>
									</div>
								</div>
							</div>
							<?php
								$query = "SELECT name_commentnews, tgl_input, isi_commentnews FROM dt_commentnews WHERE kd_news = '$kd_news' ORDER BY tgl_input DESC";
								$result = $mysqli->query($query);
							?>

							<div class="col-12">
								<div class="blog-comments">
									<h2>Semua Komentar</h2>
									<div class="comments-body">
										<?php
										if ($result->num_rows > 0) {
											while ($row = $result->fetch_assoc()) {
												?>
												<!-- Single Comments -->
												<div class="single-comments">
													<div class="main">
														<div class="body">
															<h4><?php echo $row['name_commentnews']; ?></h4>
															<div class="comment-meta">
																<span class="meta"><i class="fa fa-calendar"></i><?php echo date('F d, Y', strtotime($row['tgl_input'])); ?></span>
																<span class="meta"><i class="fa fa-clock-o"></i><?php echo date('h:i A', strtotime($row['tgl_input'])); ?></span>
															</div>
															<p><?php echo $row['isi_commentnews']; ?></p>
															<!-- <a href="#"><i class="fa fa-reply"></i>replay</a> -->
														</div>
													</div>
												</div>
												<!--/ End Single Comments -->
												<?php
											}
										} else {
											echo "<p>Belum ada komentar.</p>";
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="comments-form">
									<h2>Tinggalkan komentar</h2>
									<!-- Contact Form -->
									<form class="form" method="post" action="konten/controllers/addcomentnews">
									<input type="hidden" name="kd_news" value="<?php echo htmlspecialchars($kd_news); ?>">
										<div class="row">
											<div class="col-lg-5 col-md-5 col-12">
												<div class="form-group">
													<i class="fa fa-user"></i>
													<input type="text" name="name_commentnews" placeholder="Nama" required="required">
												</div>
											</div>
											<div class="col-lg-7 col-md-7 col-12">
												<div class="form-group">
													<i class="fa fa-envelope"></i>
													<input type="email" name="email_commentnews" placeholder="Your Email" required="required">
												</div>
											</div>
											<div class="col-12">
												<div class="form-group message">
													<i class="fa fa-pencil"></i>
													<textarea name="isi_commentnews" rows="7" placeholder="Ketik Komentar Anda di Sini" ></textarea>
												</div>
											</div>
											<div class="col-12">
												<div class="form-group button">	
													<button type="submit" class="btn primary"><i class="fa fa-send"></i>Kirim Komentar</button>
												</div>
											</div>
										</div>
									</form>
									<!--/ End Contact Form -->
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="main-sidebar">
							<!-- Single Widget -->
							<div class="single-widget category">
								<h3 class="title">Kategori</h3>
								<ul class="categor-list">
									<?php
									// Eksekusi query
									$sql_categories = "
										SELECT 
											nm_kategorinews
										FROM 
											dt_kategorinews
										ORDER BY 
											id_kategorinews ASC
									";
									$result_categories = $mysqli->query($sql_categories);

									// Cek apakah ada hasil dari query
									if ($result_categories->num_rows > 0) {
										// Menampilkan kategori dari hasil query
										while ($row = $result_categories->fetch_assoc()) {
											echo '<li><a href="#">' . htmlspecialchars($row['nm_kategorinews']) . '</a></li>';
										}
									} else {
										echo '<li>No categories available</li>';
									}
									?>
								</ul>
							</div>

							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget recent-post">
								<h3 class="title">Recent post</h3>

								<?php
								// Query untuk mengambil data berita terbaru beserta jumlah komentar
								$sql_news = "
									SELECT n.kd_news, n.judul_news, n.tanggal_news, 
										MAX(f.nm_fotonews) AS nm_fotonews,
										COUNT(c.kd_commentnews) AS jml_komentar,
										k.nm_kategorinews
									FROM dt_news n
									JOIN dt_fotonews f ON n.kd_news = f.kd_news
									JOIN dt_kategorinews k ON n.kd_kategorinews = k.kd_kategorinews
									LEFT JOIN dt_commentnews c ON n.kd_news = c.kd_news
									GROUP BY n.kd_news, n.judul_news, n.tanggal_news, k.nm_kategorinews
									ORDER BY n.tanggal_news DESC
									LIMIT 5
								";

								$result_news = $mysqli->query($sql_news);

								if ($result_news->num_rows > 0) {
									// Loop untuk menampilkan setiap berita
									while ($row_news = $result_news->fetch_assoc()) {
										$judul_news = $row_news['judul_news'];
										$tanggal_news = date('M d, Y', strtotime($row_news['tanggal_news']));
										$kd_news = $row_news['kd_news'];
										$url_news = "news-detail.php?kd_news=" . $kd_news; // Link menuju detail berita
										$jml_komentar = $row_news['jml_komentar'];
								?>

								<!-- Single Post -->
								<div class="single-post">
									<div class="image">
										<!-- Menampilkan gambar dari folder yang sesuai -->
										<img src="../Admin/Gambar/Berita/<?php echo htmlspecialchars($row_news['nm_fotonews']); ?>" alt="<?php echo htmlspecialchars($judul_news); ?>">
									</div>
									<div class="content">
										<h5><a href="<?php echo $url_news; ?>"><?php echo $judul_news; ?></a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $tanggal_news; ?></li>
											<li><i class="fa fa-commenting-o" aria-hidden="true"></i><?php echo $jml_komentar; ?></li>
										</ul>
									</div>
								</div>
								<!-- End Single Post -->

								<?php
									}
								} else {
									echo "<p>No recent posts available.</p>";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Single News -->
    <!-- End Doctor Details -->

    <!-- Footer Area -->
    <footer id="footer" class="footer ">
        <?php include './Teamplate/footer/footer.php'; ?>
    </footer>
    <!--/ End Footer Area -->

    <?php include './Teamplate/header/js.php'; ?>

	<script>
    // Menangani pengiriman form untuk tambah dan edit data
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah pengiriman form default

            var formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success');
                        // Refresh halaman setelah data berhasil disimpan
                        setTimeout(() => {
                            location.reload(); // Segarkan halaman
                        }, 2000); // Tunggu 2 detik sebelum refresh
                    } else {
                        toastr.error(data.message, 'Error');
                    }
                })
                .catch(error => {
                    toastr.error('Terjadi kesalahan: ' + error.message, 'Error');
                });
        });
    });
</script>
</body>

</html>
