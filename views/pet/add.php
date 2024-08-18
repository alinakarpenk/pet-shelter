 <?php /** @var array $categories */?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <link href="/views/pet/petStyle.css" rel="stylesheet">
</head>
<body>
<div class="add-container">
    <form method="POST" enctype="multipart/form-data">
        <div class="add-group">
            <label for="image">Загрузити світлину:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div class="add-group">
            <label for="name">Ім'я:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="add-group">
            <label for="description">Опис:</label>
            <input type="text" id="description" name="description" required>
        </div>
        <div class="add-group">
            <label for="category">Категорія:</label>
            <select id="category" name="category" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="add-group">
            <button type="submit">Додати</button>
        </div>
    </form>
</div>
</body>
</html>
