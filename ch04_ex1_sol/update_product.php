<?php
require_once('database.php');

// Retrieve product data from the form
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$code = filter_input(INPUT_POST, 'code');
$name = filter_input(INPUT_POST, 'name');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

// Validate the data
if ($product_id == NULL || $product_id == FALSE || 
    $category_id == NULL || $category_id == FALSE ||
    $code == NULL || $name == NULL || 
    $price == NULL || $price == FALSE) {
    $error = "Données du produit invalides. Veuillez vérifier tous les champs et réessayer.";
    include('error.php');
} else {
    // Update product in database
    $query = 'UPDATE products
              SET categoryID = :category_id,
                  productCode = :code,
                  productName = :name,
                  listPrice = :price
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();

    // Redirect to product listing page
    header("Location: index.php");
}
?>
