<?php

function json($siedziba)
{
 $curl = curl_init('http://photon.komoot.de/api/?q='.$siedziba.'&limit=1');
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
    $p = $f->features;
    $poz=$p[0]->geometry->coordinates;
    $longitude = $poz[0];
    $latitude  = $poz[1];
    $pp=$p[0]->properties;
    $miasto=$pp->city;
    $ulica=$pp->street;
    $nr_domu=$pp->housenumber;
 return $pozycja = $latitude.";".$longitude.";".$ulica.";".$nr_domu;
  }
   //var_dump ($pp);
   //return $wynik;
}

?>
