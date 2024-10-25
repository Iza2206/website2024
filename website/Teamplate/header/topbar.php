<!-- Topbar -->
<div class="topbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-5 col-12">
                <?php
                    // Gunakan prepared statement untuk mencegah SQL injection
                    $stmt = $mysqli->prepare("SELECT * FROM dt_navinfo");
                    $stmt->execute();
                    $result = $stmt->get_result();
                            
                    while ($LoadQrylvluser = $result->fetch_assoc()) {
                    // Sanitasi output untuk mencegah XSS
                    $alamatNavinfo = htmlspecialchars($LoadQrylvluser['alamat_navinfo'], ENT_QUOTES, 'UTF-8');
                    $kodePosNavinfo = htmlspecialchars($LoadQrylvluser['kode_pos_navinfo'], ENT_QUOTES, 'UTF-8');
                    $emailNavinfo = htmlspecialchars($LoadQrylvluser['email_navinfo'], ENT_QUOTES, 'UTF-8');
                ?>
                <!-- Contact -->
                <ul class="top-contact">
                    <li><i class="fa-regular fa-hospital"></i><?=$alamatNavinfo;?></li>
                    <li><i class="fa-solid fa-envelope-open"></i><?=$kodePosNavinfo;?></li>
                    <li><i class="fa-solid fa-at"></i><a href="mailto:rsuddrs.hat@gmail.com" target="_blank"><?=$emailNavinfo;?></a></li>
                </ul>
                <!-- End Contact -->
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Topbar -->