<?php

// Cek from cookie and session, then clear
session_start();
session_destroy();

setcookie("email", "", time() - 3600);

header("Location: loginForm.php");
