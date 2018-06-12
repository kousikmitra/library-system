<?php
function isLoggedIn(){
    if(isset($_SESSION['id'])) {
        if($_SESSION['id'] != "") {
            return true;
        }
    }
    
    return false;
}
?>