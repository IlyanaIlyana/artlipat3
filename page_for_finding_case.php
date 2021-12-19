<?php
session_start(); $title = "Artlipat"; 
if(!isset($_SESSION['userid']))
	{		
   /*  print "пошел вон!! <br>";   */  
    header("Location: https://www.google.ru/"); 
    exit();  
  }
require_once "header.php"; 	
require_once "art_view/function_page_header.php"; 
require_once "art_control/functions_selecting_data.php"; 
require_once "art_view/functions_showing_data.php";
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

      global $rowcases;
      global $rowsearch;
      global $rowsearched;

      StartDB();
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php
      EndDB();
    ?>
	<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><a href="index.php" ><i class="fa fa fa-bars"></i> </a><?php echo $rowcases['phrase_'.$lang]?></h3>
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
              <?php echo $rowsearch['phrase_'.$lang]?>:
              </header>
              <p><input id="searchtag" size="20" type="text" value="" class="form-control" placeholder="<?php echo $rowtype_ref['phrase_'.$lang]?>"></p>
            </section>
            <section class="panel">
              <header class="panel-heading">
              <?php echo $rowsearched['phrase_'.$lang]?>:
              </header>
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