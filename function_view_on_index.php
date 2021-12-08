<?php

function ShowFirstPage() 
// вызывается из  файла function_control_view_login_on_index.php
// сама вызывает несколько функций: 
// ShowTabs() ShowAllCasesToWorkOn() ShowTabsContent()  из functions_showing_data.php
// ShowAllTerms() убрала 
// которые расположены в файле functions_showing_data.php
{
  ?>

	<!-- container section start -->
	<section id="container" class="">
    <!--header start-->

    <header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo"><?php echo $_SESSION ['accountname1'] ?> <span class="lite"><?php echo $_SESSION ['accountname2'] ?></span></a>
      <!--logo end-->
      
      <div class="nav search-row" id="top_menu">

        <!--  search form start -->
        <!-- <ul class="nav top-menu">
          <li>
            <form class="navbar-form">
              <input class="form-control" placeholder="Search" type="text">
            </form>
          </li>
        </ul> -->
        <!--  search form end -->

      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->          
          <!-- task notificatoin end -->
          
          <!-- user login dropdown start-->
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="profile-ava">                                
                    <img alt="photo" src="art_admin/<?php echo $_SESSION ['userphotourl'] ?>">
                </span>
                <span class="username"><?php echo $_SESSION ['username'] ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li>
                <a href="art_control/exit.php"><i class="icon_key_alt"></i> Выход из сервиса</a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="page_for_finding_case.php">
                <i class="icon_genius"></i>
                <span>Поиск дела</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="page_for_new_case.php" class="">
              <i class="icon_document_alt"></i><span>Новое дело</span>
              <!-- <span class="menu-arrow arrow_carrot-right"></span> -->
            </a>
          </li>
          
          <?php
          //print "SESSION['userlevel']=".$_SESSION['userlevel']."<br>";
          if ($_SESSION['userlevel'] >= 9)
          {
          ?>
          <li class="">
            <a class="" href="art_admin/index.php">
                <i class="icon_house_alt"></i>
                <span>Настройки</span>
            </a>
          </li> 
          <?php        
          }  
          ?>

        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->

	  <!--main content start-->
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><!-- <i class="fa fa fa-bars"></i> --> </h3>
            <!-- <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-bars"></i>Pages</li>
              <li><i class="fa fa-square-o"></i>Pages</li>
            </ol> -->
          </div>
        </div>
        <!-- page start--> 
        <div class="row">  
          <div class="col-lg-4">
            <section class="panel">
              <header class="panel-heading">
                <h2><strong>Новая задача</strong></h2> 
              </header>
              <div class="panel-body">
                <form role="form" action="processing_add_task_to_case.php" method="post">
                  
                  <div class="form-group">
                    <label for="casenick">Название дела</label>
                    <input class="form-control" id="casenick">  
                  </div>  

                  <div class="form-group">
                  <label for="task">Задача</label>  
                  <select id='task' class="form-control" name="taskid" required>  
                    <option value="">- Новая задача* -</option> 
                        <?php                                                            
                          /* while($row = mysqli_fetch_assoc($result_tasks))	
                          {	                              
                            print "<option  value=".$row['id_task'].">".$row['task_name']."</option>";
                          }                            
                          mysqli_free_result($result_tasks); */
                        ?>	
                    </select> 
                  </div>

                  <div class="form-group" id="whats" style="display: none">
                  <label for="what">что</label>   
                  <select class='form-control' name='what_id' id="what" >
                      <option value="">- выбери что именно -</option>
                        <?php
                          /* StartDB();
                          PrepareIndependentListsForChoice(); // находится в functions_preparing_data_to_show.php
                                                    // получим выборку $result_whats ;                         
                          EndDB();
                            while($row = mysqli_fetch_assoc($result_whats))	
                            {	  
                            //print_r($row);                            
                            if ($row['id_what']==$row_casetask['what_id']){print "<option selected value=".$row['id_what'].">".$row['what']."</option>";}
                            else {print "<option value=".$row['id_what'].">".$row['what']."</option>";}
                            } 
                            mysqli_free_result($result_whats); */
                        ?>
                    </select>
                  </div>

                  <?php
                    // print "SESSION['usersolo']=".$_SESSION['usersolo']."<br>";
                    if ($_SESSION['usersolo'] != 1)
                    {
                    ?>                  
                  <div class="form-group" id="responsibles">
                  <div class="form-group">
                  <label for="responsible">Кто делает</label> 
                  <select class="form-control" name="responsible_id" id="responsible">
                              <option value="">- кто делает -</option>  
                              <?php                           
                            /*     while($row = mysqli_fetch_assoc($result_emplos))	
                                {	                              
                                  print "<option value=".$row['id_employee'].">".$row['employee_nickname']."</option>";
                                }                            
                                mysqli_free_result($result_nicks); */
                              ?>	
                              </select>                    
                  </div>
                  </div>  
                  
                  <?php
                    }
                   ?> 

                  <div class="form-group">
                  <input name="case_id" type="hidden" value="<?php echo $id_case?>">  
                  </div>                
                                    
                  <button type="submit" class="btn btn-primary">Записать</button>
                </form>
              </div>
            </section>
          </div>

          <div class="col-lg-8">

            <?php
            // print "SESSION['usersolo']=".$_SESSION['usersolo']."<br>";
            if ($_SESSION['usersolo'] == 1)
            {
            ?>

            <section class="panel">
              <header class="panel-heading">
                Responsive tables
              </header>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Table heading</th>
                      <th>Table heading</th> 
                      <th>Table heading</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <form action="#" method="get" accept-charset="utf-8">
                          <div class="checkboxes">
                            <label class="label_check" for="checkbox-01">
                              <input name="sample-checkbox-01" id="checkbox-01" value="1" type="checkbox" checked />                               
                            </label>
                          </div>
                        </form>
                      </td>
                      <td>I agree to the terms &#38; conditions.</td>
                      <td>Table cell</td>
                      <td>Table cell</td>                      
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                      <td>Table cell</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section> 
            <?php            
            }

            else{
            ?>
            <section class="panel">  
              <header class="panel-heading tab-bg-primary ">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#total">Все задачи</a>
                  </li>
                  <!--дальше вкладки с отсылками должны выводится согласно списку сотрудников-->
                  <?php ShowTabs() ?>
                  <!--вкладки должны выводится до сюда-->
                  <li class="">
                    <a  href="art_admin/index.php">новый</a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="total" class="tab-pane active">                                
                    <div class="row">                    
                      <div class="col-sm-12">
                        <section class="panel">
                          <header class="panel-heading">
                            <h2><strong>Актуальные задачи</strong></h2>                
                          </header>                          
                          <div class="table-responsive">
                            <table class="table">                          
                              <tbody>
                                  <?php ShowAllCasesToWorkOn(1) ?>
                              </tbody>
                            </table>
                          </div>
                          <header class="panel-heading">
                            <h2><strong>Запланированные задачи</strong></h2>                
                          </header>
                          <div class="table-responsive">
                            <table class="table">                          
                              <tbody>
                                  <?php ShowAllCasesToWorkOn(2) ?>
                              </tbody>
                            </table>
                          </div>
                        </section>
                      </div>
                    </div> 
                  </div>
                  <!--а здесь должны формироваться id дива и задачи для каждого из сотрудников-->
                  <?php ShowTabsContent()?>                
                  <!--здесь конец формирования задач для каждого из сотрудников-->
                </div>
              </div>
            </section>
            <?php            
            }?>
          </div>          
        </div>
	      <!-- page end-->
      </section>

    </section>
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
  </section>
  <!-- container section end -->

	
	<?php	
}