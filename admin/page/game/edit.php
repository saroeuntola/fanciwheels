<?php
include('../library/game_lib.php');
include('../library/category_lib.php');
include('../library/checkroles.php');

protectPathAccess();

$product = new Games();
$category = new Category();

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Fetch game data with English fields (we'll handle both languages in the form)
    $productData = $product->getGameById($id, 'en');
    if (!$productData) {
        die("Game not found");
    }
    // Fetch Bengali fields separately
    $productDataBn = $product->getGameById($id, 'bn');
} else {
    die("No game ID provided");
}

$categories = $category->getCategories();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gameName = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $game_link = $_POST['game_link'] ?? '';
    $categoryId = $_POST['category_id'] ?? '';
    $meta_text = $_POST['meta_text'] ?? '';
    $name_bn = $_POST['name_bn'] ?? '';
    $description_bn = $_POST['description_bn'] ?? '';
    $meta_text_bn = $_POST['meta_text_bn'] ?? '';

    // Keep old image unless a new one is uploaded
    $imagePath = $productData['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "game_image/";
        // Sanitize filename to prevent path traversal
        $imageFileName = preg_replace("/[^a-zA-Z0-9._-]/", "", basename($_FILES["image"]["name"]));
        $imagePath = $uploadDir . $imageFileName;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            $imagePath = $productData['image']; // Revert to old image if upload fails
        }
    }

    // Validate required fields
    if (empty($gameName) || empty($description) || empty($categoryId)) {
        echo "<p class='text-red-500 text-center'>Error: Title, Description, and Category are required.</p>";
    } else {
        if ($product->updateGame($id, $gameName, $imagePath, $description, $game_link, $categoryId, $meta_text, $name_bn, $description_bn, $meta_text_bn)) {
            header("Location: index.php");
            exit;
        } else {
            echo "<p class='text-red-500 text-center'>Error: Product could not be updated.</p>";
        }
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
        .form-section {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Edit Post</h2>

        <form action="edit?id=<?= htmlspecialchars($productData['id']) ?>" method="POST" enctype="multipart/form-data" class="space-y-5" onsubmit="syncQuillContent()">
            <!-- English Fields -->
            <div class="form-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">English Content</h3>
                <!-- Title (English) -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Title (English)</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($productData['name']) ?>" required
                           class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <!-- Description (English) -->
                <div class="mt-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description (English)</label>
                    <div id="description-editor" class="border rounded-md"><?= $productData['description'] ?></div>
                    <input type="hidden" name="description" id="description-input">
                </div>
                <!-- Meta Text (English) -->
                <div class="mt-4">
                    <label for="meta_text" class="block text-sm font-medium text-gray-700">Meta Text (English)</label>
                    <input type="text" name="meta_text" value="<?= htmlspecialchars($productData['meta_text']) ?>"
                           class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>

            <!-- Bengali Fields -->
            <div class="form-section">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Bengali Content</h3>
                <!-- Title (Bengali) -->
                <div>
                    <label for="name_bn" class="block text-sm font-medium text-gray-700">Title (Bengali)</label>
                    <input type="text" name="name_bn" value="<?= htmlspecialchars($productDataBn['name']) ?>"
                           class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
                <!-- Description (Bengali) -->
                <div class="mt-4">
                    <label for="description_bn" class="block text-sm font-medium text-gray-700">Description (Bengali)</label>
                    <div id="description-bn-editor" class="border rounded-md"><?= $productDataBn['description'] ?></div>
                    <input type="hidden" name="description_bn" id="description-bn-input">
                </div>
                <!-- Meta Text (Bengali) -->
                <div class="mt-4">
                    <label for="meta_text_bn" class="block text-sm font-medium text-gray-700">Meta Text (Bengali)</label>
                    <input type="text" name="meta_text_bn" value="<?= htmlspecialchars($productDataBn['meta_text']) ?>"
                           class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>

            <!-- Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <?php if (!empty($productData['image'])): ?>
                    <img src="<?= htmlspecialchars($productData['image']) ?>" class="h-20 w-20 object-cover rounded-md mb-2">
                <?php else: ?>
                    <p class="text-gray-500 mb-2">No image available</p>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Game Link -->
            <div>
                <label for="game_link" class="block text-sm font-medium text-gray-700">Link</label>
                <input type="text" name="game_link" value="<?= htmlspecialchars($productData['game_link']) ?>"
                       class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" required
                        class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>" <?= ($cat['id'] == $productData['category_id']) ? 'selected' : '' ?>>
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