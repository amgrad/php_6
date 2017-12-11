<?php
if (isset($_POST) && isset($_FILES) && isset($_FILES['testfile'])) {
    $file_name = $_FILES['testfile']['name'];
    $tmp_file = $_FILES['testfile']['tmp_name'];
    $upload_dir = 'upload/';
    $path_info = pathinfo($upload_dir . $file_name);
    if ($path_info['extension'] === 'json') {
		if(move_uploaded_file($tmp_file, $upload_dir . $file_name))
		{
			echo 'Спасибо, Ваш тест загружен!';
		}
		else{
			echo 'Ошибка загрузки :(';
		}
        
    }else{
        echo 'Извините, нужен файл с расширением JSON';
    }
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Загрузить тест</title>
</head>
<body>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="testfile">
        <input type="submit" value="Загрузить">
    </form>

    <ul>
        <li><a href="admin.php">Загрузить тест</a></li>
        <li><a href="list.php">Список тестов</a></li>
    </ul>
</body>
</html>