<?php session_start(); $title = "Artlipat"; 

if(!isset($_SESSION['userid']))
{		
print "пошел вон!! <br>";    
header("Location: https://www.google.ru/"); 
exit();  
}

//print_r ($_SESSION);

require_once "../header.php"; 
require_once "main.php"; 
require_once "../art_control/functions_selecting_language.php";	
?>
<!--header start-->

    <header class="header dark-bg">
      
      <!--logo start-->
      <a href="../index.php" class="logo"><?php echo $_SESSION ['accountname1'] ?> <span class="lite"><?php echo $_SESSION ['accountname2'] ?></span></a>
      <!--logo end-->      

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <span class="profile-ava">
        <a href="../index.php" ><img alt="photo" src="<?php echo $_SESSION ['userphotourl'] ?>"></a>
        </span>
        
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->  

    <!--main content start-->
    <?php
      $lang= $_SESSION['language'];	
      $lang= 'en';

      StartDB();
      SelectTranslationPageMainContent($lang); //kept in art_control/functions_selecting_language.php
      EndDB();
    ?>
	  <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"> <?php echo $rowteam['phrase_'.$lang]?></h3>  
                      
          </div>
        </div> <!-- line 5: row-->
        <!-- page start--> 
        <div class="row">
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
              <?php echo $rowlist_of_persons['phrase_'.$lang]?>
              </header>                   
                <?php
                StartDB();						
                ShowUsers();
                EndDB(); ?>
            </section>
            <section class="panel">
              <header class="panel-heading">
              <?php echo $rowadd_new_person['phrase_'.$lang]?>
              </header>                   
              <div class="panel-body">
                <form action="processing_reg_user.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="<?php echo $rowperson_name['phrase_'.$lang]?>*" required>
                </div>
                <div class="form-group">
                    <p class="help-block"><?php echo $rowphoto_in_profile['phrase_'.$lang]?> (jpg):</p>  
                    <input class="btn btn-primary" type="file" name="uploadfile">
                </div>
                <button name="register" type="submit" class="btn btn-primary"><?php echo $rowadd_new_person['phrase_'.$lang]?></button>
                </form>
             </div>
            </section>
          </div>
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
              <?php echo $rowchange_company_name['phrase_'.$lang]?>
              </header>                   
                <?php
                StartDB();						
                ShowCompanyName();
                EndDB(); ?>
            </section>
          </div>
        </div>  
        <!-- page end-->
      </section> <!--line 4: section class="wrapper"-->
    </section> <!--line 3: section id="main-content"-->
	<?php
	



require_once "../footer.php"; ?>