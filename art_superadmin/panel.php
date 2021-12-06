<?php session_start(); $title = "Управление делами"; 

if(!isset($_SESSION['adminid']))
{		
/* print "пошел вон!! <br>";   */  
header("Location: https://www.google.ru/"); 
exit();  
}

//print_r ($_SESSION);

require_once "../header.php"; 
require_once "main.php"; 	
?>
<!--header start-->

    <header class="header dark-bg">
      
      <!--logo start-->
      
      <!--logo end-->      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <span class="profile-ava">
        
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
            <h3 class="page-header"> Технические детали</h3>  
                      
          </div>
        </div> <!-- line 5: row-->
        <!-- page start--> 
        <div class="row">
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
              Список аккаунтов
              </header>                   
                <?php
                StartDB();						
                ShowAllAccounts();
                EndDB(); ?>
            </section>
            <section class="panel">
              <header class="panel-heading">
              Список сотрудников
              </header>                   
              <?php
                StartDB();						
                ShowAllUsers();
                EndDB(); ?>
            </section>

            <section class="panel">
              <header class="panel-heading">
              
              <a href="exit.php">выход</a>
              </header>                   
              
            </section>
          </div>
        </div>  
        <!-- page end-->
      </section> <!--line 4: section class="wrapper"-->
    </section> <!--line 3: section id="main-content"-->
    	
	<?php //print_r ($_SESSION);

require_once "../footer.php"; ?>