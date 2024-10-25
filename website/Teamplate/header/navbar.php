<?php
// Include the database connection and other necessary files
// require_once('libraries/config/dbcon.php');

// Fetch menu items and sub-menu items from the database
$sql = "
    SELECT 
        m.kd_masternavbar2, 
        m.nm_masternavbar2, 
        m.link_masternavbar2,  /* Menambahkan link_masternavbar2 */
        s.kd_subab1nav2, 
        s.nm_subab1nav2, 
        s.link_subab1nav2, 
        ss.nm_subab2nav2, 
        ss.link_subab2nav2
    FROM 
        dt_masternavbar2 m
    LEFT JOIN 
        dt_subab1nav2 s 
        ON m.kd_masternavbar2 = s.kd_masternavbar2 AND s.ket_subab1nav2 = 'aktif'
    LEFT JOIN 
        dt_subab2nav2 ss 
        ON s.kd_subab1nav2 = ss.kd_subab1nav2 AND ss.ket_subab2nav2 = 'aktif'
    WHERE 
        m.ket_masternavbar2 = 'aktif'
    ORDER BY 
        m.id_masternavbar2, 
        s.id_subab1nav2, 
        ss.id_subab2nav2
";

$result = $mysqli->query($sql);

// Prepare array to hold menu items with sub-menus
$menu_items = array();

if ($result) {
    while($row = $result->fetch_assoc()) {
        $kd_masternavbar2 = $row['kd_masternavbar2'];
        $kd_subab1nav2 = $row['kd_subab1nav2'];
        
        // Group menu items by `kd_masternavbar2`
        if (!isset($menu_items[$kd_masternavbar2])) {
            $menu_items[$kd_masternavbar2] = array(
                'nm_masternavbar2' => $row['nm_masternavbar2'],
                'link_masternavbar2' => $row['link_masternavbar2'],  // Tambahkan link_masternavbar2 ke array
                'sub_menu' => array()
            );
        }
        
        // Add first level sub-menu items if they exist
        if (!empty($row['nm_subab1nav2'])) {
            if (!isset($menu_items[$kd_masternavbar2]['sub_menu'][$kd_subab1nav2])) {
                $menu_items[$kd_masternavbar2]['sub_menu'][$kd_subab1nav2] = array(
                    'nm_subab1nav2' => $row['nm_subab1nav2'],
                    'link_subab1nav2' => $row['link_subab1nav2'],  // Tambahkan link_subab1nav2 ke array
                    'sub_sub_menu' => array()
                );
            }
            
            // Add second level sub-menu items if they exist
            if (!empty($row['nm_subab2nav2'])) {
                $menu_items[$kd_masternavbar2]['sub_menu'][$kd_subab1nav2]['sub_sub_menu'][] = array(
                    'nm_subab2nav2' => $row['nm_subab2nav2'],
                    'link_subab2nav2' => $row['link_subab2nav2']  // Tambahkan link_subab2nav2 ke array
                );
            }
        }
    }
} else {
    echo 'Error: ' . $mysqli->error;
}

// Close the database connection

?>

<link rel="stylesheet" href="Teamplate/header/style.css">
<div class="middle-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-12">
				<div class="logo">
					<a href="index.html"><img src="./assets/img/logorsud.png" alt="#"></a>
				</div>
				<div class="mobile-nav"></div>
			</div>
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
                    $hpNavinfo = htmlspecialchars($LoadQrylvluser['hp_navinfo'], ENT_QUOTES, 'UTF-8');
                    $hp2Navinfo = htmlspecialchars($LoadQrylvluser['hp2_navinfo'], ENT_QUOTES, 'UTF-8');
                ?>
				<div class="col-lg-9 col-md-9 col-12">
					<div class="widget-main">
                        <div class="single-widget">
                            <a href="https://wa.me/<?=$hp2Navinfo;?>" target="_blank">
                                <i class="fa-brands fa-whatsapp"></i>
                                <p>No Whatsapp</p>
                                <h4><?=$hp2Navinfo;?></h4>
                            </a>
                        </div>
						<div class="single-widget">
                            <a href="tel:<?=$hpNavinfo;?>">
                                <i class="fa-solid fa-square-phone"></i>
                                <p>No Telp</p>
                                <h4><?=$hpNavinfo;?></h4>
                            </a>
						</div>
					</div>
				</div>
                <?php
                }
                ?>
			</div>
		</div>
	</div>
	<!-- End Middle Header -->
	<!-- Header Inner -->
	<div class="header-inner">
		<div class="container">
			<div class="inner">
				<div class="row">
					<div class="col-12 mb-2">
						<div class="main-menu">
                            <nav class="navigation">
                                <ul class="nav menu">
                                    <?php
                                    foreach ($menu_items as $item) {
                                        $link_masternavbar2 = $item['link_masternavbar2'];
                                        $nm_masternavbar2 = htmlspecialchars($item['nm_masternavbar2']);
                                        
                                        // Determine if the top-level menu item should have a link
                                        $top_level_link = ($link_masternavbar2 === '-') ? '#' : htmlspecialchars($link_masternavbar2);
                                        
                                        // Check if this menu item has sub-menus
                                        $has_sub_menu = !empty($item['sub_menu']);
                                        
                                        echo '<li' . ($has_sub_menu ? ' class="has-dropdown"' : '') . '>';
                                        echo '<a href="' . $top_level_link . '">' . $nm_masternavbar2 . ($has_sub_menu ? '<i class="icofont-rounded-down"></i>' : '') . '</a>';
                                        
                                        if ($has_sub_menu) {
                                            echo '<ul class="dropdown">';
                                            foreach ($item['sub_menu'] as $sub_item) {
                                                $link_subab1nav2 = $sub_item['link_subab1nav2'];
                                                $nm_subab1nav2 = htmlspecialchars($sub_item['nm_subab1nav2']);
                                                
                                                // Determine if the sub-menu item should have a link
                                                $sub_level_link = ($link_subab1nav2 === '-') ? '#' : htmlspecialchars($link_subab1nav2);
                                                
                                                if (!empty($sub_item['sub_sub_menu'])) {
                                                    echo '<li class="has-dropdown-side"><a href="' . $sub_level_link . '">' . $nm_subab1nav2 . '<i class="icofont-rounded-right"></i></a>';
                                                    echo '<ul class="dropdown-side">';
                                                    foreach ($sub_item['sub_sub_menu'] as $sub_sub_item) {
                                                        $link_subab2nav2 = htmlspecialchars($sub_sub_item['link_subab2nav2']);
                                                        $nm_subab2nav2 = htmlspecialchars($sub_sub_item['nm_subab2nav2']);
                                                        echo '<li><a href="' . ($link_subab2nav2 === '-' ? '#' : $link_subab2nav2) . '">' . $nm_subab2nav2 . '</a></li>';
                                                    }
                                                    echo '</ul></li>';
                                                } else {
                                                    echo '<li><a href="' . $sub_level_link . '">' . $nm_subab1nav2 . '</a></li>';
                                                }
                                            }
                                            echo '</ul>';
                                        }
                                        
                                        echo '</li>';
                                    }
                                    ?>
                                </ul>
                            </nav>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>