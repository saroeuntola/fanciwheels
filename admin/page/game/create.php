<?php
include('../library/game_lib.php');
include('../library/category_lib.php');
include('../library/checkroles.php');
protectPathAccess();

$product = new Games();
$category = new Category();
$categories = $category->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameName = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? ''; // HTML from Quill
    $game_link = $_POST['game_link'] ?? '';
    $categoryId = $_POST['category_id'] ?? '';
    $meta_text = $_POST['meta_text'] ?? '';
    $name_bn = $_POST['name_bn'] ?? '';
    $description_bn = $_POST['description_bn'] ?? ''; // HTML from Quill
    $meta_text_bn = $_POST['meta_text_bn'] ?? '';

    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "game_image/";
        // Sanitize filename to prevent path traversal
        $imageFileName = preg_replace("/[^a-zA-Z0-9._-]/", "", basename($_FILES["image"]["name"]));
        $imagePath = $uploadDir . $imageFileName;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $imagePath = ""; // Reset if upload fails
        }
    }

    // Validate required fields
    if (empty($gameName) || empty($description) || empty($categoryId)) {
        echo "<p class='text-red-500 text-center'>Error: Title, Description, and Category are required.</p>";
    } else {
        if ($product->createGames($gameName, $imagePath, $description, $game_link, $categoryId, $meta_text, $name_bn, $description_bn, $meta_text_bn)) {
            header("Location: index.php");
            exit;
        } else {
            echo "<p class='text-red-500 text-center'>Error: Content could not be created.</p>";
        }
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
        .form-section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen w-full">
    <?php include './loading.php' ?>
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Create Post</h2>

        <form action="create" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="syncQuillContent()">
            <!-- English Fields -->
            <div class="form-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">English Content</h3>
                <!-- Title (English) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Title (English)</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <!-- Description (English) -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description (English)</label>
                    <div id="description-editor" class="border rounded-md"></div>
                    <input type="hidden" name="description" id="description-input">
                </div>
                <!-- Meta Text (English) -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Text (English)</label>
                    <input type="text" name="meta_text" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>

            <!-- Bengali Fields -->
            <div class="form-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Bengali Content</h3>
                <!-- Title (Bengali) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Title (Bengali)</label>
                    <input type="text" name="name_bn" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <!-- Description (Bengali) -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description (Bengali)</label>
                    <div id="description-bn-editor" class="border rounded-md"></div>
                    <input type="hidden" name="description_bn" id="description-bn-input">
                </div>
                <!-- Meta Text (Bengali) -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Meta Text (Bengali)</label>
                    <input type="text" name="meta_text_bn" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Upload Image</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Game Link -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Link</label>
                <input type="text" name="game_link" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                <select name="category_id" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value=""><?php echo $lang === 'en' ? 'Select Category' : 'বিভাগ নির্বাচন করুন'; ?></option>
                    <?php foreach ($categories as $categorys): ?>
                        <option value="<?= htmlspecialchars($categorys['id']) ?>"><?= htmlspecialchars($categorys['name']) ?></option>
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

        // Description Editor (English)
        const descriptionEditor = new Quill('#description-editor', {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        // Description Editor (Bengali)
        const descriptionBnEditor = new Quill('#description-bn-editor', {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        // Sync Quill content to hidden inputs
        function syncQuillContent() {
            document.getElementById('description-input').value = descriptionEditor.root.innerHTML;
            document.getElementById('description-bn-input').value = descriptionBnEditor.root.innerHTML;
        }
    </script>
</body>
</html>