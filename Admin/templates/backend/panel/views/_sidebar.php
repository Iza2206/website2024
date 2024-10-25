<!-- Start sidebar-wrapper -->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="dashboard">
            <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">RSUD H Amri Tambunan</h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a class="nav-link <?= (empty($_GET['page'])) ? "active": ''?>" aria-current="page" href="dashboard">
                <i class="zmdi zmdi-view-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-header">MASTER DATA</li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#sidebar-menu">
                <i class="fa-duotone fa-solid fa-user"></i>
                <i class="fas fa-caret-down float-right"></i> 
                <span>USER</span>
            </a>
            <ul class="collapse sidebar-menu <?= (isset($_GET['page']) && in_array($_GET['page'], ['KategoriLvlUser', 'UserLvlKategori'])) ? 'show' : '' ?>" id="sidebar-menu">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'KategoriLvlUser') ? 'active' : '' ?>" href="?page=KategoriLvlUser">
                        <i class="icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Horizontal" data-bs-placement="right"></i>
                        <span class="item-name">Kategori Level</span>
                    </a>
                </li>
                <!-- Repeat similar structure for other items -->
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['page']) && $_GET['page'] == 'UserLvlKategori') ? 'active' : '' ?>" href="?page=UserLvlKategori">
                        <i class="icon svg-icon">
                            <svg class="icon-10" width="10" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <circle cx="12" cy="12" r="8" fill="currentColor"></circle>
                                </g>
                            </svg>
                        </i>
                        <i class="sidenav-mini-icon" data-bs-toggle="tooltip" title="Dual Compact" data-bs-placement="right"></i>
                        <span class="item-name">User Level</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a  class="nav-link  <?= (isset($_GET['page']) && $_GET['page']=='TmbhNavbar1') ? "active": ''?>"
                aria-current="page"
                href="?page=TmbhNavbar1">
            <i class="fas fa-plus-square"></i> <span>Navbar 1</span>
            </a>
        </li>
        <!-- Other sidebar items -->
        <li>
            <a  class="nav-link  <?= (isset($_GET['page']) && $_GET['page']=='Master_Crousel') ? "active": ''?>"
                aria-current="page"
                href="?page=Master_Crousel">
                <i class="fas fa-images"></i></i> <span>Carousel</span>
            </a>
        </li>
        <li>
            <a href="forms.html">
                <i class="zmdi zmdi-format-list-bulleted"></i> <span>Forms</span>
            </a>
        </li>
        <li>
            <a href="tables.html">
                <i class="zmdi zmdi-grid"></i> <span>Tables</span>
            </a>
        </li>
        <li>
            <a href="calendar.html">
                <i class="zmdi zmdi-calendar-check"></i> <span>Calendar</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>
        <li>
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
    </ul>
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
