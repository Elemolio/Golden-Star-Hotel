<?php
session_start();
session_unset();
session_destroy();
header("Location: Frm_login_Cajero.html");
exit();
?>