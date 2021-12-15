<?php
session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['userid']))
	{		
    /* print "пошел вон!! <br>";  */   
    header("Location: https://www.google.ru/"); 
    exit();  
  }
  
require_once "header.php"; 	
require_once "art_control/functions_selecting_data.php"; 
require_once "art_view/functions_showing_data.php"; 

StartDB(); //вызов из файла start_mysql.php

// получаем список объектов ИС и юрисдикций $result_ipsubjects;  $result_jurisdictions; 
PrepareIndependentListsForChoice(); // вызов из файла functions_preparing_data_to_show.php

// получаем список ников в данном аккаунте в $result_nicks 
SelectDataOnAccountId(); // вызов из файла functions_preparing_data_to_show.php

/* $useraccount_id = $_SESSION['useraccountid'];
$SQL = "SELECT our_case_ref
        FROM cases ca 
        LEFT JOIN employees em 
        ON ca.registrant_id = em.id_employee 
        LEFT JOIN accounts ac 
        ON em.account_id = ac.id_account
        WHERE account_id = $useraccount_id
        "; 
//print $SQL."SQL<br>";
if (!$result_nicks = mysqli_query($db, $SQL)) //6
{
	printf("Ошибка в запросе: %s\n", mysqli_error($db));
} */

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
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-bars"></i></a> Заведение нового дела</h3>
            <!-- <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-bars"></i>Pages</li>
              <li><i class="fa fa-square-o"></i>Pages</li>
            </ol> -->
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
                 

        <div class="row">
          <div class="col-md-6 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Данные для дела</strong></h2>
                <!-- <div class="panel-actions">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div> -->
              </div>

              <div class="panel-body">                
                
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  
                  <form class="form-horizontal" action="processing_add_new_case.php" method="post">
                      <!-- IP Matter -->
                      <div class="form-group">
                        <label class="control-label col-lg-2">Объект ИС</label>
                        <div class="col-lg-10">
                          <select class="form-control" name="ip_id">
                          <option value="">- выбери -</option>  
                          <?php                            
                            while($row = mysqli_fetch_assoc($result_ipsubjects))	
                            {	                              
                              print "<option value=".$row[id_ipsubject].">".$row[ipsubject_name]."</option>";
                            }                            
                            mysqli_free_result($result_ipsubjects);
                           ?>	
                          </select>
                        </div>
                      </div>
                      <!-- Jurisdiction -->
                      <div class="form-group">
                        <label class="control-label col-lg-2">Где/куда</label>
                        <div class="col-lg-10">
                          <select class="form-control" name="jurisdict_id">
                          <option value="">- выбери -</option>  
                          <?php                            
                            while($row = mysqli_fetch_assoc($result_jurisdictions))	
                            {	                              
                              print "<option value=".$row[id_jurisdiction].">".$row[jurisdiction_name]."</option>";
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
                          <input type="text" class="form-control" id="tags" name="nick" required>
                        </div>
                      </div>
                      <!-- Reference_number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс клиента</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="tags" name="clients_ref_number">
                        </div>
                      </div>
                      <!-- Client's reference number -->
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Референс ведомства</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" id="tags" name="pto_ref_number">
                        </div>
                      </div>

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" class="btn btn-primary">Сохранить данные (будет создано новое дело)</button>
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
                <div class="pull-left">Список существующих наших референсов</div>
                <!-- <div class="widget-icons pull-right">
                  <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a>
                </div> -->
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <div class="padd">  
                  <div class="form quick-post">
                    <form class="form-horizontal">
                      <!-- Nickname -->
                      <div class="form-group">
                        <label class="control-label col-lg-4" for="title">Проверь использованные референсы</label>
                        <div class="col-lg-8">
                          <!-- <input type="text" class="form-control" id="title"> -->
                          <select multiple class="form-control m-bot15" name="group">                           
                          <?php                            
                            while($row = mysqli_fetch_assoc($result_nicks))	
                            {	                              
                              print "<option>".$row[our_case_ref]."</option>";
                            }                            
                            mysqli_free_result($result_nicks);
                           ?>	
                          </select>
                          
                        </div>
                      </div>
                     </form>
                  </div> <!-- line 10: div class="form quick-post" -->
                </div> <!-- line 9: div class="padd" -->
              </div> <!-- line 8: class="panel-body" --> 
            </div> <!-- line 7: div class="panel panel-default" -->

          </div> <!-- line 6: portlet -->

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