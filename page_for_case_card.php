<?php
session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['userid']))
	{		
   /*  print "пошел вон!! <br>";   */  
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php";
require_once "functions_preparing_data_to_show.php"; 

$id_case = $_GET['sent_case_id']; // id дела
$id_account = $_SESSION['useraccountid']; //id аккаунта
//print "id_case=".$id_case."<br>";    

StartDB();

// получаем весь список объектов ИС и юрисдикций $result_ipsubjects;  $result_jurisdictions; 
PrepareIndependentListsForChoice(); // вызов из файла functions_preparing_data_to_show.php

// получаем непосредственно массив $row_casedata для данного дела
SelectDataOnCaseId($id_case); // вызов из файла functions_preparing_data_to_show.php

if($row_casedata['account_id'] != $id_account)
	{		
   /*  print "зашел не туда...!! <br>";   */  
    header("Location: page_for_finding_case.php"); 
    exit();  
  }

require_once "header.php"; 	

// получаем список ников и сотрудников  в текущем аккаунте (из сессии) $result_nicks и $result_emplos; 
/* SelectDataOnAccountId(); */
SelectEmployeesOnAccountId();

EndDB();
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
        <a href="index.php" ><img alt="photo" src="art_admin/<?php echo $_SESSION ['userphotourl'] ?>"></a>
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
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-bars"></i></a> Карточка дела</h3>
            <!-- <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-bars"></i>Pages</li>
              <li><i class="fa fa-square-o"></i>Pages</li>
            </ol> -->
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
                 

        <div class="row">
          <div class="col-md-4 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Данные дела</strong></h2>
                <div class="panel-actions">
                  <!-- <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a> -->
                  <a style="color: #007aff" href="page_for_case_details.php?sent_case_id=<?php echo $id_case?>"><i class="fa fa-edit info" ></i></a>
                </div>
              </div>

              <div class="panel-body">                
                
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  <form class="form-horizontal" action="" method="post">                  
                      <!-- IP Matter -->
                      <div class="form-group">
                        <label class="control-label col-lg-3">Объект ИС</label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['ipsubject_name']?></div>
                        </div>
                      </div>
                      <!-- Jurisdiction -->
                      <div class="form-group">
                        <label class="control-label col-lg-3">Где</label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['jurisdiction_name']?></div>
                        </div>
                      </div>  
                      <!-- Nickname -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Наш референс</label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['our_case_ref']?></div>
                        </div>
                      </div>
                      <!-- Reference_number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс клиента</label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['client_case_ref']?></div>
                        </div>
                      </div>
                      <!-- Client's reference number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс ведомства</label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['pto_case_ref']?></div>
                        </div>
                      </div>

                      <?php
                      if ($row_casedata['not_closed_case']==0){
                      ?>
                      <div class="form-group">
                        <div class="alert alert-block alert-danger fade in">
                          <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="icon-remove"></i>
                          </button>
                          <strong>Дело закрыто</strong> 
                        </div>
                      </div>
                      <?php
                      }
                      ?>
                  </form>
                </div> <!-- line 10: div class="form quick-post" -->  
                        <!-- нет line 9: div class="padd" -->       
              </div><!-- line 8: class="panel-body" -->
            </div> <!-- line 7: div class="panel panel-default" -->            
          </div> <!-- line 6: portlet -->

          <div class="col-md-8 portlets"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Все задачи</strong></h2> 
              </div>
              <div class="panel-body">
                <!-- <div class="form quick-post"> -->
                    <!-- <form class="form-horizontal" action="processing_task_done.php" method="post"> -->
                    <?php  
                      StartDB(); 
                      SelectAllTaskOnCaseId($id_case); // находится в functions_preparong_data_to_show.php
                      EndDB();                                                          
                            while($row = mysqli_fetch_assoc($result_casetask))	
                            {	
                              if ($row['task_status']==1){
                              ?>
                              <form class="form-horizontal" action="processing_task_done.php" method="post">
                              <button type="submit" class="btn "><i class="fa fa-square-o"></i></button>                                  
                              <a href='page_for_case_task.php?sent_case_id=<?php echo $row['case_id']?>
                                  &sent_task_id=<?php echo $row['task_id']?>
                                  &sent_taskstatus=1
                                  &sent_task_case_id=<?php echo $row['id_task_case']?>
                                  &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'>
                                <label class='control-label'>--- 
                                <?php echo $row['task_name']." ".$row['what']." ".$row['where']?>--- 
                                <?php echo $row['employee_nickname']?>---
                                <?php echo $row['task_start_term_formatted']?>
                                </label>
                              </a>
                              <input type='hidden' name='task_case_id' value=<?php echo $row['id_task_case']?>>
                              <input type='hidden' name='case_id' value=<?php echo $row['case_id']?>>
                              </form> 
                              <?php
                              }
                              else{
                                ?>
                                <button type="submit" class="btn "><i class="fa fa-check-square"></i></button> 
                                <a href='page_for_case_task.php?sent_case_id=<?php echo $row['case_id']?>
                                    &sent_task_id=<?php echo $row['task_id']?>
                                    &sent_taskstatus=0
                                    &sent_task_case_id=<?php echo $row['id_task_case']?>
                                    &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'> 
                                <label class='control-label' style='text-decoration:line-through'>--- 
                                <?php echo $row['task_name']." ".$row['what']." ".$row['where']?>--- 
                                <?php echo $row['employee_nickname']?>---
                                <?php echo $row['task_start_term_formatted']?></label><br>
                                </a>
                                <?php
                                }
                            }                            
                            mysqli_free_result($result_casetask);
                          ?>	      
              </div><!-- line 8: class="panel-body" -->                
            </div> <!-- line 8: div class="panel panel-default" -->  
          </div> <!-- line 6: portlet -->   
        </div> <!-- line 5: row-->

        <div class="row">  
          <div class="col-lg-4">
            <section class="panel">
              <header class="panel-heading">
                <h2><strong>Новая задача</strong></h2> 
              </header>
              <div class="panel-body">
                <form class="form-inline" action="processing_add_task_to_case.php" method="post">  
                        <div class="panel-body">  
                          <div class="form-group">
                            <div >
                              <select id='taskid' class="form-control" name="taskid" required>                              
                              <option value="">- Новая задача* -</option> 
                              <?php                                                            
                                while($row = mysqli_fetch_assoc($result_tasks))	
                                {	                              
                                  print "<option  value=".$row['id_task'].">".$row['task_name']."</option>";
                                }                            
                                mysqli_free_result($result_tasks);
                              ?>	
                              </select>
                            </div>
                          </div>
                          
                          <div class="form-group"  id="whats" style="display: none">
                            <div >
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
                          <!-- Employee -->
                          <div class="form-group">                            
                            <div >
                              <select class="form-control" name="responsible_id">
                              <option value="">- кто делает -</option>  
                              <?php 
                                /* StartDB();
                                $result9 = mysqli_query($db, $SQL9);
                                EndDB(); */                            
                                while($row = mysqli_fetch_assoc($result_emplos))	
                                {	                              
                                  print "<option value=".$row['id_employee'].">".$row['employee_nickname']."</option>";
                                }                            
                                mysqli_free_result($result_nicks);
                              ?>	
                              </select>
                            </div>
                          </div>
                          <!-- Term -->
                          <div class="form-group">                            
                            <div >
                              
                              <input id= "date1" type="date" class="form-control" name="start_term" value=<?php echo date('Y-m-d')?>><label>начать</label>
                            </div>
                          </div>  
                          <div class="form-group">                            
                            <div >
                            <label>закончить</label><input type="date" class="form-control" name="end_term" value="<?php echo date('Y-m-d')?>">
                              
                            </div>
                          </div>
                          <div class="form-group">
                            <input name="case_id" type="hidden" value="<?php echo $id_case?>">

                            <!-- Buttons -->
                            <div>
                              <button type="submit" class="btn btn-primary">Записать</button>                              
                            </div>
                          </div>
                          </div>
                        </form> 
                      </div> 
                              </section>
        </div> 
        
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