<?php

       include ('../Model/M_Dashboard.php');
    $M_Dashboard = new M_Dashboard();
   @$NumberOf_Users = $M_Dashboard->NumberOf_Users();
   @$NumberOf_shop = $M_Dashboard->NumberOf_shop();
   @$NumberOf_customers = $M_Dashboard->NumberOf_customers();
   @$NumberOf_reservations = $M_Dashboard->NumberOf_reservations();
   @$NumberOf_reservations1 = $M_Dashboard->NumberOf_reservations1();
   @$NumberOf_reservations2 = $M_Dashboard->NumberOf_reservations2();
   @$NumberOf_reservations3 = $M_Dashboard->NumberOf_reservations3();

    
   // @$NumberOfusers = 1;
    
    include '../View/Dashboard.php';  
    ?>

