<?php
session_start(); $title = "Управление делами"; 
if(!isset($_SESSION['userid']))
	{		
   /*  print "пошел вон!! <br>";   */  
    header("Location: https://www.google.ru/"); 
    exit();  
  }
require_once "header.php"; 	
require_once "art_control/functions_selecting_data.php"; 
require_once "art_view/functions_showing_data.php";
?>
    

	  <!-- container section start -->
	  <section id="container" class="sidebar-closed">
    <!--header start-->

    <header class="header dark-bg">
      
      <!--logo start-->
      <a href="index.php" class="logo"><?php echo $_SESSION ['accountname1'] ?><span class="lite"><?php echo $_SESSION ['accountname2'] ?></span></a>
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
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-bars"></i> </a>Список всех дел</h3>
            <!-- <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
              <li><i class="fa fa-bars"></i>Pages</li>
              <li><i class="fa fa-square-o"></i>Pages</li>
            </ol> -->
          </div>
        </div>
        <!-- page start-->
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
                Найти:
              </header>
              <p><input id="searchtag" size="20" type="text" value="" class="form-control" placeholder="начните вводить референс для поиска"></p>
            </section>
            <section class="panel">
              <header class="panel-heading">
                Найдено дел:
              </header>
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
            </section>
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

	
    
<?php require_once "footer.php"; ?>