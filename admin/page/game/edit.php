<?php
include('../library/game_lib.php');
include('../library/category_lib.php');
include('../library/checkroles.php');

protectPathAccess();

$product = new Games();
$category = new Category();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $productData = $product->getGameById($id);
    if (!$productData) {
        die("Game not found");
    }
}
$categories = $category->getCategories();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameName = $_POST['name'];
    $description = $_POST['description'];
    $game_link = $_POST['game_link'];
    $categoryId = $_POST['category_id'];
    $meta_text = $_POST['meta_text'];

    // Keep old image unless a new one is uploaded
    $imagePath = $productData['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "game_image/";
        $imagePath = $uploadDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    if ($product->updateGame($id, $gameName, $imagePath, $description, $game_link, $categoryId, $meta_text)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Product could not be updated.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Quill CSS & JS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <style>
        .ql-editor {
            min-height: 150px;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Edit Post</h2>

        <form action="edit?id=<?= $productData['id']; ?>" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="syncQuillContent()">
            <!-- Product Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="name" value="<?= htmlspecialchars($productData['name']) ?>" required
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Product Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <img src="<?= htmlspecialchars($productData['image']) ?>" class="h-20 w-20 object-cover rounded-md mb-2">
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <div id="description-editor" class="border rounded-md"><?= $productData['description'] ?></div>
                <input type="hidden" name="description" id="description-input">
            </div>

            <!-- Meta Text -->
            <div>
                <label for="meta_text" class="block text-sm font-medium text-gray-700">Meta Text</label>
                <div id="meta-editor" class="border rounded-md"><?= $productData['meta_text'] ?></div>
                <input type="hidden" name="meta_text" id="meta-input">
            </div>

            <!-- Game Link -->
            <div>
                <label for="game_link" class="block text-sm font-medium text-gray-700">Game Link</label>
                <input type="text" name="game_link" value="<?= htmlspecialchars($productData['game_link']) ?>"
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" required
                        class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $productData['category_id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md text-lg font-semibold hover:bg-indigo-700 transition-all">
                Update
            </button>
        </form>
    </div>

    <script>
        const toolbarOptions = [
            [{ 'font': [] }, { 'size': [] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'script': 'sub' }, { 'script': 'super' }],
            [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block'],
            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
            [{ 'align': [] }],
            ['link', 'image', 'video'],
            ['clean']
        ];

        const descriptionEditor = new Quill('#description-editor', {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        const metaEditor = new Quill('#meta-editor', {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        function syncQuillContent() {
            document.getElementById('description-input').value = descriptionEditor.root.innerHTML;
            document.getElementById('meta-input').value = metaEditor.root.innerHTML;
        }
    </script>
</body>
</html>
