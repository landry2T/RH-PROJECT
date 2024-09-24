@extends('layouts.app')



@section('content')

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>Vous ètes dans votre session</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      @foreach($users as $user)
      <div class="tile">
        <section class="invoice" >
          <div class="row mb-4">
            <div class="col-3">
            </div>
            <div class="col-9">
              <?php
                
              $mois= Session::get('mois');
               $lesMois = array(
                   '01' => 'janvier',
                   '02' => 'fevrier',
                   '03' => 'mars',
                   '04' => 'avril',
                   '05' => 'mai',
                   '06' => 'juin',
                   '07' => 'juillet',
                   '08' => 'août',
                   '09' => 'septembre',
                   '10' => 'octobre',
                   '11' => 'novembre',
                   '12' => 'décembre'
           ); ?>
              <h3 class="text-center" style=" width:600px; border:2px solid black;">declaration des impots {{$admins->name}} <br> au nom du Mois de <?php echo $lesMois[$mois]; ?> <?php echo date('Y'); ?></h3>
            </div> 
          </div>

          <div class="row mb-4">
            <div class="col-12">
              <h5 class="text-center" style="border:2px solid black;">Date du jour : <?php echo date('d/m/Y');?> <br><br> poste de l'employe: {{$user->name_poste}}
              </h5>
            </div> 
          </div>
          <?php

          $salaire = $user->nombre_heure*$user->montant_heure;
          $date=date("Y-m-d");
          $date1=strtotime($date);
          $date2=strtotime($user->date_contrat);
          $abs=abs($date2-$date1);
          $floor=floor($abs/(365*60*60*24));
          $p=0;
          $p1=0;
          $p2=0;
          $p3=0;
          $p4=0;
          $avance=0;
          $heure=0;

          if ($floor==0 or $floor==1) {
           $val=0; 
           $ancienete= ($user->nombre_heure*$user->montant_heure)*(($val)/100);
         } 
         elseif($floor==2) {
          $val=4;
          $ancienete = ($user->nombre_heure*$user->montant_heure)*(($val)/100);
        }else{
          $val=$floor;
          $ancienete = ($user->nombre_heure*$user->montant_heure)*(($val*2)/100);
        }

        $prime = \App\Models\Declarations::prime_impossable($user->idposte);

        foreach ($prime as $key) {

         $p+=$key->montant_prime;
       }

       $prime1 = \App\Models\Declarations::prime_cotisable($user->idposte);

       foreach ($prime1 as $key1) {

         $p1+=$key1->montant_prime;
       }

       $prime2 = \App\Models\Declarations::prime_cotisables($user->idposte);

       foreach ($prime2 as $key2) {

        $p2+=$key2->montant_prime;
      }

      $prime3 = \App\Models\Declarations::indemnite($user->idposte);

      foreach ($prime3 as $key3) {

        $p3+=$key3->montant_prime;
      }
      $prime4 = \App\Models\Declarations::conges($user->idposte);

      foreach ($prime4 as $key4) {

        $p4+=$key4->montant_prime;
      }

      $avances = \App\Models\Declarations::avances($user->id , $mois);

      foreach ($avances as $value) {
        $avance += $value->montant_avance;
      }


      $heures = \App\Models\Declarations::heures($user->id , $mois);

      foreach ($heures as $value) {
        $heure += $value->montant_heure*$value->nbre_heure;
      }

      if(isset($heure)&&!empty($heure)){
       $brut=$salaire+$p+$ancienete+$heure+$p1+$p2+$p3+$p4;
     }elseif(isset($avance)&&!empty($avance)){
      $brut=$salaire+$p+$ancienete+$avance+$p1+$p2+$p3+$p4;
    }else{
      $brut=$salaire+$p+$ancienete+$p1+$p2+$p3+$p4;

    }

    ?>


    <?php  ($sdi=$brut-$p1-$p2-$p4); ?>

    <?php 
    $tot=0;
    $tot1=0;

    foreach($prime as $b){

      if (($sdi*($b->taux_prime/100))> $b->montant_prime) {

        $tot+=$b->montant_prime;
      }else{

        $tot+=($sdi*$b->taux_prime/100); 
      }
    }

    foreach($prime4 as $b1){

      if (($sdi*($b1->taux_prime/100))> $b1->montant_prime) {

       $tot1+=$b1->montant_prime;
     }else{

      $tot1+=($sdi*$b1->taux_prime/100); 
    }
  }

  $salaire_brut_taxable=$sdi+$tot+$tot1;
  $salaire_cotisable=$brut-$p1-$p2;
  ?>


  <table class="table table-bordered">
    <tr style="background:skyblue;">
      <th>NOM</th>
      <th>SALBRUT</th>
      <th>SALTAX</th>
      <th>SALTAXEPL</th>
      <th>IRPP</th>
      <th>CAC/IRPP</th>
      <th>TDL</th>
      <th>RED AUD</th>
      <th>CFC SAL</th>
      <th>CFC PAT</th>
      <th>FNE</th>
      <th>TOTAL</th>
    </tr>
    <tr>
      <td>{{$user->Fname}} {{$user->Lname}}</td>
      <td>{{$brut}}</td>
      <td>{{$salaire_brut_taxable}}</td>
      <td>{{$salaire_cotisable}}</td>
      <td>
        <?php if ($salaire_cotisable>750000) {
        $t=750000*0.042; 
      }else{
        $t=$salaire_cotisable*0.042;
      }  round($t,0,PHP_ROUND_HALF_UP); ?>
      <?php 
      $pensionV=$t*12;
      $revenuglobale=($salaire_brut_taxable*12)-(0.3*$salaire_brut_taxable*12)-500000-$pensionV;
      if($revenuglobale<=2000000)  {
       $irrpA=($revenuglobale*10)/100;
     }elseif ($revenuglobale>2000000 && $revenuglobale<=3000000) {
      $irrpA=$revenuglobale*0.15;
    }elseif ($revenuglobale>3000000 && $revenuglobale<=5000000) {
      $irrpA=$revenuglobale*0.25;
    }else{
     $irrpA=$revenuglobale*0.35;
   }

   $irp=$irrpA/12;
   echo round($irp,0,PHP_ROUND_HALF_UP);

   ?>
 </td>
 <td><?php $cac=strtoupper($irp*10/100);  echo round($cac,0,PHP_ROUND_HALF_UP);?></td>
 <td><?php if($salaire<=62000) {
    echo $TLD=0;
}elseif ($salaire>62000&&$salaire<=75000) {
    echo $TLD=250;
}elseif ($salaire>75000&&$salaire<=100000) {
    echo $TLD=500;
}elseif ($salaire>100000&&$salaire<=125000) {
    echo $TLD=750;
}elseif ($salaire>125000&&$salaire<=150000) {
    echo $TLD=1000;
}elseif ($salaire>150000&&$salaire<=200000) {
    echo $TLD=1250;
}elseif ($salaire>200000&&$salaire<=250000) {
    echo $TLD=1500;
}elseif ($salaire>250000&&$salaire<=300000) {
    echo $TLD=2000;
}elseif ($salaire>300000&&$salaire<=500000) {
    echo $TLD=2250;
}else{echo $TLD=2500;} ?></td>

<td><?php if($salaire_cotisable==0&&$salaire_cotisable<=50000) {
    echo $rad=0;
}elseif ($salaire_cotisable>=50000&&$salaire_cotisable<=100000) {
    echo $rad=750;
}elseif ($salaire_cotisable>100000&&$salaire_cotisable<=200000) {
    echo $rad=1950;
}elseif ($salaire_cotisable>200000&&$salaire_cotisable<=300000) {
    echo $rad=3250;
}elseif ($salaire_cotisable>300000&&$salaire_cotisable<=400000) {
    echo $rad=4550;
}elseif ($salaire_cotisable>400000&&$salaire_cotisable<=500000) {
    echo $rad=5850;
}elseif ($salaire_cotisable>500000&&$salaire_cotisable<=600000) {
    echo $rad=7150;
}elseif ($salaire_cotisable>600000&&$salaire_cotisable<=700000) {
    echo $rad=8450;
}elseif ($salaire_cotisable>700000&&$salaire_cotisable<=800000) {
    echo $rad=9750;
}elseif ($salaire_cotisable>800000&&$salaire_cotisable<=900000) {
    echo $rad=11050;
}elseif ($salaire_cotisable>900000&&$salaire_cotisable<=1000000) {
    echo $rad=12350;
}else{echo $rad=13000;} ?></td>
<td><?php $cfc=$salaire_brut_taxable*0.01; echo round($cfc,0,PHP_ROUND_HALF_UP);?></td>
<td><?php $cfp=$brut*0.015; echo round($cfp,0,PHP_ROUND_HALF_UP);?></td>
<td><?php $fne=$brut*0.01; echo round($fne,0,PHP_ROUND_HALF_UP);?></td>
<td><?php $total=$fne+$cfc+$cfp+$rad+$TLD+$irp+$salaire_cotisable+$salaire_brut_taxable+$brut+$cac; echo round($total,0,PHP_ROUND_HALF_UP); ?></td>
</tr>
</table><br>

<div>
  <div class="row">
    <div class="col-md-4">
      <h4>{{$admins->name}}</h4>
      <h5>{{$admins->adresse}}</h5>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"> <h5>N0 EMPL :* 00{{$user->id}}</h5><h5>
      N0 CONTR :* {{$user->numero_cnps}}
    </h5></div>
  </div>
  <table class="table table-striped">
    <tr><th>DESIGNATION</th> <th>MONTANT</th></tr>
    <tr><th>IRRP</th> <th> <?php echo round($irp,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>CAC</th> <th> <?php echo round($cac,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>TLD</th> <th> <?php echo round($TLD,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>RED AUD</th> <th> <?php echo round($rad,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>CFC SAL</th> <th> <?php echo round($cfc,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>CFC PAT</th> <th> <?php echo round($cfp,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>FNE</th> <th> <?php echo round($fne,0,PHP_ROUND_HALF_UP);  ?></th></tr>
    <tr><th>TOTAL</th> <th style="font-size:1.3em;"> <?php echo round(($fne+$cfp+$cfc+$rad+$TLD+$cac+$irp),0,PHP_ROUND_HALF_UP);  ?></th></tr>
  </table>
</div>

</section>
</div>
@endforeach


</div>
</div> 
</main>
@endsection
