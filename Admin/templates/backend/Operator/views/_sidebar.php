<!-- Start sidebar-wrapper -->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="dashboard">
            <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Admin RSUD Hat</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a class="nav-link <?= (empty($_GET['page'])) ? "active" : '' ?>" aria-current="page" href="dashboard">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-header">MASTER DATA</li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#master-data-menu">
                <i class="fas fa-database"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Master Data</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['Hari', 'JenisKelamin'])) ? 'show' : '' ?>" id="master-data-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Hari') ? 'active' : '' ?>" href="?page=Hari">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Hari</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'JenisKelamin') ? 'active' : '' ?>" href="?page=JenisKelamin">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Jenis Kelamin</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link  <?= (isset($_GET['page']) && $_GET['page'] == 'navbar1') ? "active" : '' ?>"
                aria-current="page"
                href="?page=navbar1">
                <i class="fas fa-plus-square"></i> <span>Navbar 1</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-menu-1">
                <i class="fas fa-plus-square"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Navbar 2</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && $_GET['page'] == 'MasterNavbar2') ? 'show' : '' ?>" id="sidebar-menu-1">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'MasterNavbar2') ? 'active' : '' ?>" href="?page=MasterNavbar2">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Navbar 2</span>
                    </a>
                </li>
            </ul>
        </li>
        <!--  Tentang Kami -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tentang-menu">
                <i class="fas fa-history"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Tentang Kami</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['Profil_Rumah_Sakit', 'TimKami', 'Sejarah'])) ? 'show' : '' ?>" id="tentang-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Profil_Rumah_Sakit') ? 'active' : '' ?>" href="?page=Profil_Rumah_Sakit">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Profil Rumah Sakit</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'TimKami') ? 'active' : '' ?>" href="?page=TimKami">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Tim Kami</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Sejarah') ? 'active' : '' ?>" href="?page=Sejarah">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Sejarah</span>
                    </a>
                </li> -->
            </ul>
        </li>

        <!-- Other sidebar items -->
        <li>
            <a class="nav-link  <?= (isset($_GET['page']) && $_GET['page'] == 'Crousel') ? "active" : '' ?>"
                aria-current="page"
                href="?page=Crousel">
                <i class="fas fa-images"></i> <span>Carousel</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#jam-berkunjung-menu">
                <i class="fas fa-user-clock"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Jam Berkunjung</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['JamBerkunjung', 'SyaratJamBerkunjung', 'Ruangan_Khusus', 'Jadwal'])) ? 'show' : '' ?>" id="jam-berkunjung-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'JamBerkunjung') ? 'active' : '' ?>" href="?page=JamBerkunjung">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Jam Berkunjung</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'SyaratJamBerkunjung') ? 'active' : '' ?>" href="?page=SyaratJamBerkunjung">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Syarat Jam Berkunjung</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Ruangan_Khusus') ? 'active' : '' ?>" href="?page=Ruangan_Khusus">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Ruangan Khusus</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Jadwal') ? 'active' : '' ?>" href="?page=Jadwal">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Jadwal Besuk</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#jadwal-pendaftaran-menu">
                <i class="fas fa-hospital-user"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Jam Pendaftaran Pasien</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['MasterKlinik', 'MasterJadwalPP', 'JadwalPP'])) ? 'show' : '' ?>" id="jadwal-pendaftaran-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'MasterKlinik') ? 'active' : '' ?>" href="?page=MasterKlinik">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Klinik</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'MasterJadwalPP') ? 'active' : '' ?>" href="?page=MasterJadwalPP">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Jadwal</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'JadwalPP') ? 'active' : '' ?>" href="?page=JadwalPP">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Jadwal Pendaftaran Pasien</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a class="nav-link  <?= (isset($_GET['page']) && $_GET['page'] == 'Excellent_Service') ? "active" : '' ?>"
                aria-current="page"
                href="?page=Excellent_Service">
                <i class="fas fa-award"></i> <span>Layanan Unggulan</span>
            </a>
        </li>
        <li>
            <a class="nav-link  <?= (isset($_GET['page']) && $_GET['page'] == 'Exemplary_Employee') ? "active" : '' ?>"
                aria-current="page"
                href="?page=Exemplary_Employee">
                <i class="fas fa-trophy"></i> <span>Pegawai Teladan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#dokter-menu">
                <i class="fas fa-user-md"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Dokter Kami</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['MasterDokter', 'SpesialisasiDokter', 'MasterPendidikanDokter', 'klinik'])) ? 'show' : '' ?>" id="dokter-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'MasterDokter') ? 'active' : '' ?>" href="?page=MasterDokter">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Dokter</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'SpesialisasiDokter') ? 'active' : '' ?>" href="?page=SpesialisasiDokter">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">spesialisasi kedokteran</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'MasterPendidikanDokter') ? 'active' : '' ?>" href="?page=MasterPendidikanDokter">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Pendidikan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'klinik') ? 'active' : '' ?>" href="?page=klinik">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>Master Poli Klinik</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Tarif Pelayanan -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tarif-menu">
                <i class="fas fa-money-bill-wave"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Tarif Pelayanan</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['Tarif', 'Tarif_Master_Rawat_Inap', 'Tarif_Rawat_Inap', 'Tarif_Rawat_Jalan'])) ? 'show' : '' ?>" id="tarif-menu">
                <!-- <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Tarif') ? 'active' : '' ?>" href="?page=Tarif">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Tarif Perda</span>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Tarif_Master_Rawat_Inap') ? 'active' : '' ?>" href="?page=Tarif_Master_Rawat_Inap">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Master Ruangan Rawat Inap</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Tarif_Rawat_Inap') ? 'active' : '' ?>" href="?page=Tarif_Rawat_Inap">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Tarif Rawat Inap</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'Tarif_Rawat_Jalan') ? 'active' : '' ?>" href="?page=Tarif_Rawat_Jalan">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Tarif Rawat Jalan</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Berita -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#berita-menu">
                <i class="fas fa-newspaper"></i>
                <i class="fas fa-caret-down float-right"></i>
                <span>Berita</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['BeritaTerbaru', 'KategoriBerita', 'ArsipBerita'])) ? 'show' : '' ?>" id="berita-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'BeritaTerbaru') ? 'active' : '' ?>" href="?page=BeritaTerbaru">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Berita Terbaru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'KategoriBerita') ? 'active' : '' ?>" href="?page=KategoriBerita">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Kategori Berita</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'ArsipBerita') ? 'active' : '' ?>" href="?page=ArsipBerita">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <span class="item-name">Arsip Berita</span>
                    </a>
                </li> -->
            </ul>
        </li>
        <li>
            <a class="nav-link  <?= (isset($_GET['page']) && $_GET['page'] == 'Mitra_Kerja') ? "active" : '' ?>"
                aria-current="page"
                href="?page=Mitra_Kerja">
                <i class="fas fa-handshake"></i> <span>Kerja Sama Mitra</span>
            </a>
        </li>
        <li></li>

        <!-- <li>
            <a href="profile.html">
                <i class="zmdi zmdi-face"></i> <span>Profile</span>
            </a>
        </li>
        <li>
            <a href="login.html" target="_blank">
                <i class="zmdi zmdi-lock"></i> <span>Login</span>
            </a>
        </li>
        <li>
            <a href="register.html" target="_blank">
                <i class="zmdi zmdi-account-circle"></i> <span>Registration</span>
            </a>
        </li>
        <li class="sidebar-header">LABELS</li>
        <li><a href="javascript:void(0);"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
        <li><a href="javascript:void(0);"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
        <li><a href="javascript:void(0);"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li>
    </ul> -->
</div>
<!-- End sidebar-wrapper -->

<!-- Start color switcher -->
<div class="right-sidebar">
    <div class="switcher-icon">
        <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
    </div>
    <div class="right-sidebar-content">
        <p class="mb-0">Gaussion Texture</p>
        <hr>
        <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
        </ul>
        <p class="mb-0">Gradient Background</p>
        <hr>
        <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
            <li id="theme13"></li>
            <li id="theme14"></li>
            <li id="theme15"></li>
        </ul>
    </div>
</div>
<!-- End color switcher -->