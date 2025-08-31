<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AJAX File Upload</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #result {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h2>Upload File</h2>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" id="fileInput" required>
        <button type="submit">Upload</button>
    </form>

    <div id="result"></div>

    <script>
        $(document).ready(function() {
            $('#uploadForm').submit(function(e) {
                e.preventDefault(); // stop default form submit

                var formData = new FormData(this);

                $.ajax({
                    url: 'http://fancywheel:8080/admin/page/game/upload.php', // make sure upload.php is in the same folder
                    type: 'POST', // must be POST
                    data: formData,
                    contentType: false, // important for file upload
                    processData: false, // important for file upload
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#result').html('<span style="color:green;">' + response.message + '</span><br>File path: ' + response.file);
                        } else {
                            $('#result').html('<span style="color:red;">' + response.message + '</span>');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#result').html('<span style="color:red;">AJAX error: ' + error + '</span>');
                    }
                });
            });
        });
    </script>

</body>

</html>