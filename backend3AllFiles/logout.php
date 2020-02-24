<?php 
session_start();
session_destroy();
echo 'You have been logged out. <a href="/backend3">Go back</a>';
?>