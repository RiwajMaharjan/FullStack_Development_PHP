<?php

session_set_cookie_params([
    'secure' => false, 
    'httponly' => true, 
    'samesite' => 'Lax'         
]);

session_start();