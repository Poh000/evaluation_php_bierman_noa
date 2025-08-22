<?php
session_start();
    function deconnexion()
    {   
        session_destroy();
        sleep(1);
        header('Location: /evaluation_php_bierman_noa/');
    }
    deconnexion();
?>


</html>