<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/views/category/categoryStyle.css" rel="stylesheet">
</head>
<body>
<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Загрузити світлину:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="title">Ім'я:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <button type="submit">Додати</button>
        </div>
    </form>
</div>
</body>
</html>

