<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Relevé</title>
    <link rel="stylesheet" href="../../public/style.css">
</head>
<body>
    <main>
        <h2>Upload des Relevés</h2>
        <form method="POST" action="../controllers/ReleveController.php" enctype="multipart/form-data">
            <input type="file" name="excel_file" required>
            <button type="submit" name="upload_releve">Uploader</button>
        </form>
    </main>
</body>
</html>
