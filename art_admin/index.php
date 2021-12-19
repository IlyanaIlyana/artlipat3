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
              Список сотрудников
              </header>                   
                <?php
                StartDB();						
                ShowUsers();
                EndDB(); ?>
            </section>
            <section class="panel">
              <header class="panel-heading">
              Добавить нового сотрудника
              </header>                   
              <div class="panel-body">
                <form action="processing_reg_user.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input name="username" type="text" class="form-control" placeholder="Публичное имя*" required>
                </div>
                <div class="form-group">
                    <p class="help-block">фото в профиле (jpg):</p>  
                    <input class="btn btn-primary" type="file" name="uploadfile">
                </div>
                <button name="register" type="submit" class="btn btn-primary">Добавить сотрудника в базу</button>
                </form>
             </div>
            </section>
          </div>
          <div class="col-sm-6">
            <section class="panel">
              <header class="panel-heading">
              Изменить название фирмы
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