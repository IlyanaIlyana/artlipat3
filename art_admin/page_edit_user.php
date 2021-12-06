<?php session_start(); $title = "Правка Данных"; require_once "header.php"; 
	if(!isset($_SESSION['userid']))
	{		
	print "пошел вон!! <br>";    
	header("Location: https://www.google.ru/"); 
	exit();  
	}


	StartDB();
	
	$id_employee = $_GET['id_employee'];

	$SQL1 = "SELECT * FROM employees 
	JOIN employee_status es ON es.id_status = employees.status_id
	WHERE `id_employee`=".$id_employee;

	if ($result1 = mysqli_query($db, $SQL1))  //это я получила всю строку по этому сотруднику
	{
		$row1 = mysqli_fetch_assoc($result1); // превратила эту строку в одномерный ассоциативный массив	
		mysqli_free_result($result1);	
	}
	else
	{
		printf("Ошибка в запросе: %s\n", mysqli_error($db));
	}
	EndDB();
	//print_r($row1);
?>
	<div class="row">
    <div class="col-lg-12">
	<div class="panel-body">
	<h3>Общая информация о сотруднике:</h3>
	<p>Дата регистрации: <?php echo $row1['reg_date']?></p>
	<form action="processing_update_employee.php" method="post" enctype="multipart/form-data"> 
	<table>
    <tr><td>Публичное имя</td><td><input class='form-control' name='employeename' type='text' value='<?php echo $row1['employee_nickname']?>'></td></tr>
	<input  name='imageurl' type='hidden' value='<?php echo $row1['employee_picture_source']?>'></td></tr> 
    <tr><td>Фотка</td><td><input  class="btn btn-primary" type="file" name="uploadfile"></td></tr>
	<?php
	$imageurl = $row1['employee_picture_source'];
			if ($imageurl == "")
				{
					$imagehtml = "";
				}
				else
				{
					$imagehtml = "<img width=30 src='".$imageurl."'>";
				}   
				print "<tr><td>$imagehtml</td><tr>"; 
	?>
	<tr><td>Статус</td><td>
	<select class='form-control' name='employeestatus_id'>
	<?php
	StartDB();
	$SQL="SELECT * FROM employee_status";
	if ($result = mysqli_query($db, $SQL))  
	{
		while($row2 = mysqli_fetch_assoc($result))	
	  {	  
		//print_r($row2);                            
		if ($row2['id_status']==$row1['status_id']){print "<option selected value=".$row2['id_status'].">".$row2['status_name']."</option>";}
		else {print "<option value=".$row2['id_status'].">".$row2['status_name']."</option>";}
	  } 
		mysqli_free_result($result);	
	}
	else
	{
		printf("Ошибка в запросе: %s\n", mysqli_error($db));
	}
	EndDB();

	?>
	</select></td></tr>
	<input  name='id_employee' type='hidden' value='<?php echo $id_employee?>'>
    <tr><td colspan=2><input  class='btn btn-primary' type='submit' value='Сохранить изменение'></td></tr>
    </table>
	</form>
	<p>*Данные на странице изменятся после повторного входа в аккаунт</p>
	</div>
	</div>
	</div>

	<div class="row">
    <div class="col-lg-6">
	<div class="panel-body">
	<h3>Данные для доступа к сервису:</h3>
	<form action="processing_credentials.php" method="post"> 
	 <table>
	 <tr><td>Логин</td><td><input class='form-control' name='enteredlogin' placeholder= 'логин для сотрудника' type='text' value='<?php echo $row1['employee_login']?>'></td></tr> 
	 <tr><td>Пароль</td><td><input class='form-control' name="enteredpassword" placeholder= 'пароль для сотрудника' type="password"  value='<?php echo $row1['employee_password']?>'></td></tr>
	 <?php
	 if ($row1['employee_level']!=10){
	 ?>
	 <tr><td>Доступ</td><td><input class='form-control' name='employeelevel' type='number' value='<?php echo $row1['employee_level']?>' min="1" max="9"></td></tr>  
	 <?php
	 }
	 if ($row1['employee_level']==10){
		?>
		<tr><td>Это босс</td><td>с неизменным уровнем доступа 10</td></tr>  
		<?php
		}
	 ?>
	 <input  name='employeelogin' type='hidden' value='<?php echo $row1['employee_login']?>'>
	 <input  name='id_employee' type='hidden' value='<?php echo $id_employee?>'>
     <tr><td colspan=2><input  class='btn btn-primary' type='submit' value='Изменить данные доступа'></td></tr>
    </table>
	</form>
	<h3><a href= "index.php">На главную</a></h3>
	</div>
	</div>
	<div class="col-lg-6">
	<div class="panel-body">
	<h3>Информация по доступу к сервису:</h3>
	<p>Уровень 10 - сотрудник, администратор и создатель аккаунта: имеет доступ к настройкам, нельзя понизить его уровень</p>
	<p>Уровень 9 - сотрудник и администратор: имеет доступ к настройкам</p>
	<p>Уровень 1 - сотрудник: имеет доступ к сервису, но не к настройкам</p>
	<p>Уровень 0 - сотрудник, которому не дан доступ к сервису</p>
	<p></p>
	
	</div>
	</div>
	</div>	

<?php require_once "footer.php"; ?>

