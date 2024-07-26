<?php
error_reporting(1);
$conn = mysqli_connect("2.58.82.169", "lab_user1", "D6;.I-#?FP_V", "pc_global");

function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

// Select all rows from table1
// $query = "SELECT * FROM pc_categories";
// $result = mysqli_query($conn, $query);

// // Insert selected rows into table2
// while ($row = mysqli_fetch_assoc($result)) {
//     $fields = ['categories_id', 'categories_slug', 'categories_image','parent_id','is_featured','sort_order', 'status'];
//     $values = array($row['categories_id'], slugify($row['categories_name']), $row['categories_image'],$row['parent_id'],0,$row['sort_order'], $row['status']);

//     $query = "INSERT INTO lab_superadmin.ecm_pc_categories (" . implode(", ", $fields) . ") VALUES ('" . implode("', '", $values) . "')";

//     mysqli_query($conn, $query);
// }

// $query = "SELECT * FROM pc_categories_description";
// $result = mysqli_query($conn, $query);

// // Insert selected rows into table2
// while ($row = mysqli_fetch_assoc($result)) {
//     $fields = ['categories_id', 'languages_id', 'categories_name','categories_menu_name','categories_description'];
//     $values = array($row['categories_id'], $row['language_id'], mysqli_real_escape_string($conn, $row['categories_name']), mysqli_real_escape_string($conn, $row['categories_top_nav_name']),mysqli_real_escape_string($conn, $row['categories_description']));

//     $query = "INSERT INTO lab_superadmin.ecm_pc_categories_description (" . implode(", ", $fields) . ") VALUES ('" . implode("', '", $values) . "')";

//     mysqli_query($conn, $query);
// }


$query = "SELECT * FROM pc_products_to_categories";
$result = mysqli_query($conn, $query);

// Insert selected rows into table2
while ($row = mysqli_fetch_assoc($result)) {
    $fields = ['products_id', 'categories_id'];
    $values = array($row['products_id'], $row['categories_id']);

   echo  $query = "INSERT INTO lab_superadmin.ecm_pc_products_to_categories (" . implode(", ", $fields) . ") VALUES ('" . implode("', '", $values) . "')";

   // mysqli_query($conn, $query);
}


mysqli_close($conn);

?>
