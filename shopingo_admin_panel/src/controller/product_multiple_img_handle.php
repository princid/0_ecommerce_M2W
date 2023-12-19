<?php
// include '../../config/connection.php';
// include '../model/fetch_products.php';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['delete_multiple_img_btn'])) {
//         $product_id = $_POST['product_id'];
        
//         $query = "SELECT `product_image` FROM `product_images` WHERE `product_id`='$product_id'";
//         $result = mysqli_query($conn, $query);

//         $rows = array();
//         while ($row = mysqli_fetch_assoc($result)) {
//             $rows[] = $row;
//         }
//         foreach ($rows as $img) {
//             $old_product_img = $img['product_image'];

//             if (!empty($old_product_img)) {
//                 $old_image_path = '../../assets/images/product_image/' . $old_product_img;
//                 if (file_exists($old_image_path)) {
//                     unlink($old_image_path);
//                 }
//             }
//             $delete_query = "DELETE FROM `product_images` WHERE `product_id`='$product_id' AND `product_image`='$old_product_img'";
//             mysqli_query($conn, $delete_query);
//         }
//         // $del_multiple_images = delMultipleimg($table, $condition);
//     }
// }
?>