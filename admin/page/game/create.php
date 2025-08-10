<?php
include('../library/game_lib.php');
include('../library/category_lib.php');
include('../library/checkroles.php');
protectPathAccess();

$product = new Games();
$category = new Category();
$categories = $category->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameName = $_POST['name'];
    $description = $_POST['description']; // HTML from TinyMCE
    $game_link = $_POST['game_link']; 
    $categoryId = $_POST['category_id'];
    $meta_text = $_POST['meta_text']; // HTML from TinyMCE

    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "game_image/";
        $imagePath = $uploadDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    if ($product->createGames($gameName, $imagePath, $description, $game_link, $categoryId, $meta_text)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Content could not be created.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '.richtext',
        height: 250,
        menubar: false,
        plugins: 'lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic underline | fontsizeselect forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | preview code',
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt'
      });
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Create Post</h2>

        <form action="create" method="POST" enctype="multipart/form-data" class="space-y-5">
            <!-- Product Name -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Image</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" class="richtext w-full border rounded-md"></textarea>
            </div>

            <!-- Meta Text -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Text</label>
                <textarea name="meta_text" class="richtext w-full border rounded-md"></textarea>
            </div>

            <!-- Game Link -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Game Link</label>
                <input type="text" name="game_link" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                <select name="category_id" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $categorys): ?>
                        <option value="<?= $categorys['id'] ?>"><?= htmlspecialchars($categorys['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md text-lg font-semibold hover:bg-indigo-700 transition-all">
                Post
            </button>
        </form>
    </div>
</body>
</html>
