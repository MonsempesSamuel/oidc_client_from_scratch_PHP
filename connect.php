<?php
// //
echo $_GET['code'];
// //
// // // ----------------------------------------------------------------------
// //
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "http://localhost:8080/auth/realms/Voir-panda/protocol/openid-connect/token",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "grant_type=authorization_code&client_id=app-voir-panda&code=".$_GET['code']."&redirect_uri=http://127.0.0.1/connect.php",
]);

$response = curl_exec($curl);

curl_close($curl);

if (isset(json_decode($response)->error)) {
  echo "Vous n'êtes pas connecté</br>";
  echo "<a href=http://127.0.0.1/index.php>Se connecter !!</a>";
} else {

  echo var_dump(json_decode($response));
  $token = json_decode($response)->access_token;

 // }
// //
// // // ----------------------------------------------------------------------
// //
   echo $token;
// //
// // // ----------------------------------------------------------------------
// //
  $curl2 = curl_init();
  curl_setopt_array($curl2, [
    CURLOPT_URL => "http://localhost:8080/auth/realms/Voir-panda/protocol/openid-connect/userinfo",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "access_token=".$token,
  ]);
  $response = curl_exec($curl2);
  curl_close($curl2);
  if (isset(json_decode($response)->error)) {
    echo "Vous n'êtes pas connecté</br>";
    echo "<a href=http://127.0.0.1/index.php>Se connecter !!</a>";
  } else {
    echo var_dump(json_decode($response));
    echo '<img src="panda.jpg"></br>';

    echo "<a href=http://localhost:8080/auth/realms/Voir-panda/protocol/openid-connect/logout?redirect_uri=http://127.0.0.1/index.php>Je veux me déconnecter!!</a>";
  }
}
?>
