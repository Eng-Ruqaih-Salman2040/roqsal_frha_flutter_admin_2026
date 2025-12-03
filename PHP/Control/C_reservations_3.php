<?php

    include ('../Model/M_reservations.php');
    $M_reservations = new M_reservations();
    @$Display = $M_reservations->Read_Data_status3();
    
    include('../View/reservations_3/index.php');