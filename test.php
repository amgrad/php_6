<?php
if(!$_GET['test'])
{
	echo 'название теста не передано';
	die();
}

$test = urldecode($_GET['test']);

//echo $test;
$file_test = file_get_contents($test);

if(!$file_test)
{
	echo 'такого теста нет';
	die();
}

$decode_file = json_decode($file_test, true);


if($_POST)
{
	$errore = array();
	//print_r($_POST); // Array ( [0] => Array ( [0] => 1 [1] => 2 ) )
	//echo "<br>";
	foreach($decode_file['questions']  as $q_key => $question)
	{

			//$a_err = 0;
			$errore[$q_key]=0;

			foreach($question['answers'] as $a_key=>$answer)
			{
				
				
				$checked = false;
				if($_POST[$q_key])
				{
					if(in_array($a_key, $_POST[$q_key]))
					{
						$checked = true;
					}
				}
				
				if($answer['result']==true AND $checked)
				{
					//echo "TRUE <br>";
					//правильно
				}
				elseif($answer['result']==false AND !$checked)
				{
					//echo "FALSE <br>";
					//правильно
				}
				else
				{
					$errore[$q_key]++;
				}
			}

	}
	//print_r($errore);
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест: <?=$decode_file['test_name']?></title>
	<style>
	.errore{
		border: 1px solid red;
	}
	</style>
</head>
<body>

<h1><?=$decode_file['test_name']?></h1>
<form method="post">
	<?$summa = 0;
	foreach($decode_file['questions']  as $q_key => $question):
	$summa += $errore[$q_key];
		if($errore[$q_key]>0):?>
			<div class = "errore">
			<p>Колличество ошибок - <?=$errore[$q_key]?></p>
		<?else:?>
			<div>
		<?endif;?>
			<h2><?=$question['question'];?></h2>
			<?foreach($question['answers'] as $a_key => $answer):?>
			<?
			$checked = false;
			if($_POST[$q_key])
			{
				$checked = in_array($a_key, $_POST[$q_key]);
			}
			?>
				 <label><input type="checkbox" name="<?=$q_key?>[]" value="<?=$a_key?>" <?if($checked):?> checked <?endif;?>><?=$answer['answer'];?></label>
			<?endforeach;?>
		</div>
	<?endforeach;?>

    <input type="submit" value="Отправить">
</form>
		<div>
			<?if($summa>0)?>
				<p>Общее кол-во ошибок - <?=$summa;?></p>
		</div>
<ul>
    <li><a href="admin.php">Загрузить тест</a></li>
    <li><a href="list.php">Список тестов</a></li>
</ul>

</body>
</html>