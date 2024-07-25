<?php

session_start();

session_desroy();

header("Location: login.php");

exit();
?>