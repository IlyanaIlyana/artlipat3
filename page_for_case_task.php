<?php
session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['userid']))
	{		
    /* print "пошел вон!! <br>";     */
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php"; 	
require_once "functions_preparing_data_to_show.php"; 

$id_task_case = $_GET['sent_task_case_id']; // id записи задача-дело
$id_case = $_GET['sent_case_id']; // id дела
$taskstatus = $_GET['sent_taskstatus']; // 
$id_task = $_GET['sent_task_id']; // id задачи
$case_ref = $_GET['sent_our_case_ref']; // референс дела

$id_account = $_SESSION['useraccountid']; //id аккаунта

StartDB();
// получаем непосредственно массив $row_casedata для данного дела
SelectDataOnCaseId($id_case); // вызов из файла functions_preparing_data_to_show.php

if($row_casedata['account_id'] != $id_account)
	{		
   /*  print "зашел не туда...!! <br>";   */  
    header("Location: page_for_finding_case.php"); 
    exit();  
  }
require_once "header.php"; 	

EndDB();


//print "id_case=".$id_case."<br>";  
?>
	<!-- container section start -->
	<section id="container" class="sidebar-closed">
    <!--header start-->
    <header class="header dark-bg">
      <!--logo start-->
      <a href="index.php" class="logo"><?php echo $_SESSION ['accountname1'] ?> <span class="lite"><?php echo $_SESSION ['accountname2'] ?></span></a>
      <!--logo end--> 
      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <span class="profile-ava">
        <a href="index.php" ><img alt="photo" src="admin/<?php echo $_SESSION ['userphotourl'] ?>"></a>
        </span>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->    

	  <!--main content start-->
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-square-o"></i></a>Карточка задачи</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Главная</a></li>
              <li><i class="fa fa-bars"><a href="page_for_case_card.php?sent_case_id=<?php echo $id_case?>"></i>Карточка дела</a></li>
              <li><i class="fa fa-square-o"></i>Карточка задачи</li>
            </ol>
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
        <div class="row">
          <div class="col-md-4 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Детали задачи</strong></h2>
                <div class="panel-actions">
                  <!-- <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a> -->
                </div>
              </div>
              <div class="panel-body"> 
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  <form class="form-horizontal" action="art_control/processing_update_task.php" method="post">                  
                    <div class="form-group">  
                      <?php 
                      StartDB(); 
                      SelectThisTaskOnCase($id_task_case); // находится в functions_preparong_data_to_show.php
                                                                // получим массив $row_casetask (все данные по этой задаче)
                      EndDB(); 
                      if (($row_casetask['task_id'] == 21) OR 
                        ($row_casetask['task_id'] == 26) OR
                        ($row_casetask['task_id'] == 41) OR
                        ($row_casetask['task_id'] == 45) 
                        ){$hidden="";}
                      else {$hidden='style="display: none"';}
                      ?>              
                      <p class="col-lg-9">Дело: <?php echo $case_ref?></p>
                      <p class="col-lg-9">Задача: <?php echo $row_casetask['task_name'].$row_casetask['what']?></p>
                      </p> 
                    </div> 
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Кто делает</label>
                        <div class="col-lg-9">
                          <select class='form-control' name='responsible_id'>
                            <?php
                            StartDB();
                            SelectEmployeesOnAccountId();  // находится в functions_preparing_data_to_show.php
                                                      // получим выборку $result_emplos (все сотрудники в данном аккаунте)
                            EndDB();
                              while($row = mysqli_fetch_assoc($result_emplos))	
                              {	  
                              //print_r($row);                            
                              if ($row['id_employee']==$row_casetask['task_responsible_id']){print "<option selected value=".$row['id_employee'].">".$row['employee_nickname']."</option>";}
                              else {print "<option value=".$row['id_employee'].">".$row['employee_nickname']."</option>";}
                              } 
                              mysqli_free_result($result_emplos);
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Дата старта</label>
                        <div class="col-lg-9">
                          <input type="date" class="form-control" name="task_start_date"  value="<?php echo $row_casetask['task_start_term']?>">
                        </div>
                      </div>
                        <div class="form-group">
                          <label class="control-label col-lg-3" for="tags">Дата окончания</label>
                          <div class="col-lg-9">
                            <input type="date" class="form-control" name="task_end_date"  value="<?php echo $row_casetask['task_end_term']?>">
                          </div>
                        </div>
                        
                        <div class="form-group" <?php echo $hidden?>>
                          <label class="control-label col-lg-3" for="tags"></label>
                          <div class="col-lg-9">
                            <select class='form-control' name='what_id'>
                              <option value="">- выбери что именно -</option>
                              <?php
                              StartDB();
                              PrepareIndependentListsForChoice(); // находится в functions_preparing_data_to_show.php
                                                        // получим выборку $result_whats ;                         
                              EndDB();
                                while($row = mysqli_fetch_assoc($result_whats))	
                                {	  
                                //print_r($row);                            
                                if ($row['id_what']==$row_casetask['what_id']){print "<option selected value=".$row['id_what'].">".$row['what']."</option>";}
                                else {print "<option value=".$row['id_what'].">".$row['what']."</option>";}
                                } 
                                mysqli_free_result($result_whats);
                              ?>
                            </select>
                          </div>
                        </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Кто поставил</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name=""  value="<?php echo $row_casetask['employee_nickname']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Когда поставил</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="" value="<?php echo $row_casetask['date_of_record']?>">
                        </div>
                      </div>

                        <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                        <input type="hidden"  name="task_id" value="<?php echo $id_task?>">
                        <input type="hidden"  name="task_case_id" value="<?php echo $id_task_case?>">

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                        
                        <?php if ($taskstatus==1){?>
                          <button type="submit" class="btn btn-primary">Сохранить исправления</button>
                          <?php }?> 

                          <a type="button" class="btn btn-danger" href="deleting_task.php?task_case_id=<?php echo $id_task_case?>&case_id=<?php echo $id_case?>">Удалить вообще эту задачу</a>
                          
                          </form>
                        </div>
                      </div>  
                  </form>
                </div> <!-- line 10: div class="form quick-post" -->  
                        <!-- нет line 9: div class="padd" -->       
              </div><!-- line 8: class="panel-body" -->
            </div> <!-- line 7: div class="panel panel-default" -->

            
            <!-- для нового блока вставию сюда div class="panel panel-default" -->
          </div> <!-- line 6: portlet -->

          <div class="col-md-8 portlets">
            <!--collapse start-->

            <!--collapse end-->

          </div> <!-- line 5: row-->
        
	      <!-- page end-->
      </section> <!--line 4: section class="wrapper"-->
    </section> <!--line 3: section id="main-content"-->
    <!--main content end-->
    <div class="text-right">
      <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </section> <!-- line 2: section id="container" class="sidebar-closed"-->
  <!-- container section end -->
    
<?php require_once "footer.php"; ?>