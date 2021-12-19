<?php
session_start(); $title = "Artlipat"; 

if(!isset($_SESSION['userid']))
	{		
    /* print "пошел вон!! <br>";    */ 
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php"; 
require_once "art_view/function_page_header.php"; 
require_once "art_control/functions_selecting_data.php";	
require_once "art_view/functions_showing_data.php"; 

$id_case = $_GET['sent_case_id']; // id дела
$not_closed = $_GET['not_closed']; // id дела
$id_account = $_SESSION['useraccountid']; //id аккаунта

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

// получаем список ников в данном аккаунте в $result_nicks 
SelectDataOnAccountId(); // вызов из файла functions_preparing_data_to_show.php

EndDB();

//print "id_case=".$id_case."<br>";  
?>
	<!-- container section start -->
	<section id="container" class="sidebar-closed">
    <!--header start-->
    <?php
     PageHeaderSecondary();
    ?>>
    <!--header end-->    

	  <!--main content start-->
    <?php
      $lang= $_SESSION['language'];	
      $lang= 'en';
    
      global $db;
      global $rowcase_det_card;
      global $rowhome;

      global $rowcase_card;
      global $rowcase_data;

      global $rowip_subject;
      global $rowwhere;
      global $rowour_ref;
      global $rowclient_ref;
      global $rowpatent_office_ref;
      global $rowcase_closed;

      global $rowsave_amendment;
      global $rowcase_closing;
      global $rowclose_case;
      global $rowrevive_case;
      global $rowcheck_ref;
      global $rowtype_ref;


      StartDB();
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php
      EndDB();
    ?>
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><a href="index.php" >
              <i class="fa fa fa-square-o"></i></a>
              <?php echo $rowcase_det_card['phrase_'.$lang]?>
              <?php if ($not_closed==0):?>
                <span style='color:red'>(<?php echo $rowcase_closed['phrase_'.$lang]?>)</span>
                <?php endif; ?>
            </h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php"><?php echo $rowhome['phrase_'.$lang]?></a></li>
              <li><i class="fa fa-bars"><a href="page_for_case_card.php?sent_case_id=<?php echo $id_case?>"></i><?php echo $rowcase_card['phrase_'.$lang]?></a></li>
              <li><i class="fa fa-square-o"></i><?php echo $rowcase_det_card['phrase_'.$lang]?></li>
            </ol>
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
                <!-- <div class="panel-actions">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div> -->
              </div>
              <div class="panel-body"> 
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  <form class="form-horizontal" action="art_control/processing_update_case.php" method="post">                  
                      <!-- IP Matter -->
                      <div class="form-group">
                        <label class="control-label col-lg-3"><?php echo $rowip_subject['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <select class="form-control" name="ip_id">
                          <?php
                            while($row = mysqli_fetch_assoc($result_ipsubjects))	
                            {	  
                            //print_r($row);                            
                            if ($row['id_ipsubject']==$row_casedata['id_ipsubject']){print "<option selected value=".$row['id_ipsubject'].">".$row['ipsubject_name']."</option>";}
                            else {print "<option value=".$row['id_ipsubject'].">".$row['ipsubject_name']."</option>";}
                            } 
                            mysqli_free_result($result_ipsubjects);
                           ?>	
                           
                          </select>
                        </div>
                      </div>
                      <!-- Jurisdiction -->
                      <div class="form-group">
                        <label class="control-label col-lg-3"><?php echo $rowwhere['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <select class="form-control" name="jurisdict_id">
                          <!-- <option value="">- Choose Jurisdiction -</option> -->  
                          <?php 
                            while($row = mysqli_fetch_assoc($result_jurisdictions))	
                            {	  
                            //print_r($row);                            
                            if ($row['id_jurisdiction']==$row_casedata['id_jurisdiction']){print "<option selected value=".$row['id_jurisdiction'].">".$row['jurisdiction_name']."</option>";}
                            else {print "<option value=".$row['id_jurisdiction'].">".$row['jurisdiction_name']."</option>";}
                            } 
                            mysqli_free_result($result_jurisdictions);
                           ?>	
                          </select>
                        </div>
                      </div>                     
                      
                      <!-- Nickname -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowour_ref['phrase_'.$lang]?>*</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="nick" id="tags" value="<?php echo $row_casedata['our_case_ref']?>">
                        </div>
                      </div>
                      <!-- Reference_number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowclient_ref['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="clients_ref_number" id="tags" value="<?php echo $row_casedata['client_case_ref']?>">
                        </div>
                      </div>
                      <!-- Client's reference number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags"><?php echo $rowpatent_office_ref['phrase_'.$lang]?></label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="pto_ref_number" id="tags" value="<?php echo $row_casedata['pto_case_ref']?>">
                        </div>
                      </div>

                      
                          <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                        

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" class="btn btn-primary"><?php echo $rowsave_amendment['phrase_'.$lang]?></button>
                          
                        </div>
                      </div>  
                  </form>
                </div> <!-- line 10: div class="form quick-post" -->  
                        <!-- нет line 9: div class="padd" -->       
              </div><!-- line 8: class="panel-body" -->
            </div> <!-- line 7: div class="panel panel-default" -->

            
            <!-- для нового блока вставию сюда div class="panel panel-default" -->
          </div> <!-- line 6: portlet -->
          <div class="col-md-6 portlets"> 

            <div class="panel panel-default" >
              <div class="panel-heading">
                <div class="pull-left"><?php echo $rowcase_closing['phrase_'.$lang]?></div>
                <!-- <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div> -->
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">  
                  <div class="form quick-post"
                  <?php if ($not_closed==0):?>
                    hidden="true"
                  <?php endif; ?>
                  >
                    <form class="form-horizontal" action="art_control/processing_close_case.php" method="post">
                      <button type="submit" class="btn btn-danger">
                      <?php echo $rowclose_case['phrase_'.$lang]?>
                      </button>
                      <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                     </form>
                  </div> <!-- line 10: div class="form quick-post" -->  
                  <div class="form quick-post"
                  <?php if ($not_closed==1):?>
                    hidden="true"
                  <?php endif; ?>>
                     <form class="form-horizontal" action="art_control/processing_restore_case.php" method="post">
                      <button type="submit" class="btn btn-info"><?php echo $rowrevive_case['phrase_'.$lang]?></button>
                      <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                     </form>
                  </div> <!-- line 10: div class="form quick-post" -->
                </div> <!-- line 9: div class="padd" -->
              </div> <!-- line 8: class="panel-body" --> 
            </div> <!-- line 7: div class="panel panel-default" -->

            <div class="panel panel-default" >
              <div class="panel-heading">
                <div class="pull-left"><?php echo $rowcheck_ref['phrase_'.$lang]?></div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">  
                  <div class="form quick-post">
                      <div class="form-group">                        
                        <p><input id="searchtag" size="20" type="text" value="" 
                          class="form-control" placeholder="<?php echo $rowtype_ref['phrase_'.$lang]?>"></p>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th><?php echo $rowour_ref['phrase_'.$lang]?></th>
                              <th><?php echo $rowclient_ref['phrase_'.$lang]?></th>
                              <th><?php echo $rowpatent_office_ref['phrase_'.$lang]?></th>
                            </tr>
                          </thead>
                          <tbody id="searchresult">
                            <?php 
                            StartDB();
                            ShowAllCases();
                            EndDB(); ?>
                          </tbody>
                        </table>  
                      </div>
                     <!-- </form> -->
                  </div> <!-- line 10: div class="form quick-post" -->
                </div> <!-- line 9: div class="padd" -->
              </div> <!-- line 8: class="panel-body" --> 
            </div> <!-- line 7: div class="panel panel-default" -->



          </div> <!-- line 6: portlet -->
          
        
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