<?php
session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['userid']))
	{		
    /* print "пошел вон!! <br>";    */ 
    header("Location: https://www.google.ru/"); 
    exit();  
  }

require_once "art_control/start_mysql.php"; 
require_once "art_control/functions_selecting_data.php";	
require_once "art_view/functions_showing_data.php"; 

$id_case = $_GET['sent_case_id']; // id дела
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
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-square-o"></i></a>Карточка данных дела</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Главная</a></li>
              <li><i class="fa fa-bars"><a href="page_for_case_card.php?sent_case_id=<?php echo $id_case?>"></i>Карточка дела</a></li>
              <li><i class="fa fa-square-o"></i>Карточка данных дела</li>
            </ol>
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
        <div class="row">
          <div class="col-md-4 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Детали данных дела</strong></h2>
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
                        <label class="control-label col-lg-2">Объект ИС</label>
                        <div class="col-lg-10">
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
                        <label class="control-label col-lg-3">Где</label>
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
                        <label class="control-label col-lg-3" for="tags">Наш референс*</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="nick" id="tags" value="<?php echo $row_casedata['our_case_ref']?>">
                        </div>
                      </div>
                      <!-- Reference_number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс клиента</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="clients_ref_number" id="tags" value="<?php echo $row_casedata['client_case_ref']?>">
                        </div>
                      </div>
                      <!-- Client's reference number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс ведомства</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="pto_ref_number" id="tags" value="<?php echo $row_casedata['pto_case_ref']?>">
                        </div>
                      </div>

                      
                          <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                        

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" class="btn btn-primary">Сохранить исправления</button>
                          
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
                <div class="pull-left">Закрытие дела</div>
                <!-- <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div> -->
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">  
                  <div class="form quick-post">
                    <form class="form-horizontal" action="art_control/processing_close_case.php" method="post">
                      <button type="submit" class="btn btn-danger">Закрыть дело</button>
                      <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                     </form>
                  </div> <!-- line 10: div class="form quick-post" -->  
                  <div class="form quick-post">
                     <form class="form-horizontal" action="art_control/processing_restore_case.php" method="post">
                      <button type="submit" class="btn btn-info">Восстановить закрытое в делопроизводство</button>
                      <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                     </form>
                  </div> <!-- line 10: div class="form quick-post" -->
                </div> <!-- line 9: div class="padd" -->
              </div> <!-- line 8: class="panel-body" --> 
            </div> <!-- line 7: div class="panel panel-default" -->

            <div class="panel panel-default" >
              <div class="panel-heading">
                <div class="pull-left">проверка референсов</div>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">  
                  <div class="form quick-post">
                      <div class="form-group">                        
                        <p><input id="searchtag" size="20" type="text" value="" class="form-control" placeholder="начните вводить референс для поиска"></p>
                        <table class="table table-hover">
                          <thead>
                            <tr>
                              <th>наш референс</th>
                              <th>референс клиента</th>
                              <th>референс в ведомстве</th>
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