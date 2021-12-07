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

$id_date_case = $_GET['sent_date_case_id']; 
$id_case = $_GET['sent_case_id']; 
$id_date = $_GET['sent_date_id'];
$isdeadline = $_GET['sent_isdeadline'];
$case_ref = $_GET['sent_our_case_ref']; 

$id_account = $_SESSION['useraccountid']; 

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
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-square-o"></i></a>Карточка срока</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Главная</a></li>
              <li><i class="fa fa-bars"><a href="page_for_case_card.php?sent_case_id=<?php echo $id_case?>"></i>Карточка дела</a></li>
              <li><i class="fa fa-square-o"></i>Карточка срока</li>
            </ol>
          </div>
        </div> <!-- line 5: row-->
        <!-- page start-->
        <div class="row">
          <div class="col-md-4 portlets">            
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2><strong>Детали срока</strong></h2>
                <div class="panel-actions">
                  <!-- <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
                  <a href="#" class="wclose"><i class="fa fa-times"></i></a> -->
                </div>
              </div>
              <div class="panel-body"> 
                <div class="form quick-post">
                  <!-- Case data entering by selection-->
                  <form class="form-horizontal" action="processing_update_date.php" method="post">                  
                    <div class="form-group">  
                      <?php 
                      StartDB(); 
                      SelectThisDateOnCase($id_date_case); // находится в functions_preparong_data_to_show.php
                                                                // получим массив $row_casedate (все данные по этой задаче)
                      EndDB(); 
                      ?>              
                      <p class="col-lg-9">Дело: <?php echo $case_ref?></p>
                      <p class="col-lg-9">Дата: <?php echo $row_casedate['date_name']?></p>
                      <?php if ($row_casedate['term_observed'] == 0 AND $isdeadline==1){?>
                      <p class="col-lg-9">Статус: актуально</p>
                      <?php 
                      }
                      else if ($row_casedate['term_observed'] == 1 AND $isdeadline==1){?>
                        <p class="col-lg-9">Срок соблюден: <?php echo $row_casedate['date_of_closing']?></p>
                        <?php
                      }
                      ?>
                      </p> 
                    </div> 
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Срок</label>
                        <div class="col-lg-9">
                          <input type="date" class="form-control" name="date_on_case"  value="<?php echo $row_casedate['date_on_case']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Кто поставил</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name=""  value="<?php echo $row_casedate['employee_nickname']?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-lg-3" for="tags">Когда поставил</label>
                        <div class="col-lg-9">
                          <input type="text" class="form-control" name="" value="<?php echo $row_casedate['recording_date']?>">
                        </div>
                      </div>

                        <input type="hidden"  name="case_id" value="<?php echo $id_case?>">
                        <input type="hidden"  name="date_id" value="<?php echo $id_date?>">
                        <input type="hidden"  name="date_case_id" value="<?php echo $id_date_case?>">

                      <div class="form-group">
                        <!-- Buttons -->
                        <div class="col-lg-offset-2 col-lg-9">
                          <button type="submit" class="btn btn-primary">Сохранить исправления</button>
                          <?php if ($row_casedate['term_observed'] == 1 AND $isdeadline==1){?>
                            <a type="button" class="btn btn-success" href="restoring_date.php?date_case_id=<?php echo $id_date_case?>&case_id=<?php echo $id_case?>">Восстановить срок</a>
                          <?php 
                          }?>
                          <a type="button" class="btn btn-danger" href="deleting_date.php?date_case_id=<?php echo $id_date_case?>&case_id=<?php echo $id_case?>">Удалить вообще эту дату</a>
                          
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