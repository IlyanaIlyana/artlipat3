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
    <?php
    PageHeader();
    

    $lang= $_SESSION['language'];	
    $lang= 'en';	 

    global $rowsearch_case;
    global $rownew_case;
    global $rowteam;
    
    /*   StartDB(); */	
    SelectTranslationPagesFrame($lang); //kept in art_control/functions_selecting_language.php
    /* EndDB(); */
    ?>

    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="">
            <a class="" href="page_for_finding_case.php">
                <i class="icon_genius"></i>
                <span><?php echo $rowsearch_case['phrase_'.$lang]?></span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="page_for_new_case.php" class="">
              <i class="icon_document_alt"></i><span><?php echo $rownew_case['phrase_'.$lang]?></span>
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
                <span><?php echo $rowteam['phrase_'.$lang]?></span>
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
    <?php
      global $rownew_task;
      global $rowcase_name;
      global $rowtask;
      global $rowwhat;
      global $rowchoose_what;
      global $rowresponsible;
      global $rowselect_responsible;
      global $rowrecord;
      global $rowmy_tasks;
      global $rowactulal_tasks;
      global $rowhide_completed;
      global $rowplanned;
      global $rowall_tasks;
      global $rownew;
	
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php

    ?>
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
                <h2><strong><?php echo $rownew_task['phrase_'.$lang]?></strong></h2> 
              </header>
              <div class="panel-body">
                <form role="form" action="art_control/processing_add_task_to_case.php" method="post">
                  
                  <div class="form-group">                  
                    <div class="ui-widget">
                    <div  >
                      <label for="autocomplete"><?php echo $rowcase_name['phrase_'.$lang]?>*</label>  
                      <input id="autocomplete" class="form-control" name="casenick" required> 
                    </div> 
                    </div>                   
                  </div>  

                  <div class="form-group">
                  <label for="taskid"><?php echo $rowtask['phrase_'.$lang]?>*</label>  
                  <select id='taskid' class="form-control" name="taskid" required>  
                    <option value=""></option> 
                        <?php 
                          PrepareIndependentListsForChoice();  
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
                  <div class="form-group" id="responsibles">
                  <div class="form-group">
                  <label for="responsible"><?php echo $rowresponsible['phrase_'.$lang]?></label> 
                  <select class="form-control" name="responsible_id" id="responsible">
                    <option value="">- <?php echo $rowselect_responsible['phrase_'.$lang]?> -</option>  
                      <?php    
                        global $result_emplos; 
                        
                        SelectEmployeesOnAccountId();
                                               
                        while($row = mysqli_fetch_assoc($result_emplos))	
                        {	                              
                          print "<option value=".$row['id_employee'].">".$row['employee_nickname']."</option>";
                        }                            
                        mysqli_free_result($result_emplos);
                      ?>	
                    </select>                    
                  </div>
                  </div>  
                  
                  <?php
                    }
                  ?>                
                                    
                  <button type="submit" class="btn btn-primary"><?php echo $rowrecord['phrase_'.$lang]?></button>
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
                <?php echo $rowmy_tasks['phrase_'.$lang]?>                
              </header>
              <form action="art_control/processing_hide_done.php" method="post">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th colspan="2"><?php echo $rowactulal_tasks['phrase_'.$lang]?>                       
                        </th>
                        <th colspan="2">
                        <input type="submit" value="<?php echo $rowhide_completed['phrase_'.$lang]?>" class="btn-primary" 
                        <?php if (NoTasksDoneNotHidden()): ?>
                          hidden="true"<?php endif; ?> 
                        id="hidden_button"/>  
                        </th>                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      ShowCasesToWorkOnForPerson($_SESSION['userid'], 1)?>                     
                    </tbody>
                  
                    <thead>
                      <tr>
                        <th colspan="4"><?php echo $rowplanned['phrase_'.$lang]?></th>                      
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      ShowCasesToWorkOnForPerson($_SESSION['userid'], 2)?>                     
                    </tbody>
                  </table>
                </div>
              </form>  
            </section> 
            <?php            
            }

            else{
            ?>
            <section class="panel">  
              <header class="panel-heading tab-bg-primary ">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a data-toggle="tab" href="#total"><?php echo $rowall_tasks['phrase_'.$lang]?></a>
                  </li>
                  <!--дальше вкладки с отсылками должны выводится согласно списку сотрудников-->
                  <?php ShowTabs() ?>
                  <!--вкладки должны выводится до сюда-->
                  <li class="">
                    <a  href="art_admin/index.php"><?php echo $rownew['phrase_'.$lang]?></a>
                  </li>
                </ul>
              </header>
              <div class="panel-body">
                <div class="tab-content">
                  <div id="total" class="tab-pane active">                                
                    <div class="row">                    
                      <div class="col-sm-12">
                        <section class="panel">                          
                          <form action="art_control/processing_hide_done.php" method="post">                          
                            <div class="table-responsive">
                              <table class="table">                          
                                <thead>
                                  <tr>
                                    <th colspan="3"><?php echo $rowactulal_tasks['phrase_'.$lang]?> </th>  
                                    <th colspan="2">
                                      <input type="submit" value="<?php echo $rowhide_completed['phrase_'.$lang]?>" class="btn-primary" 
                                        <?php if (NoTasksDoneNotHidden()): ?>
                                        hidden="true"<?php endif; ?> 
                                        id="hidden_button"/>  
                                    </th>                      
                                  </tr>
                                </thead>  
                                <tbody>
                                    <?php ShowAllCasesToWorkOn(1) ?>
                                </tbody>

                                <thead>
                                  <tr>
                                    <th colspan="5"><?php echo $rowplanned['phrase_'.$lang]?></th>                      
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php ShowAllCasesToWorkOn(2) ?>
                                </tbody>
                              </table>
                            </div>
                          </form>
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