<?php

function ShowAllAccounts()
{
	global $db;
   
	$SQL = "SELECT * FROM accounts";

	if ($result = mysqli_query($db, $SQL)) 
	{
		?>
                <table class="table">
                <thead>
                  <tr>
                    <th>Почта регистрации</th>
                    <th>Дата регистрации</th>
                    <th>Допущен к сервису</th>
                    <th>Удаление</th>
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
                <td><?php echo $row['inception_email']?> </td>
                <td> <?php echo $row['registration_date']?> </td>
                <td> <?php echo $row['not_deleted_item']?> </td>
                <?php if ($row['not_deleted_item'] == 1) {?>
                <td> <a href='deleting_account.php?id_acc=<?php echo $row['id_account']?>' class='btn btn-border'> Отключить </a></td>
                <?php }
                else {?>
                  <td> <a href='restoring_account.php?id_acc=<?php echo $row['id_account']?>' class='btn btn-border'> Восстановить доступ </a></td>
                  <?php }?>
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
	//print_r($row);

function ShowAllUsers()
{
	global $db;
	$SQL = "SELECT 
    a2.inception_email,
    em.id_employee,
    em.employee_nickname,
    em.employee_login,
    em.employee_level,
    em.employee_picture_source,
    es.status_name,
    em.not_deleted_item
    FROM employees em
        JOIN employee_status es 
        ON es.id_status = em.status_id
        JOIN accounts a2 ON a2.id_account = em.account_id 
    ";
    //print "вот так выглядит запрос: <br>".$SQL."<br>";
	
	if ($result = mysqli_query($db, $SQL)) 
	{
            ?>
                <table class="table">
                <thead>
                  <tr>
                    <th>Название компании</th>
                    <th>Имя</th>
                    <th>Логин</th>
                    <th>Доступ</th>
                    <th>Фото</th>
                    <th>Статус</th>
                    <th>Допущен к сервису</th>
                    <th>Удаление</th>
                  </tr>
                </thead>
                <tbody>
            <?php

		while( $row = mysqli_fetch_assoc($result) )
		{ 
            $imageurl = $row['employee_picture_source'];
            $imagehtml = "<img src='../admin/".$imageurl."'>";
            ?>
            <tr>
                <td><?php echo $row['inception_email']?> </td>
                <td><?php echo $row['employee_nickname']?> </td>
                <td><?php echo $row['employee_login']?> </td>
                <td><?php echo $row['employee_level']?> </td>
                <td><?php echo $imagehtml ?> </td>
                <td><?php echo $row['status_name']?> </td>
                <td><?php echo $row['not_deleted_item']?> </td>
                <?php if ($row['not_deleted_item'] == 1) {?>
                <td> <a href='deleting_employee.php?id_empl=<?php echo $row['id_employee']?>' class='btn btn-border'> Отключить </a></td>
                <?php }
                else {?>
                  <td> <a href='restoring_employee.php?id_empl=<?php echo $row['id_employee']?>' class='btn btn-border'> Восстановить доступ </a></td>
                  <?php }?>
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





}	