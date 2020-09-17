<?php
header('Content-Type: application/json');
include('../../wp-config.php');
$response = array();
global $wpdb;
$resp=array();


    $p_url = 'dsgsdg';
    $email = "fdsfsd";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://demo12.mediatrenz.com/paysfer/connect_api/v1/add_products.php");
curl_setopt($ch, CURLOPT_POST, 0);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
    'X-Apple-Tz: 0',
    'X-Apple-Store-Front: 143444,12',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    'Accept-Encoding: gzip, deflate',
    'Accept-Language: en-US,en;q=0.5',
    'Cache-Control: no-cache',
    'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
    'Host: http://demo12.mediatrenz.com',
    // 'Referer: http://demo12.mediatrenz.com/paysfer/connect_api/v1', //Your referrer address
    'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
    'X-MicrosoftAjax: Delta=true'
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;







//     $curl = curl_init();
// $username = urlencode($p_url);
// $password = urlencode($email);
// $dd = array('username' => $username,'password' => $password);
// curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://demo12.mediatrenz.com/paysfer/connect_api/v1/add_products.php",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_SSL_VERIFYPEER => false,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "username=$username&password=$password",
//   CURLOPT_HTTPHEADER => array(
//     "content-type: application/x-www-form-urlencoded",
//     // "x-api-key: your-api-key",
//   ),
// ));
// // $response = curl_exec($curl);
// $response = json_encode($dd);
// $err = curl_error($curl);
// curl_close($curl);
// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }




    
//     $post_array = array(
//         'appkey' => 'XBnKaywRCrj05m-XXX-v6DXuZ3FFkUgiw45',
//         'domain' => 'https://api-site.com',
//         'product_url' => $p_url,
//         'email' => $email,
//         'review_content' => 'message',
//         'review_title' => 'title',
//         'review_score' => 'star_rating_value'
//     );
//     postReview($post_array);

// function postReview($post_array){
//     $curl = curl_init();
//     curl_setopt($curl, CURLOPT_POST, 1);
//     curl_setopt($curl, CURLOPT_POSTFIELDS, $post_array);
//     curl_setopt($curl, CURLOPT_URL, 'https://demo12.mediatrenz.com/paysfer/connect_api/v1/auth');
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    
//     $result = curl_exec($curl);
//     if(!$result){die("Connection Failure");}
//     curl_close($curl);
//     echo $result;
// }







    // $username='45345556';
    // $password='rtge5645645errt4';
    // $url = "https://demo12.mediatrenz.com/paysfer/connect_api/v1/Products";

    // $curl = curl_init();
    // $auth_data = array(
    //     'client_id'         => $username,
    //     'client_secret'     => $password,
    //     'grant_type'        => 'client_credentials'
    // );
    // curl_setopt($curl, CURLOPT_POST, 1);
    // curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // $result = curl_exec($curl);
    // print($result);die;
    // if(!$result){die("Connection Failure");}
    // curl_close($curl);
    // echo $result;


    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_USERPWD, "$username:$username");
    // $header = array(
    // 'Accept: application/json',
    // 'Content-Type: application/x-www-form-urlencoded',
    // 'Authorization: Basic '. base64_encode("$username:$username")
    // );
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // $output = curl_exec($ch);
    // $info = curl_getinfo($ch);
    // $info1 = json_encode($info);
    // print_r($info1);die;
    // curl_close($ch);

    // $api_key='45345556';
    // $password='rtge5645645errt4';
    // // $api_key='313131313131313311';
    // // $password='hvdwftyt21e673yudgbwufbduywuueugfufuuj';
    // //$url = "https://$yourdomain.freshdesk.com/api/v2/tickets/".$job_id."/reply";
    // $url = "https://demo12.mediatrenz.com/paysfer/connect_api/v1";


    // // $url = "https://api.paysfer.com/channeladvisor/products?groupFields={}&buyableFields={}";
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_HEADER, true);
    // curl_setopt($ch, CURLOPT_USERPWD, "$api_key:$password");
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $server_output = curl_exec($ch);
    // // print_r($server_output);
    // $info = curl_getinfo($ch);
    // //print_r($info);

    // $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    // $headers = substr($server_output, 0, $header_size);
    // $response_encode = substr($server_output, $header_size);
    // print_r($response_encode);
    // $response_decode=json_decode($response_encode);

    // print_r($response_decode);die;
    // if (!empty($response_decode)) { 
        
    // }else{
    //     echo "No data found";
    // }

    // curl_close($ch);
?>