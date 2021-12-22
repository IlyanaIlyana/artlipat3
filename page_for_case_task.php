<?php
session_start(); $title = "Artlipat"; 

if(!isset($_SESSION['userid']))
	{		
    /* print "пошел вон!! <br>";     */
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php"; 
require_once "art_view/function_page_header.php"; 	
require_once "art_control/functions_selecting_data.php"; 
require_once "art_view/functions_showing_data.php"; 

$id_task_case = $_GET['sent_task_case_id']; // id записи задача-дело
$id_case = $_GET['sent_case_id']; // id дела
$not_closed = $_GET['not_closed'];
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
    <?php
     PageHeaderSecondary();
    ?>
    <!--header end-->    

	  <!--main content start-->
    <?php
      $lang= $_SESSION['language'];	
      $lang= 'en';
    
      global $db;

      global $rowedit_task_card;
      global $rowhome;
      global $rowcase_card;
      global $rowtask_data;
      global $rowcase;
      global $rowcreated_by;
      global $rowcreated_on;      
      global $rowsave_amendment;
      global $rowdelete_task;

      StartDB();
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php
      EndDB();
    ?>
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><a href="index.php" >
              <i class="fa fa fa-square-o"></i></a><?php echo $rowedit_task_card['phrase_'.$lang]?></h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php"><?php echo $rowhome['phrase_'.$lang]?></a></li>
              <li><i class="fa fa-bars"><a href="page_for_case_card.php?sent_case_id=<?php echo $id_case?>"></i><?php echo $rowcase_card['phrase_'.$lang]?></a></li>
              <li><i class="fa fa-square-o"></i><?php echo $rowedit_task_card['phrase_'.$lang]?></li>
            </ol>
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
        <div class="row">
          <div class="col-md-4 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong><?php echo $rowtask_data['phrase_'.$lang]?></strong></h2>
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
                      <p class="col-lg-9"><?php echo $rowcase['phrase_'.$lang]?>: <?php echo $case_ref?>
                      <?php if ($not_closed==0):?>
                        <span style='color:red'>(<?php echo $rowcase_closed['phrase_'.$lang]?>)</span>
                        <?php endif; ?>
                      </p>                      
                      <p class="col-lg-9"><?php echo $rowtask['phrase_'.$lang]?>: <?php echo $row_casetask['task_name'].$row_casetask['what']?></p>
                      </p> 
                    </div> 
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowresponsible['phrase_'.$lang]?></label>
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
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowstart['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <input id="date1" type="date" class="form-control" name="start_term"  value="<?php echo $row_casetask['task_start_term']?>">
                        </div>
                      </div>
                        <div class="form-group">
                          <label class="control-label col-lg-3" for="tags"><?php echo $rowend['phrase_'.$lang]?></label>
                          <div class="col-lg-9">
                            <input type="date" class="form-control" name="end_term"  value="<?php echo $row_casetask['task_end_term']?>">
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
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowcreated_by['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name=""  value="<?php echo $row_casetask['employee_nickname']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowcreated_on['phrase_'.$lang]?></label>
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
                          <button type="submit" class="btn btn-primary"><?php echo $rowsave_amendment['phrase_'.$lang]?></button>
                          <?php }?> 

                          <a type="button" class="btn btn-danger" href="art_control/deleting_task.php?task_case_id=<?php echo $id_task_case?>&case_id=<?php echo $id_case?>"><?php echo $rowdelete_task['phrase_'.$lang]?></a>
                          
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