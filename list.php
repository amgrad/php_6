<?php
$file_list = glob('upload/*.json');
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список тестов</title>
</head>
<body>

    <?php
        foreach ($file_list as $key => $file) {
            $file_test = file_get_contents($file);
            $decode_file = json_decode($file_test, true);
			
			$test_name = $file;
			if($decode_file["test_name"])
			{
				$test_name = $decode_file["test_name"];
			}
			
			$file = urlencode($file);
			echo "<a href=\"test.php?test=$file\">" . $test_name . '</a><br>';

        }
    ?>

    <ul>
        <li><a href="admin.php">Загрузить тест</a></li>
        <li><a href="list.php">Список тестов</a></li>
    </ul>

</body>
</html>