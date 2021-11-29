<?php session_start();?>
<?php

require_once '../includes/db.php';
require_once '../includes/config.php';
require_once '../includes/generators.php';

ConnectToDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<?=getHeader("About us");?>

<body>
    <?=GetHead();?>
    <?=getNavbar();?>
    Terms
    <?=getFooter();?>
</body>
<?=getBottomScripts();?>

</html>