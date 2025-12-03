<?php

       include ('../Model/M_Dashboard.php');
    $M_Dashboard = new M_Dashboard();
   @$NumberOf_Users = $M_Dashboard->NumberOf_Users();
   @$NumberOf_shop = $M_Dashboard->NumberOf_shop();
    
   // @$NumberOfusers = 1;
    
    include '../View/Dashboard.php';  

