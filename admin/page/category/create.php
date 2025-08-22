<?php
include('../library/announcement_lib.php');
include('../library/checkroles.php');
protectPathAccess();

$announcement = new Announcement();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $link = !empty($_POST['link']) ? $_POST['link'] : null;

    if ($announcement->createAnnouncement($message, $link)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500 text-center'>❌ Error: Announcement could not be created.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Announcement</title>
   <link href="/dist/output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<?php include './loading.php' ?>
  <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-6">Create Announcement</h2>

    <!-- Announcement Form -->
    <form action="create" method="POST">
      
      <!-- Message -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Message</label>
        <textarea name="message" required rows="4"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
      </div>

      <!-- Link -->
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Link</label>
        <input type="url" name="link" placeholder="https://example.com"
          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      </div>

      <!-- Submit -->
      <div>
        <button type="submit"
          class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg 
                 hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500">
          Create Announcement
        </button>
      </div>
    </form>
  </div>

</body>
</html>
