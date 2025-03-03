<?php
include "../config/api/myfunctions.php";
if(isset($_SESSION['auth']))
{
    if($_SESSION['role_as'] == 0)
    {
        redirect("../admin/index.php", "You are not authorized to access this page");
    }
}
else
{
    redirect("../register.php", "Login to continue");
}
?>