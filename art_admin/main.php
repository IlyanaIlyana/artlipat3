<?php

function ShowUsers()
{
	global $db;
	$SQL = "SELECT * FROM employees JOIN employee_status es ON es.id_status = employees.status_id 
    WHERE `account_id`=".$_SESSION['useraccountid'];
    //print "вот так выглядит запрос: <br>".$SQL."<br>";
	
	if ($result = mysqli_query($db, $SQL)) 
	{
            ?>
                <table class="table">
                <thead>
                  <tr>
                    <th>Имя</th>
                    <th>Логин</th>
                    <th>Доступ</th>
                    <th>Фото</th>
                    <th>Статус</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
            <?php

		while( $row = mysqli_fetch_assoc($result) )
		{ 
            $imageurl = $row['employee_picture_source'];
            $imagehtml = "<img src='".$imageurl."'>";
            ?>
            <tr>
                <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><?php echo $row['employee_nickname']?></a></td>
                <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><?php echo $row['employee_login']?></a></td>
                <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><?php echo $row['employee_level']?></a></td>
                <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><?php echo $imagehtml ?></a></td>
                <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><?php echo $row['status_name']?></a></td>
                <!-- <td><a href="page_edit_user.php?id_employee=<?php echo $row['id_employee']?>"><i class="fa fa-edit"></i></a></td> -->
            </tr>
            <?php
		} 
		print "</tbody>";
        print "</table>";
		
		mysqli_free_result($result);
	}
	else
	{
		printf("Ошибка в запросе: %s\n", mysqli_error($db));
	}
	 
}	





function ImageUpload() 

{
    @mkdir("photo", 0777); // создаем папку, если ее нет то ошибки не будет, задаем права

    $dir = 'photo/';

//    print_r($_FILES);

    $filename = basename($_FILES['uploadfile']['name']);
//    print "<br>filename=".$filename."<br>";

    // Получаем хэш для имени файла
    // К имени файла добавляем код клиента
	$filecod = $filename.$_SESSION['userid'];
//    print "filecod=".$filecod."<br>";
	$filenamehashjpg = md5($filecod).".jpg";
//    print "filenamehashjpg=".$filenamehashjpg."<br>";

    /* $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']); */
    $uploadfilelocation = $dir.$filenamehashjpg;

    if(copy($_FILES['uploadfile']['tmp_name'], $uploadfilelocation)){
              
//        echo "<h3>Файл успешно загружен на сервер</h3>".$uploadfilelocation;
//        echo "<br><img src='".$uploadfilelocation."'>"; 
     
     //Определяем размер фотографии — ширину и высоту
     $size=GetImageSize ($uploadfilelocation);
     //Создаём новое изображение из «старого»
     $src=ImageCreateFromJPEG ($uploadfilelocation);
     //Берём числовое значение ширины фотографии, которое мы получили в первой строке и записываем это число в переменную
     $w_src=$size[0];
     //print "<br>iw=".$w_src."<br>";
     //Проделываем ту же операцию, что и в предыдущей строке, но только уже с высотой.
     $h_src=$size[1];
     //print "h_src=".$h_src."<br>";

     $w=30;
        // Создаём пустую квадратную картинку 
        $dest = imagecreatetruecolor($w, $w); 

        // Вырезаем квадратную серединку по x, если фото горизонтальное
        if ($w_src > $h_src)
        imagecopyresampled($dest, $src, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src))/2), 0, $w, $w, min($w_src, $h_src), min($w_src, $h_src));
        // Вырезаем квадратную серединку по y, если фото горизонтальное
        elseif ($w_src < $h_src)
        imagecopyresampled($dest, $src, 0, 0, 0, round((max($w_src, $h_src) - min($w_src, $h_src))/2), $w, $w, min($w_src, $h_src), min($w_src, $h_src));
        // Квадратная картинка масштабируется без вырезок
        elseif ($w_src == $h_src)
        imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $w, $w_src, $w_src);
   
        //Сохраняем полученное изображение в формате JPG
     ImageJPEG ($dest, $uploadfilelocation, 100);
     imagedestroy($src);
     

    }else{

       // echo "<h3>Не удалось загрузить файл на сервер</h3>";

        return FALSE;

    }

    //Данные о загруженном файле
    //echo "<h3>Информация о загруженном на сервер файле: </h3>";
    //echo "<p>Оригинальное имя загруженного файла:<b> ".$_FILES['uploadfile']['name']."</b></p>";
    //echo "<p>Mime-тип загруженного файла:<b> ".$_FILES['uploadfile']['type']."</b></p>";
    //echo "<p>Размер загруженного файла в байтах:<b> ".$_FILES['uploadfile']['size']."</b></p>";
    //echo "<p>Временное имя файла: <b>".$_FILES['uploadfile']['tmp_name']."</b></p>";

    return $uploadfilelocation;

}

function ShowCompanyName()
{
	global $db;
    $account_id = $_SESSION['useraccountid'];

	$SQL = "SELECT * FROM accounts
	WHERE `id_account`=".$account_id;

	if ($result = mysqli_query($db, $SQL)) 
	{
		$row = mysqli_fetch_assoc($result); 
		mysqli_free_result($result);	
	}
	else
	{
		printf("Ошибка в запросе: %s\n", mysqli_error($db));
	}	
	//print_r($row);
?>
	<div class="panel-body">
	<form action="processing_update_company_name.php" method="post"> 
	<table>
    <tr><td>первая часть имени</td><td><input class='form-control' name='company_name1' type='text' value='<?php echo $row['company_name1']?>'></td></tr>
	<tr><td>вторая часть имени</td><td><input class='form-control' name='company_name2' type='text' value='<?php echo $row['company_name2']?>'></td></tr>
    <tr><td colspan=2><input  class='btn btn-primary' type='submit' value='Сохранить изменение'></td></tr>
    </table>
	</form>
    <p>*Название на странице изменится после повторного входа в аккаунт</p>
    </div>
<?php    
}	