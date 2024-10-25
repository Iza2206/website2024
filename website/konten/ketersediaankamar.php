<?php
 // Cek apakah file ini benar-benar ada
require_once('./libraries/config/dbcon.php'); // Pastikan path ini benar

// Mendapatkan rute dari URL
// $route = isset($_GET['route']) ? $_GET['route'] : '/';

// // Menangani rute
// handleRoute($route);
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
							<h2>Ketersediaan Kamar</h2>
							<ul class="bread-list">
								<li><a href="/website/">Home</a></li>
								<li><i class="icofont-simple-right"></i></li>
								<li class="active">Ketersediaan Kamar</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		
        <!-- Start service -->
        <section class="services p-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Ketersediaan Kamar di <br> RSUD Drs H Amri Tambunan</h2>
                        <img src="assets/img/section-img.png" alt="#">
                        <p>RSUD Drs H Amri Tambunan menyediakan berbagai pilihan kamar untuk kebutuhan rawat inap Anda. Pastikan kesehatan Anda terjaga dengan fasilitas terbaik dari kami.</p>
                    </div>
                </div>
            </div>
            <?php
                // Ambil data dari API
                $apiUrl = 'http://192.168.40.25/website/konten/controllers/APIgetKamar.php';
                $response = file_get_contents($apiUrl);

                // Periksa jika respons valid
                if ($response !== false) {
                    $data = json_decode($response, true);

                    // Periksa jika data berhasil di-decode
                    if (json_last_error() === JSON_ERROR_NONE) {
                        // Akses array di dalam kunci 'result'
                        if (isset($data['result']) && is_array($data['result'])) {
                            ?>
                            <div class="row">
                                <?php foreach ($data['result'] as $item): ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <!-- Start Single Service -->
                                        <div class="single-service" id="kamar-info-<?php echo htmlspecialchars($item['kodekelas']); ?>" data-kodekelas="<?php echo htmlspecialchars($item['kodekelas']); ?>">
                                            <div class="service-header">
                                                <h4>
                                                    <?php if ($item['kodekelas'] === 'ICU'): ?>
                                                    <div class="kamar-item">
                                                        <span>ICU</span>
                                                    </div>
                                                    <?php elseif ($item['kodekelas'] === 'VIP'): ?>
                                                    <div class="kamar-item">
                                                        <span>VIP</span>
                                                    </div>
                                                    <?php elseif ($item['kodekelas'] === 'KL1'): ?>
                                                    <div class="kamar-item">
                                                        <span>KELAS 1</span>
                                                    </div>
                                                    <?php elseif ($item['kodekelas'] === 'KL2'): ?>
                                                    <div class="kamar-item">
                                                        <span>KELAS 2</span>
                                                    </div>
                                                    <?php elseif ($item['kodekelas'] === 'KL3'): ?>
                                                    <div class="kamar-item">
                                                        <span>KELAS 3</span>
                                                    </div>
                                                    <?php endif; ?>
                                                    <a><?php echo htmlspecialchars($item['namaruang']); ?></a>   
                                                </h4>
                                            </div>
                                            <div class="kamar-wrapper">
                                                <div class="kamar-detail">
                                                    <div class="kamar-item">
                                                        <span>Jumlah Kamar</span>
                                                        <span><?php echo htmlspecialchars($item['kapasitas']); ?></span>
                                                    </div>
                                                    <div class="kamar-item">
                                                        <span>Tempat Tidur Tersedia</span>
                                                        <span><?php echo htmlspecialchars($item['tersedia']); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Service -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php
                        } else {
                            echo 'Data result tidak ditemukan dalam respons.';
                        }
                    } else {
                        echo 'Error decoding JSON data.';
                    }
                } else {
                    echo 'Error fetching data from API.';
                }
            ?>
        </div>
    </section>

        <!--/ End service -->

		
		<!-- Footer Area -->
		<footer id="footer" class="footer ">
			<!-- Footer Top -->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>About Us</h2>
								<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut labore dolore magna.</p>
								<!-- Social -->
								<ul class="social">
									<li><a href="#"><i class="icofont-facebook"></i></a></li>
									<li><a href="#"><i class="icofont-google-plus"></i></a></li>
									<li><a href="#"><i class="icofont-twitter"></i></a></li>
									<li><a href="#"><i class="icofont-vimeo"></i></a></li>
									<li><a href="#"><i class="icofont-pinterest"></i></a></li>
								</ul>
								<!-- End Social -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer f-link">
								<h2>Quick Links</h2>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>	
										</ul>
									</div>
									<div class="col-lg-6 col-md-6 col-12">
										<ul>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Testimonials</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
											<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>	
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Open Hours</h2>
								<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
								<ul class="time-sidual">
									<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
									<li class="day">Saturday <span>9.00-18.30</span></li>
									<li class="day">Monday - Thusday <span>9.00-15.00</span></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-12">
							<div class="single-footer">
								<h2>Newsletter</h2>
								<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
								<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
									<input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Your email address'" required="" type="email">
									<button class="button"><i class="icofont icofont-paper-plane"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Footer Top -->
			<!-- Copyright -->
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-12">
							<div class="copyright-content">
								<p>© Copyright 2018  |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Copyright -->
		</footer>
		<!--/ End Footer Area -->
		
		<!-- jquery Min JS -->
        <script src="assets/js/jquery.min.js"></script>
		<!-- jquery Migrate JS -->
		<script src="assets/js/jquery-migrate-3.0.0.js"></script>
		<!-- jquery Ui JS -->
		<script src="assets/js/jquery-ui.min.js"></script>
		<!-- Easing JS -->
        <script src="assets/js/easing.js"></script>
		<!-- Color JS -->
		<script src="assets/js/colors.js"></script>
		<!-- Popper JS -->
		<script src="assets/js/popper.min.js"></script>
		<!-- Bootstrap Datepicker JS -->
		<script src="assets/js/bootstrap-datepicker.js"></script>
		<!-- Jquery Nav JS -->
        <script src="assets/js/jquery.nav.js"></script>
		<!-- Slicknav JS -->
		<script src="assets/js/slicknav.min.js"></script>
		<!-- ScrollUp JS -->
        <script src="assets/js/jquery.scrollUp.min.js"></script>
		<!-- Niceselect JS -->
		<script src="assets/js/niceselect.js"></script>
		<!-- Tilt Jquery JS -->
		<script src="assets/js/tilt.jquery.min.js"></script>
		<!-- Owl Carousel JS -->
        <script src="assets/js/owl-carousel.js"></script>
		<!-- counterup JS -->
		<script src="assets/js/jquery.counterup.min.js"></script>
		<!-- Steller JS -->
		<script src="assets/js/steller.js"></script>
		<!-- Wow JS -->
		<script src="assets/js/wow.min.js"></script>
		<!-- Magnific Popup JS -->
		<script src="assets/js/jquery.magnific-popup.min.js"></script>
		<!-- Counter Up CDN JS -->
		<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- Main JS -->
		<script src="assets/js/main.js"></script>
        
    </body>
</html>
