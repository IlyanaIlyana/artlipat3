<?php
session_start(); $title = "Artlipat"; 

if(!isset($_SESSION['userid']))
	{		
   /*  print "пошел вон!! <br>";   */  
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php";
require_once "art_view/function_page_header.php"; 
require_once "art_view/functions_showing_data.php"; 
require_once "art_control/functions_selecting_data.php"; 
require_once "art_control/functions_selecting_language.php";

$id_case = $_GET['sent_case_id']; // id дела
$id_account = $_SESSION['useraccountid']; //id аккаунта
//print "id_case=".$id_case."<br>";    

StartDB();

// получаем весь список объектов ИС и юрисдикций $result_ipsubjects;  $result_jurisdictions; 
/* PrepareIndependentListsForChoice(); */ // вызов из файла functions_preparing_data_to_show.php

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

    <?php
     PageHeaderSecondary();
    ?>
    <!--header end-->    

	  <!--main content start-->
    <?php
      $lang= $_SESSION['language'];	
      $lang= 'en';
    
      global $db;
      global $rownew_task;
      global $rowcase_name;
      global $rowtask;
      global $rowwhat;
      global $rowchoose_what;
      global $rowresponsible;
      global $rowselect_responsible;
      global $rowrecord;

      global $rowcase_card;
      global $rowcase_data;
      global $rowip_subject;
      global $rowwhere;
      global $rowour_ref;
      global $rowclient_ref;
      global $rowpatent_office_ref;
      global $rowcase_closed;
      global $rowstart;
      global $rowend;

      StartDB();
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php
      EndDB();
    ?>
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><a href="index.php" >
              <i class="fa fa fa-bars"></i></a>
              <?php echo $rowcase_card['phrase_'.$lang]?>
              <?php if ($row_casedata['not_closed_case']==0):?>
                <span style='color:red'>(<?php echo $rowcase_closed['phrase_'.$lang]?>)</span>
                <?php endif; ?>
            </h3>
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
            <div class="panel panel-default"
            <?php if ($row_casedata['not_closed_case']==0):?>
                style='color:red'
                <?php endif; ?>>
              <div class="panel-heading">
                <h2><strong><?php echo $rowcase_data['phrase_'.$lang]?></strong></h2>
                <div class="panel-actions">
                  <!-- <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a> -->
                  <a style="color: #007aff" href="page_for_case_edit.php?sent_case_id=<?php echo $id_case?> & not_closed=<?php echo $row_casedata['not_closed_case']?>"><i class="fa fa-edit info" ></i></a>
                </div>
              </div>
              <div class="panel-body"> 
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  <form class="form-horizontal" action="" method="post">                  
                      <!-- IP Matter -->
                      <div class="form-group">
                        <label class="control-label col-lg-3"><?php echo $rowip_subject['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['ipsubject_name']?></div>
                        </div>
                      </div>
                      <!-- Jurisdiction -->
                      <div class="form-group">
                        <label class="control-label col-lg-3"><?php echo $rowwhere['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['jurisdiction_name']?></div>
                        </div>
                      </div>  
                      <!-- Nickname -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowour_ref['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['our_case_ref']?></div>
                        </div>
                      </div>
                      <!-- Reference_number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowclient_ref['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <div  class="form-control"> <?php echo $row_casedata['client_case_ref']?></div>
                        </div>
                      </div>
                      <!-- Client's reference number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowpatent_office_ref['phrase_'.$lang]?></label>
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
                          <strong><?php echo $rowcase_closed['phrase_'.$lang]?></strong> 
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

          <div class="col-md-4 portlets"> 
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong><?php echo $rowall_tasks['phrase_'.$lang]?></strong></h2> 
              </div>
              <div class="panel-body">
                <table >  
                <tbody>
                <?php  
                StartDB(); 
                SelectAllTaskOnCaseId($id_case); // находится в functions_selecting_data.php
                EndDB();                                                          
                while($row = mysqli_fetch_assoc($result_casetask))	
                {	                             
                  ?>
                      <tr> 
                        <td> 
                          <a <?php if ($row['task_status'] == 0): ?>
                            style='text-decoration:line-through'<?php endif; ?>
                            href='page_for_case_task.php?sent_case_id=<?php echo $row['case_id']?>
                                   & not_closed=<?php echo $row_casedata['not_closed_case']?>
                                  &sent_task_id=<?php echo $row['task_id']?>
                                  &sent_taskstatus=<?php echo $row['task_status']?>
                                  &sent_task_case_id=<?php echo $row['id_task_case']?>
                                  &sent_our_case_ref=<?php echo $row_casedata['our_case_ref']?>'> 
                              <?php echo $row['task_name']." ".$row['what']." ".$row['where']?>
                            <br>        
                          </a>
                        </td> 
                        <td> 
                        </td> 
                        <td>
                        <?php echo $row['task_end_term']?>
                        </td> 
                      </tr> 
                   
                    <?php
                  }                            
                    mysqli_free_result($result_casetask);
                  ?>
                   </tbody>
                    </table>	      
              </div><!-- line 8: class="panel-body" -->                
            </div> <!-- line 8: div class="panel panel-default" -->  
          </div> <!-- line 6: portlet --> 
        
          <div class="col-md-4 portlets">
            <section class="panel">
              <header class="panel-heading">
                <h2><strong><?php echo $rownew_task['phrase_'.$lang]?></strong></h2> 
              </header>
              <div class="panel-body">

              <form role="form" action="art_control/processing_add_task_to_case_from_case.php" method="post">
                <div class="form-group">
                  <label for="taskid"><?php echo $rowtask['phrase_'.$lang]?>*</label>  
                  <select id='taskid' class="form-control" name="taskid" required>  
                    <option value=""></option> 
                    <?php 
                      StartDB();
                      PrepareIndependentListsForChoice(); 
                      EndDB();  
                        global $result_tasks;
                        global $result_whats;                                                           
                      while($row = mysqli_fetch_assoc($result_tasks))	
                      {	                              
                        print "<option  value=".$row['id_task'].">".$row['task_name']."</option>";
                      }                            
                      mysqli_free_result($result_tasks);
                    ?>	
                  </select> 
                </div>

                <div class="form-group" id="whats" style="display: none">
                  <label for="what"><?php echo $rowwhat['phrase_'.$lang]?></label>   
                  <select class='form-control' name='what_id' id="what" >
                    <option value="">- <?php echo $rowchoose_what['phrase_'.$lang]?> -</option>
                    <?php
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

                <?php
                  // print "SESSION['usersolo']=".$_SESSION['usersolo']."<br>";
                  if ($_SESSION['usersolo'] != 1)
                  {
                  ?> 
                    <div class="form-group">
                      <label for="responsible"><?php echo $rowresponsible['phrase_'.$lang]?></label> 
                      <select class="form-control" name="responsible_id" id="responsible">
                        <option value="">- <?php echo $rowselect_responsible['phrase_'.$lang]?> -</option>  
                        <?php    
                          global $result_emplos;                        
                          while($row = mysqli_fetch_assoc($result_emplos))	
                          {	                              
                            print "<option value=".$row['id_employee'].">".$row['employee_nickname']."</option>";
                          }                            
                          mysqli_free_result($result_emplos);
                        ?>	
                      </select>                    
                    </div>                  
                  <?php
                    }
                  ?> 

                  <div class="form-group">
                  <label for="date1"><?php echo $rowstart['phrase_'.$lang]?></label>  
                  <input id= "date1" type="date" class="form-control" name="start_term" value=<?php echo date('Y-m-d')?>>
                  </div>    
                  
                  <div class="form-group">
                  <label for="date2"><?php echo $rowend['phrase_'.$lang]?></label>  
                  <input id= "date2" type="date" class="form-control" name="end_term" value=<?php echo date('Y-m-d')?>>
                  </div>

                  <input name="case_id" type="hidden" value="<?php echo $id_case?>">

                  <button type="submit" class="btn btn-primary"><?php echo $rowrecord['phrase_'.$lang]?></button>
                </form>  
              </div> 
            </section>
          </div>
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