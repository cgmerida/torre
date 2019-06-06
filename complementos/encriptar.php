<?php 
function encryptIt( $q ) {
    return password_hash($q, PASSWORD_DEFAULT);
}
?>