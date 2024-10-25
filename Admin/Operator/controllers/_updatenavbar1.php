<?php
// Include database connection
require_once('../../libraries/config/dbcon.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $kd_navinfo = $_POST['kd_navinfo'];
    $alamat_navinfo = $_POST['alamat_navinfo'];
    $kode_pos_navinfo = $_POST['kode_pos_navinfo'];
    $email_navinfo = $_POST['email_navinfo'];
    $hp_navinfo = $_POST['hp_navinfo'];
    $hp2_navinfo = isset($_POST['hp2_navinfo']) ? $_POST['hp2_navinfo'] : '';

    // Prepare and execute the update query
    $stmt = $mysqli->prepare("
        UPDATE dt_navinfo 
        SET alamat_navinfo = ?, kode_pos_navinfo = ?, email_navinfo = ?, hp_navinfo = ?, hp2_navinfo = ? 
        WHERE kd_navinfo = ?
    ");
    $stmt->bind_param(
        'sssssi', 
        $alamat_navinfo, 
        $kode_pos_navinfo, 
        $email_navinfo, 
        $hp_navinfo, 
        $hp2_navinfo, 
        $kd_navinfo
    );

    if ($stmt->execute()) {
        // If the update was successful
        echo json_encode(['status' => 'success', 'message' => 'Data updated successfully.']);
    } else {
        // If there was an error
        echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
    }

    // Close the statement and connection
    $stmt->close();
    $mysqli->close();
} else {
    // If not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
