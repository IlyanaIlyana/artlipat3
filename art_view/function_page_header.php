<?php

require_once "art_control/functions_selecting_language.php";

function PageHeader() {

  global $rowlog_out;
 
  $lang= $_SESSION['language'];	
 
/*   StartDB(); */	
  SelectTranslationPagesFrame($lang); //kept in art_control/functions_selecting_language.php
  /* EndDB(); */

    ?>
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
                <a href="art_control/exit.php"><i class="icon_key_alt"></i>
                  <?php echo $rowlog_out['phrase_'.$lang]?></a>
              </li>
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header>
    <!--header end-->
    <?php
}

function PageHeaderSecondary() {
    ?>
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
    <?php
}