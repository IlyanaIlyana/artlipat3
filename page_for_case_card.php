<?php
session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['userid']))
	{		
   /*  print "пошел вон!! <br>";   */  
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "start_mysql.php";
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
                  <a href="page_for_case_details.php?sent_case_id=<?php echo $id_case?>" ><i class="fa fa-edit"></i></a>
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

            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Информация о всех датах и сроках в данном деле</strong></h2>
                <div class="panel-actions">
                  <!-- <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a> -->
                </div>
              </div>

              <div class="panel-body">  
                <!-- <div class="form quick-post">
                  <form class="form-horizontal" action="" method="post"> -->
                      <div class="form-group">
                        <?php  
                          StartDB(); 
                          SelectAllDatesOnCaseId($id_case); // находится в functions_preparong_data_to_show.php
                          EndDB();                                                          
                                while($row = mysqli_fetch_assoc($result_casedates))	
                                {	
                                  if ($row['term_observed']==0){
                                    if ($row['isdeadline']==1){
                                      ?>
                                      <form class="form-horizontal" action="processing_term_observed.php" method="post">
                                      <button type="submit" class="btn"><i class="fa fa-square-o"></i></button>                                 
                                      <a href='page_for_case_date.php?sent_case_id=<?php echo $row['case_id']?>
                                      &sent_date_id=<?php echo $row['date_id']?>
                                      &sent_isdeadline=1
                                      &sent_date_case_id=<?php echo $row['id_date_case']?>
                                      &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'>
                                        <label class='control-label'>  
                                          <?php echo $row['date_name']?>
                                          <?php echo $row['date_on_case']?>
                                        </label> 
                                      </a>
                                      <input type='hidden' name='date_case_id' value=<?php echo $row['id_date_case']?>>
                                      <input type='hidden' name='case_id' value=<?php echo $row['case_id']?>>
                                      </form> 
                                      <?php
                                    }
                                    else {
                                      ?>                              
                                      <a href='page_for_case_date.php?sent_case_id=<?php echo $row['case_id']?>
                                      &sent_date_id=<?php echo $row['date_id']?>
                                      &sent_isdeadline=0
                                      &sent_date_case_id=<?php echo $row['id_date_case']?>
                                      &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'>
                                        <label class='control-label'>  
                                          <?php echo $row['date_name']?>
                                          <?php echo $row['date_on_case']?>
                                        </label><br> 
                                      </a>
                                      <?php 
                                    }
                                  }
                                  else{
                                    ?>
                                    <button type="submit" class="btn "><i class="fa fa-check-square"></i></button>
                                    <a href='page_for_case_date.php?sent_case_id=<?php echo $row['case_id']?>
                                      &sent_date_id=<?php echo $row['date_id']?>
                                      &sent_isdeadline=1
                                      &sent_date_case_id=<?php echo $row['id_date_case']?>
                                      &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'>  
                                    <label class='control-label' style='text-decoration:line-through'> 
                                      <?php echo $row['date_name']?>
                                      <?php echo $row['date_on_case']?></label><br>
                                    <?php
                                    }
                                }                            
                                mysqli_free_result($result_casedates);
                              ?>	
                        <!-- </form> -->
                        <p></p>   
                      </div>
                  <!-- </form>
                </div> --> <!-- line 10: div class="form quick-post" -->  
                        <!-- нет line 9: div class="padd" -->       
              </div><!-- line 8: class="panel-body" -->
            </div> <!-- line 7: div class="panel panel-default" -->
            <!-- для нового блока вставию сюда div class="panel panel-default" -->
          </div> <!-- line 6: portlet -->

          <div class="col-md-8 portlets">
            <!--collapse start-->
            <div class="panel-group m-bot20" id="accordion">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                      Контрольные сроки и выставление задач по данному делу
                    </a>                    
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <?php  
                      StartDB(); 
                      SelectAllActualTermsOnCaseId($id_case); // находится в functions_preparong_data_to_show.php
                      EndDB();                                                          
                      while($row = mysqli_fetch_assoc($result_casedates))	
                      {	
                        ?>
                          <label class="col-lg-8"><?php echo $row['date_name']?></label>
                          <div class="col-lg-4"><?php echo $row['date_on_case']?></div>
                        <?php
                      }                            
                      mysqli_free_result($result_casedates);
                    ?>  
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
                        <!-- </form> -->
                        <p></p>
                        <!-- </form> -->  
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
                      
                    <!-- </div> --> <!-- line 10: div class="form quick-post" -->  
                            <!-- нет line 9: div class="padd" -->       
                  </div><!-- line 8: class="panel-body" -->
                </div> <!-- id="collapseOne" class="panel-collapse collapse in" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <!-- possibility to record terms from here below -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                       Записать срок для подачи первичной заявки  
                      </a>
                  </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>планируемый срок подачи первичной</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="" name="date_to_first_file" type="date" required>
                        </div>
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату</button>
                    </form>
                  </div> <!-- panel body -->
                </div> <!-- id="collapse2" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                       Записать крайний срок подачи выделенной  
                      </a>
                  </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>крайний срок подачи выделенной</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="" name="date_to_divisional_file" type="date" required>
                        </div>
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату</button>
                    </form>
                  </div> <!-- panel body -->
                </div> <!-- id="collapse3" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                      Сроки для заявки с испрашиванием приоритета (конвенционного/внутреннего)
                      </a>
                  </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата самого раннего приоритета</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="priority_date_for_convention" name="priority_date" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 
                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_convention_term_calculated" value = "check_calculated" checked> </span>
                        <label class="control-label col-lg-5">расчетный срок подачи следующей заявки (12 мес)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" type="date" name="convention_term_calculated">
                        </div> 

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_convention_term_client" value = "check_client"> </span>
                          <label class="control-label col-lg-5">срок подачи заявки по инструкциям заявителя</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="convention_term_client" type="date" >
                        </div>                        
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату и контрольный срок</button>

                    </form>
                  </div> <!-- panel body -->
                </div> <!-- line 9: <div id="collapse4" class="panel-collapse collapse"> -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                      Когда местная (RU/EA) заявка наконец-то подана
                      </a>
                  </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">

                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата подачи</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="domestic_filing_date" name="domestic_filing_date" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 

                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_translation_term" value = "check_translation"> </span>
                          <label class="control-label col-lg-5">срок подачи перевода на русский (4 мес)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="translation_term" type="date" >
                        </div>

                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_convention_term" value = "check_convention" checked> </span>
                        <label class="control-label col-lg-5">расчетный срок подачи следующей заявки (12 мес)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" type="date" name="convention_term">
                        </div> 

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_examination_term" value = "check_examination" checked> </span>
                          <label class="control-label col-lg-5">срок подачи ХЭС (36 мес)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="examination_term" type="date" >
                        </div>  

                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="check_first_annuity_term" value = "check_first_annuity" checked> </span>
                          <label class="control-label col-lg-5">срок уплаты первой годовой пошлины (24 мес)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="first_annuity_term" type="date" >
                        </div>                      
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату и контрольные сроки</button>

                    </form>
                  </div> <!-- panel body -->
                </div> <!-- line 9: <div id="collapse5" class="panel-collapse collapse"> -->
              </div> <!-- line 8: div class="panel panel-default" -->


              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                      Нац/рег фаза международной заявки  
                      </a>
                  </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                  
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата самого раннего приоритета</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="priority_date_pct" name="priority_date_pct" type="date" required>
                        </div>
                      </div>

                      <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата международной подачи</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="pct_filing_date" name="pct_filing_date" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_national_phase_date_calculated" value = "checked_calculated" checked> </span>
                          <label class="control-label col-lg-5">срок перехода на нац/рег фазу 31 мес</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="national_phase_date_calculated">
                        </div> 

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_national_phase_date_client" value = "checked_client"> </span>
                          <label class="control-label col-lg-5">инструкции клиента по подаче (выставить произвольный срок)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="national_phase_date_client" type="date" >
                        </div>  

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_pct_amendements_term" value = "checked_pct_amendements" checked> </span>
                          <label class="control-label col-lg-5">срок изменений (1 мес)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="pct_amendements_term">
                        </div>  

                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_pct_translation_term" value = "checked_pct_translation" checked> </span>
                          <label class="control-label col-lg-5">срок подачи перевода (4 мес)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="pct_translation_term">
                        </div>  

                          <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_pct_examination_term" value = "checked_pct_examination" checked> </span>
                          <label class="control-label col-lg-5">срок подчи ХЭС (3 года)</label>
                        <div class="col-lg-6">                          
                           <input class="form-control m-bot15" type="date" name="pct_examination_term">
                        </div> 

                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_pct_annuity_term" value = "checked_pct_annuity" checked> </span>
                          <label class="control-label col-lg-5">срок уплаты первой годовой пошлины (2 года)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="pct_annuity_term">
                        </div>  
                                               
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать и выставить контрольные сроки</button>
                    </form>

                  </div> <!-- panel body -->
                </div> <!-- id="collapse6" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                      Запрос/уведомление экспертизы
                      </a>
                  </h4>
                </div>
                <div id="collapse7" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата запроса/уведомления экспертизы</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="oa_date" name="office_action_date" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 
                        <span class="control-label col-lg-1"> <input type="radio" id="" name="rdue_date_response" value = "2" > </span>
                        <label class="control-label col-lg-5">срок ответа на запрос экспертизы 2 мес</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" type="date" name="due_date_response2">
                        </div>  

                          <span class="control-label col-lg-1"> <input type="radio" id="" name="rdue_date_response" value = "3" checked> </span>
                          <label class="control-label col-lg-5">срок ответа на запрос экспертизы 3 мес</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="due_date_response3">
                        </div> 

                          <span class="control-label col-lg-1"> <input type="radio" id="" name="rdue_date_response" value = "4"> </span>
                          <label class="control-label col-lg-5">срок ответа на запрос экспертизы 4 мес</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="due_date_response4">
                        </div>  

                          <span class="control-label col-lg-1"> <input type="radio" id="" name="rdue_date_response" value = "6"> </span>
                          <label class="control-label col-lg-5">срок ответа на запрос экспертизы 6 мес</label>
                        <div class="col-lg-6">                          
                           <input class="form-control m-bot15" type="date" name="due_date_response6">
                        </div> 

                          <span class="control-label col-lg-1"> <input type="radio" id="" name="rdue_date_response" value = "x"> </span>
                          <label class="control-label col-lg-5">иной срок (указать)</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" name="due_date_response_free" type="date" >
                        </div>                        
                      </div>

                      <div class="form-group">  
                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="chfinal_due_date_response" checked> </span>
                          <label class="control-label col-lg-5">срок ответа на запрос с учетом всех возможных продлений (13 мес)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" name="final_due_date_response" type="date" >
                        </div>
                      </div> 
                      
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать и выставить контрольный срок на отмеченную дату</button>
                    </form>
                    </div> <!-- panel body -->
                </div> <!-- line 9: <div id="collapse7" class="panel-collapse collapse"> -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                      Инструкции клиента   
                      </a>
                  </h4>
                </div>
                <div id="collapse8" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата инструкций</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="" name="instructions_date" type="date" required>
                        </div>
                        <label class="control-label col-lg-6">срок выполнения, указанный клиентом</label>
                        <div class="col-lg-6">
                          <input class="form-control" id="" name="instructions_response_date" type="date">
                        </div>
                      </div>

                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату</button>
                    </form>
                  </div> <!-- panel body -->
                </div> <!-- id="collapse8" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse9">
                      Ответ на запрос/уведомление экспертизы  
                      </a>
                  </h4>
                </div>
                <div id="collapse9" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата ответа</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="" name="response_date" type="date" required>
                        </div>
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату</button>
                    </form>
                  </div> <!-- panel body -->
                </div> <!-- id="collapse9" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse10">
                      Решение экспертизы  
                      </a>
                  </h4>
                </div>
                <div id="collapse10" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата решения экспертизы</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="decision_date" name="decision_date" type="date" required>
                        </div>
                      </div>

                        <span class="control-label col-lg-1"> <input type="radio" id="" name="rdecision" value = "OK" checked> </span>
                        <label class="control-label col-lg-5">хорошее решение</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="empty_date">
                        </div> 

                        <span class="control-label col-lg-1"> <input type="radio" id="" name="rdecision" value = "EA"> </span>
                        <label class="control-label col-lg-5">срок подачи апелляции (4 мес ЕАПВ)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="appeal_date">
                        </div> 

                         <span class="control-label col-lg-1"> <input type="radio" id="" name="rdecision" value = "RU"> </span>
                        <label class="control-label col-lg-5">срок подачи возражения (7 мес Роспатент)</label>
                        <div class="col-lg-6">                          
                          <input class="form-control m-bot15" type="date" name="complain_date">
                        </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать дату</button>
                    </form>
                  </div> <!-- panel body -->
                </div> <!-- id="collapse10" class="panel-collapse collapse" -->
              </div> <!-- line 8: div class="panel panel-default" -->

              

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse11">
                      Уплата пошлин по уведомлению
                      </a>
                  </h4>
                </div>
                <div id="collapse11" class="panel-collapse collapse">
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата получения уведомления о пошлине</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="fee_duty_desision_date" name="fee_duty_desision_date" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 
                        
                          <span class="control-label col-lg-1"> <input type="radio" id="fee_duty_date_2" name="radio_duty_date" value = "2"> </span>
                          <label class="control-label col-lg-5">срок уплаты пошлины 2 месяца</label>
                          <div class="col-lg-6"> 
                            <input class="form-control m-bot15" type="date" name="fee_duty_date_2">
                          </div>  
                        <div id="RU"> 
                            <span class="control-label col-lg-1"> <input type="radio" id="" name="radio_duty_date6" value = "6"> </span>
                            <label class="control-label col-lg-5">срок уплаты пошлины 6 месяцев плюс 50%</label>
                          <div class="col-lg-6">                          
                            <input class="form-control m-bot15" type="date" name="fee_duty_date_6">
                          </div>  

                            <span class="control-label col-lg-1"> <input type="radio" id="" name="radio_duty_date12" value = "12"> </span>
                            <label class="control-label col-lg-5">срок уплаты пошлины 12 месяцев плюс 100%</label>
                          <div class="col-lg-6">                          
                            <input class="form-control m-bot15" type="date" name="fee_duty_date_12">
                          </div>  
                        </div>

                        <div id="group"> 
                            <span class="control-label col-lg-1"> <input type="radio" id="" name="radio_duty_date" value = "4"> </span>
                            <label class="control-label col-lg-5">срок уплаты пошлины 4 месяца</label>
                          <div class="col-lg-6">                          
                            <input class="form-control m-bot15" type="date" name="fee_duty_date_4">
                          </div> 

                            <span class="control-label col-lg-1"> <input type="radio" id="" name="radio_duty_date" value = "free"> </span>
                            <label class="control-label col-lg-5">другой срок</label>
                          <div class="col-lg-6">                          
                            <input class="form-control m-bot15" type="date" name="fee_duty_date_free">
                          </div>
                        </div> 

                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать и выставить контрольный срок на отмеченную дату</button>
                    </form>

                  </div> <!-- panel body -->
                </div> <!-- line 9: <div id="collapse11" class="panel-collapse collapse"> -->
              </div> <!-- line 8: div class="panel panel-default" -->

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse12">
                      Уплата годовых пошлин
                      </a>
                  </h4>
                </div>
                <div id="collapse12" class="panel-collapse collapse">
                  
                  <div class="panel-body">
                    <form class="form-horizontal"  action="processing_add_due_and_dates_to_case.php" method="post">
                      <div class="form-group">
                        <label class="control-label col-lg-6"><i>дата подачи заявки</i></label>
                        <div class="col-lg-6">
                          <input class="form-control" id="start_patent_term" name="start_patent_term" type="date" required>
                        </div>
                      </div>

                      <div class="form-group"> 
                        <span class="control-label col-lg-1"> <input type="checkbox" id="" name="checked_annuity_date" value = "checked_annuity" checked> </span>
                        <label class="control-label col-lg-5">годовая пошлина</label>
                        <div class="col-lg-6"> 
                          <input class="form-control m-bot15" type="date" name="annuity_date">
                        </div>   
                      </div>
                      <input name="case_id" type="hidden" value=<?php echo $id_case?>>
                      <button type="submit" class="btn btn-primary">Записать и выставить контрольный срок на отмеченную дату</button>
                    </form>

                  </div> <!-- panel body -->

                </div> <!-- line 9: <div id="collapse12" class="panel-collapse collapse"> -->
              </div> <!-- line 8: div class="panel panel-default" -->

              

                  

            </div> <!-- line 7: class="panel-group m-bot20" id="accordion"" -->
            <!--collapse end-->


            <?php
            // получаем список ников и сотрудников  в текущем аккаунте (из сессии) $result_nicks и $result_emplos второй раз; 
           // StartDB();  
            //SelectDataOnAccountId();
            //EndDB();
              ?>

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