<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="/dist/output.css" rel="stylesheet">
</head>

<body>
    <!-- Modal -->
    <?php if (isset($_SESSION['inactive_message'])): ?>
        <div id="inactiveModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-96 text-center shadow-lg">
                <h2 class="text-xl font-bold mb-4">Account Inactive</h2>
                <p class="mb-6"><?= $_SESSION['inactive_message']; ?></p>
                <button id="closeModal" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">OK</button>
            </div>
        </div>
    <?php endif; ?>

    <script>
        const modal = document.getElementById('inactiveModal');
        const closeBtn = document.getElementById('closeModal');

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.style.display = 'none';
                // Remove the session message by making a request to unset it
                fetch('unset_inactive_message');
            });
        }
    </script>
</body>
</html>