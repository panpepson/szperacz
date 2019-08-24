<?php

//$curl = curl_init('https://api-v3.mojepanstwo.pl/dane/krs_podmioty.json?conditions%5Bkrs_podmioty.gmina_id%5D=2315&limit=125&page=1&callbacks=1&maxLimit=125&paramType=querystring&aggs%5Btyp_id%5D%5Bterms%5D%5Bfield%5D=krs_podmioty.plec&aggs%5Btyp_id%5D%5Bterms%5D%5Binclude%5D%5Bpattern%5D=%28K%7CM%29&aggs%5Btyp_id%5D%5Baggs%5D%5Blabel%5D%5Bterms%5D%5Bfield%5D=krs_podmioty.plec&_type=objects');
//$curl = curl_init('https://api-v3.mojepanstwo.pl/dane/krs_podmioty.json?conditions%5Bkrs_podmioty.gmina_id%5D=2315&page=1&callbacks=1&paramType=querystring&aggs%5Btyp_id%5D%5Bterms%5D%5Bfield%5D=krs_podmioty.plec&aggs%5Btyp_id%5D%5Bterms%5D%5Binclude%5D%5Bpattern%5D=%28K%7CM%29&aggs%5Btyp_id%5D%5Baggs%5D%5Blabel%5D%5Bterms%5D%5Bfield%5D=krs_podmioty.plec&_type=objects');
$curl = curl_init('https://api-v3.mojepanstwo.pl/dane/krs_podmioty.json?conditions%5Bkrs_podmioty.gmina_id%5D=2315&page=1&_type=objects');

curl_setopt_array($curl, array(
  CURLOPT_RETURNTRANSFER    =>  true,
  CURLOPT_FOLLOWLOCATION    =>  true,
  CURLOPT_MAXREDIRS         =>  10,
  CURLOPT_TIMEOUT           =>  30,
  CURLOPT_CUSTOMREQUEST     =>  'GET',
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo 'cURL Error #:' . $err;
} else {
 $f = json_decode($response);
  $p = $f->Dataobject;

require 'json.php';

$nazwa1="";
$adres1="";
$siedziba="";
$miasto="Włodawa";

$krs="krs_podmioty.";
    $adres=$krs."adres";
    $nazwa=$krs."nazwa";

  //$ff=$f->Count;
  $licz = count($p);
 $liczba = $licz;
echo "nazwa;szerokosc;dlugosc;ulica;nr;lokal;miasto<br>";
for($l=0;$l<=$liczba;$l++){
       $nazwa1 = $p[$l]->data->$nazwa;
       $adres1 = $p[$l]->data->$adres;
       $a1=(explode('miejsc.',$adres1,2));
       $a2=(explode(',',$a1[0],3));
       $u1=(explode('ul.',$a2[0],2));
       $ulica= str_replace(" ", "%20", $u1[1]);
       //$ulica=$u1[1];
       $n1=(explode('nr ',$a2[1],2));
       $nr_d=$n1[1];
       $lokal=$a2[2];

if (preg_match('/---/', $lokal)){
           $lokal="";
           $siedziba=$miasto."+".$ulica."+".$nr_d;
     $pozycja=json($siedziba);
echo $nazwa1.";".$pozycja.";".$lokal.";".$miasto;
echo "<br>";
             }else{
            $local=(explode(',',$lokal,2));
            $siedziba=$miasto."+".$ulica."+".$nr_d;
    $pozycja=json($siedziba);
 echo $nazwa1.";".$pozycja.";".$local[0].";".$miasto;
// echo "\n";
 echo "<br>";
        }
     }
   }

//var_dump ($f);

?>
