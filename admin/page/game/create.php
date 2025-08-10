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
    $description = $_POST['description']; // HTML from Quill
    $game_link = $_POST['game_link']; 
    $categoryId = $_POST['category_id'];
    $meta_text = $_POST['meta_text'];

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

    <!-- Quill CSS & JS -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <style>
        .ql-editor {
            min-height: 150px;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen w-full">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Create Post</h2>

        <form action="create" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="syncQuillContent()">
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
                <div id="description-editor" class="border rounded-md"></div>
                <input type="hidden" name="description" id="description-input">
            </div>

            <!-- Meta Text -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Text</label>
                  <input type="text" name="meta_text" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
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

    <script>
        // Quill toolbars
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

        // Description Editor
        const descriptionEditor = new Quill('#description-editor', {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });
        // On submit, sync Quill content to hidden inputs
        function syncQuillContent() {
            document.getElementById('description-input').value = descriptionEditor.root.innerHTML;
        }
    </script>
</body>
</html>
