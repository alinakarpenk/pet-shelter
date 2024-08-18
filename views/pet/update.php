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
<div class="form-container">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Загрузити світлину:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>
        <div class="form-group">
            <label for="name">Ім'я:</label>
            <input type="text" id="name" name="name">
        </div>
        <div class="form-group">
            <label for="description">Опис:</label>
            <input type="text" id="description" name="description">
        </div>
        <div class="form-group">
            <label for="category">Категорія:</label>
            <select id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit">Змінити</button>
        </div>
    </form>
</div>
</body>
</html>
