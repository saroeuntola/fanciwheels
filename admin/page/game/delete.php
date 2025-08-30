<?php
include('../library/game_lib.php');
include('../library/checkroles.php');
protectPathAccess();

$product = new Games();

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $gameData = $product->getGameById($productId);

    if ($gameData) {
        // Correct file path
        $imagePath = __DIR__ . '/' . $gameData['image'];

        if ($product->deleteGame($productId)) {

            // Delete the image file from server if it exists
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }

            echo "<script>alert('Product deleted successfully!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to delete product!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('Game not found!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='index.php';</script>";
}


