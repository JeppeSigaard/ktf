<?php 
/*
Template name: QR
*/
$redir = get_option('option_qr');
if(!$redir){$redir = 'http://klartilfilm.dk';}
if($redir == ''){$redir = 'http://klartilfilm.dk';}
header('location:'.$redir);
?>