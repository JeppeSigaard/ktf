<?php 
// vi skal ikke bruger header, men WP's funktionsbibliotek
define('WP_USE_THEMES', false); 

// Vores retur encodes til json, så det er nemt at bruge i javascript.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-Type: application/json');

// Hent wp-load, så vi får mulighed for at bruge wordpress' funktionsarkiv
require '../../../wp-load.php';


// Klargør response array til senere json_encode();
$response = array();

function sendEmail( $from_name, $from, $to, $subject, $message ){
    $header = "From: '.$from_name.' <'.$from.'>\r\n"; 
    $header.= "MIME-Version: 1.0\r\n"; 
    $header.= "Content-Type: text/html; charset=utf-8\r\n"; 
    $header.= "X-Priority: 1\r\n"; 
    $email = wp_mail($to, $subject, $message, $header);
    return $email;
}

if(!isset($_POST['navn']) || $_POST['navn'] == ''){

    $response['error'] = 'Udfyld venligst alle felter';
    echo json_encode($response);
    exit;
}

$navn = wp_strip_all_tags($_POST['navn']);


if(!isset($_POST['email']) || $_POST['email'] == ''){

    $response['error'] = 'Udfyld venligst alle felter';
    echo json_encode($response);
    exit;
}

$email = wp_strip_all_tags($_POST['email']);


$msg_header = '<p>Kære '.$navn.'</p>';
$msg_header .= '<p>Tak for din henvendelse til Klar Til Film. Herunder kan du se de oplsyninger, du har indtastet:</p>';
$msg = '';
foreach($_POST as $key => $value) {
    $field = wp_strip_all_tags($key);
    $val = wp_strip_all_tags($value);
    
    if(!empty($val)){
        
        if($key === 'evt'){
            $msg .= '<p><strong>Besked</strong>:</p>';
            $msg .= apply_filters('the_content',$val);
        }
        else{
            $msg .= '<p>'.$field.': <strong>'.$val.'</strong></p>';
        }
    }
}


$new = wp_insert_post(array(
    'post_type' => 'tilmelding',
    'post_status'   => 'publish',
    'post_title'    => $navn.' den '.date('d. F - Y').' kl.'.date('h:i:s'),
    'post_content'  => $msg,
));

if(is_wp_error($new)){
    
    $response['error'] = 'Kunne ikke oprette ny post';
    echo json_encode($response);
    exit;
    
}

$post_link = get_bloginfo('url').'/wp-admin/post.php?post='.$new.'&action=edit';

$to_sender = sendEmail( 'Klar til film', 'kontakt@klartilfilm.dk', $email, 'Tak for din henvendelse', '<html><body>'.$msg_header.'<br/>'.$msg.'</body><html>');

if(!$to_sender){
    $response['error'] = 'Kunne ikke sende email til modtager';
    echo json_encode($response);
    exit;

}

$to_ktf = sendEmail( $navn, $email, 'kontakt@klartilfilm.dk', 'KOPI: Tak for din henvendelse', '<html><body>'.$msg_header.'<br/>'.$msg.'<br/><br/>Link til email: '.$post_link.'</body><html>');

if(!$to_ktf){
    $response['error'] = 'Kunne ikke sende kopi';
    echo json_encode($response);
    exit;

}

$response['success'] = '<div class="center"><h4>Tak for din henvendelse.</h4><p>Vi vil kontakte dig hurtigst muligt.</p></div>';
echo json_encode($response);
exit;