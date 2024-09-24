@extends('layouts.app')



@section('content')
@foreach($users as $u)
@if($u->profil=='Vacataire/Stagiaire (S)')
<main class="col-md-12">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>vous êtes dans votre session</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice" >
          <div class="row mb-4">
            <div class="col-4">
              <img src="/uploads/{{$admins->logo}}" style="height:90px; width:110px;"><br>
              <h6 style="font-style:italic;">{{$admins->slogan}}</h6>
            </div>
            <div class="col-8">
              <h4 class="text-center" style="width:350px;">{{$admins->name}}</h4>
              <h4 class="text-center" style=" width:350px; background:#de7c7c;">BULLETIN DE PAIE</h4>
            </div> 
          </div>
          <div class="row invoice-info">
            <div class="col-5" style="background:#17a2b8; height:23px;">
              <address><strong>Periode du: 01-<?php echo date('m-Y'); ?> au <?php echo date('d-m-Y');?></strong></address>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5" style="background:#17a2b8; height:23px;"><strong>Paiement par virement: 31-<?php echo date('d-m-Y');?></strong></div>
          </div>

          <img src="/uploads/{{$admins->logo}}" style="position:absolute;filter:alpha(opacity=50); opacity:0.1;">
          <div class="row invoice-info">
            <div class="col-5" style="border:2px solid black;">
              <address>
                <strong>Nom</strong>: <?php echo strtoupper($admins->name); ?><br>
                <strong>Registre Commercial</strong>: <?php echo strtoupper($admins->contribuable); ?><br>
                <strong>Numéro de cnps</strong>: <?php echo strtoupper($admins->numero_cnps); ?><br>
                <strong>Adresse</strong>: <?php echo strtolower($admins->adresse); ?><br>
                <strong>Email</strong>: <?php echo strtolower($admins->email); ?>
              </div>
              <div class="col-2">
              </div>
              <div class="col-5" style="border:2px solid black;">
                @foreach($users as $user)
                <b>Nom:</b> {{$user->Fname}} {{$user->Lname}}<br>
                <b>adresse:</b> {{$user->adresse}}<br>
                <b>poste:</b> {{$user->name_poste}}<br>
              @endforeach
            </div>
          </div><br>
          <?php 
          $date=date("Y-m-d");
          $date1=strtotime($date);
          $date2=strtotime($user->date_contrat);
          $abs=abs($date2-$date1);
          $floor=floor($abs/(365*60*60*24));
          $totalprime=0;
          $totalprime1=0;
          $totalprime2=0;
          $totalprime3=0;
          $totalprime4=0;
          ?>
          <div class="row">
            <div class="col-12 table-responsive">
              <table border="3" style="width:100%;" class="col-md-12" >

                <tr id="tab">
                  <th id="r">N°</th>
                  <th id="r">Désignation</th>
                  <th id="r">Base</th>
                  <th colspan="2" id="r">Part Salariale</th>
                  <th colspan="2" id="r">Part Patronale</th>
                </tr>
                <tr id="tab">
                  <th colspan="3" id="r"></th>
                  <th id="r">Taux</th>  
                  <th id="r">Montant</th>
                  <th id="r">Taux</th>  
                  <th id="r">Montant</th>         
                </tr>
                <tr>
                 <th id="r">1011</th>
                 <th id="r">Salaire de base</th>
                 <th id="r"><?php echo $salaire=round(($user->nombre_heure*$user->montant_heure),0,PHP_ROUND_HALF_UP);?></th>
                 <th id="r"></th>
                 <th id="r"><?php echo round(($salaire),0,PHP_ROUND_HALF_UP);?></th>
               </tr>
          
        <?php foreach ($primes as $key) {?>
          <tr>
           <th id="r">1013</th>
           <th id="r"><?php echo $key->libelle_prime; ?></th>
           <th id="r"><?php echo $key->montant_prime; ?><th>
             <th id="r"><?php echo $key->montant_prime; ?></th>

             <th id="r" colspan="2"></th>                  
           </tr>
           <?php $totalprime+=$key->montant_prime; ?>
         <?php }?>

         <?php foreach ($primes1 as $k1) {?>

          <?php if ((($k1->taux_prime/100))> $k1->montant_prime) {?>
            <tr>
             <th id="r">1014</th>
             <th id="r"><?php echo $k1->libelle_prime; ?></th>
             <th id="r"><?php echo $rp=$k1->montant_prime; ?><th>
               <th id="r"><?php echo $k1->montant_prime; ?></th>

               <th id="r" colspan="2"></th>                  
             </tr>
           <?php }else{ ?>

             <tr>
               <th id="r">1014</th>
               <th id="r"><?php echo $k1->libelle_prime; ?></th>
               <th id="r"><?php echo $k1->montant_prime; ?><th>
                 <th id="r"><?php echo $k1->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>

             <?php } ?>
             <?php $totalprime1+=$k1->montant_prime; ?>
           <?php }?>

           <?php foreach ($primes4 as $k4) {?>

            <?php if ((($k4->taux_prime/100))> $k4->montant_prime) {?>
              <tr>
               <th id="r">1014</th>
               <th id="r"><?php echo $k4->libelle_prime; ?></th>
               <th id="r"><?php echo $rp=$k4->montant_prime; ?><th>
                 <th id="r"><?php echo $k4->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
             <?php }else{ ?>

               <tr>
                 <th id="r">1014</th>
                 <th id="r"><?php echo $k4->libelle_prime; ?></th>
                 <th id="r"><?php echo $k4->montant_prime; ?><th>
                   <th id="r"><?php echo $k4->montant_prime; ?></th>

                   <th id="r" colspan="2"></th>                  
                 </tr>

               <?php } ?>
               <?php $totalprime4+=$k4->montant_prime; ?>
             <?php }?>


             <?php foreach ($primes2 as $k2) {?>
              <tr>
               <th id="r">1013</th>
               <th id="r"><?php echo $k2->libelle_prime; ?></th>
               <th id="r"><?php echo $k2->montant_prime; ?><th>
                 <th id="r"><?php echo $k2->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
               <?php $totalprime2+=$k2->montant_prime; ?>
             <?php }?>

             <?php foreach ($primes3 as $k3) {?>
              <tr>
               <th id="r">1013</th>
               <th id="r"><?php echo $k3->libelle_prime; ?></th>
               <th id="r"><?php echo $k3->montant_prime; ?><th>
                 <th id="r"><?php echo $k3->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
               <?php $totalprime3+=$k3->montant_prime; ?>
             <?php }?>

             <?php foreach ($heures as $h3) {?>
              <tr>
               <th id="r">1016</th>
               <th id="r">heure supplementaire</th>
               <th id="r"><?php echo $heure = ($h3->nbre_heure*$h3->montant_heure);?></th>
               <th id="r"></th>
               <th id="r"><?php echo $heure;?></th>
             </tr>
           <?php } ?>

           <tr style="background:#93d896;">  
            <th id="r" colspan="4" style="color:black; font-weight:bold;"><h5>Salaire Brut</h5></th>
            <th id="r" style="color:black; font-weight:bold;"><h5><?php

            if(isset($heure)&&!empty($heure)){
             echo($h=$salaire+$totalprime+$heure+$totalprime1+$totalprime2+$totalprime3+$totalprime4);
           }elseif(isset($heures)&&!empty($heures)){
            echo($h=$salaire+$totalprime+$totalprime1+$totalprime2+$totalprime3+$totalprime4);
          }else{
            echo($h=$salaire+$totalprime+$totalprime1+$totalprime2+$totalprime3+$totalprime4);

          }

          ?>
         

<tr id="style" style="color:black;">  
  <th id="r" colspan="4"><h5>Net a payer:</h5></th>
  <th id="r"><h5><?php $net=$h; ?> <?php echo round($net,0,PHP_ROUND_HALF_UP); ?> FCFA</h5></th>
  <th id="r" colspan="2"></th>     
</tr>

<?php \App\Models\User::insert($user->idbul ,$user->id , $net);?>
<?php \App\Models\User::insertfiscale($user->id , 0 , 0);?>
</table>
</div>
</div>
<div class="row d-print-none mt-2">
  <div class="col-12 text-end"><a class="btn btn-primary" href="javascript:window.print();"><i class="bi bi-printer me-2"></i> Imprimer</a></div>
</div>
</section>
</div>
</div>
</div> 
</main>
@else
<main class="col-md-12">
  <div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Tableau de bord</h1>
      <p>vous êtes dans votre session</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <section class="invoice" >
          <div class="row mb-4">
            <div class="col-4">
              <img src="/uploads/{{$admins->logo}}" style="height:90px; width:110px;"><br>
              <h6 style="font-style:italic;">{{$admins->slogan}}</h6>
            </div>
            <div class="col-8">
              <h4 class="text-center" style="width:350px;">{{$admins->name}}</h4>
              <h4 class="text-center" style=" width:350px; background:#de7c7c;">BULLETIN DE PAIE</h4>
            </div> 
          </div>
          <div class="row invoice-info">
            <div class="col-5" style="background:#17a2b8; height:23px;">
              <address><strong>Periode du: 01-<?php echo date('m-Y'); ?> au <?php echo date('d-m-Y');?></strong></address>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5" style="background:#17a2b8; height:23px;"><strong>Paiement par virement: 31-<?php echo date('d-m-Y');?></strong></div>
          </div>

          <img src="/uploads/{{$admins->logo}}" style="position:absolute;filter:alpha(opacity=50); opacity:0.1;">
          <div class="row invoice-info">
            <div class="col-5" style="border:2px solid black;">
              <address>
                <strong>Nom</strong>: <?php echo strtoupper($admins->name); ?><br>
                <strong>Registre Commercial</strong>: <?php echo strtoupper($admins->contribuable); ?><br>
                <strong>Numéro de cnps</strong>: <?php echo strtoupper($admins->numero_cnps); ?><br>
                <strong>Adresse</strong>: <?php echo strtolower($admins->adresse); ?><br>
                <strong>Email</strong>: <?php echo strtolower($admins->email); ?>
              </div>
              <div class="col-2">
              </div>
              <div class="col-5" style="border:2px solid black;">
                @foreach($users as $user)
                <b>Nom:</b> {{$user->Fname}} {{$user->Lname}}<br>
                <b>adresse:</b> {{$user->adresse}}<br>
                <b>poste:</b> {{$user->name_poste}}<br>
                <b>classe:</b> {{$user->name_categorie}} {{$user->echellon}}<br>
                <b>anciénété:</b> 
                <?php 
                $a1=date('Y'); 
                $m1=date('m'); 
                $m2=date('m', strtotime($user->date_contrat));
                $a2=date('Y',strtotime($user->date_contrat));
                $moiss = (($m1-$m2)+12*($a1-$a2));
                echo $ans=floor($moiss/12);
              ?> ans <?php echo $ab=($moiss%12); ?> mois
              @endforeach
            </div>
          </div><br>
          <?php 
          $date=date("Y-m-d");
          $date1=strtotime($date);
          $date2=strtotime($user->date_contrat);
          $abs=abs($date2-$date1);
          $floor=floor($abs/(365*60*60*24));
          $totalprime=0;
          $totalprime1=0;
          $totalprime2=0;
          $totalprime3=0;
          $totalprime4=0;
          ?>
          <div class="row">
            <div class="col-12 table-responsive">
              <table border="3" style="width:100%;" class="col-md-12" >

                <tr id="tab">
                  <th id="r">N°</th>
                  <th id="r">Désignation</th>
                  <th id="r">Base</th>
                  <th colspan="2" id="r">Part Salariale</th>
                  <th colspan="2" id="r">Part Patronale</th>
                </tr>
                <tr id="tab">
                  <th colspan="3" id="r"></th>
                  <th id="r">Taux</th>  
                  <th id="r">Montant</th>
                  <th id="r">Taux</th>  
                  <th id="r">Montant</th>         
                </tr>
                <tr>
                 <th id="r">1011</th>
                 <th id="r">Salaire de base</th>
                 <th id="r"><?php echo $salaire=round(($user->nombre_heure*$user->montant_heure),0,PHP_ROUND_HALF_UP);?></th>
                 <th id="r"></th>
                 <th id="r"><?php echo round(($salaire),0,PHP_ROUND_HALF_UP);?></th>
               </tr>
               <tr>
                 <th id="r">1012</th>
                 <th id="r">Anciénnété</th>
                 <th id="r"><?php echo round(($user->nombre_heure*$user->montant_heure),0,PHP_ROUND_HALF_UP);?></th>
                 <th id="r">

                  <?php  
                  if ($floor==0) {
                   $val=0; 
                 } 
                 elseif($floor==2) {
                  $val=2;
                }else{
                  $val=$floor;
                }
              ?> <?php echo  $val*2; ?> % </th>

              <th id="r">

                <?php

                if ($floor==0 or $floor==1) {
                 $val=0; 
                 $re = ($user->nombre_heure*$user->montant_heure)*(($val)/100);
               } 
               elseif($floor==2) {
                $val=4;
                $re = ($user->nombre_heure*$user->montant_heure)*(($val)/100);
              }else{
                $val=$floor;
                $re = ($user->nombre_heure*$user->montant_heure)*(($val*2)/100);
              }
              ?> 

              <?php  echo $r=round(($re),0,PHP_ROUND_HALF_UP);?>

            </th>
          </tr>
        </tr>
        <?php foreach ($primes as $key) {?>
          <tr>
           <th id="r">1013</th>
           <th id="r"><?php echo $key->libelle_prime; ?></th>
           <th id="r"><?php echo $key->montant_prime; ?><th>
             <th id="r"><?php echo $key->montant_prime; ?></th>

             <th id="r" colspan="2"></th>                  
           </tr>
           <?php $totalprime+=$key->montant_prime; ?>
         <?php }?>

         <?php foreach ($primes1 as $k1) {?>

          <?php if ((($k1->taux_prime/100))> $k1->montant_prime) {?>
            <tr>
             <th id="r">1014</th>
             <th id="r"><?php echo $k1->libelle_prime; ?></th>
             <th id="r"><?php echo $rp=$k1->montant_prime; ?><th>
               <th id="r"><?php echo $k1->montant_prime; ?></th>

               <th id="r" colspan="2"></th>                  
             </tr>
           <?php }else{ ?>

             <tr>
               <th id="r">1014</th>
               <th id="r"><?php echo $k1->libelle_prime; ?></th>
               <th id="r"><?php echo $k1->montant_prime; ?><th>
                 <th id="r"><?php echo $k1->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>

             <?php } ?>
             <?php $totalprime1+=$k1->montant_prime; ?>
           <?php }?>

           <?php foreach ($primes4 as $k4) {?>

            <?php if ((($k4->taux_prime/100))> $k4->montant_prime) {?>
              <tr>
               <th id="r">1014</th>
               <th id="r"><?php echo $k4->libelle_prime; ?></th>
               <th id="r"><?php echo $rp=$k4->montant_prime; ?><th>
                 <th id="r"><?php echo $k4->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
             <?php }else{ ?>

               <tr>
                 <th id="r">1014</th>
                 <th id="r"><?php echo $k4->libelle_prime; ?></th>
                 <th id="r"><?php echo $k4->montant_prime; ?><th>
                   <th id="r"><?php echo $k4->montant_prime; ?></th>

                   <th id="r" colspan="2"></th>                  
                 </tr>

               <?php } ?>
               <?php $totalprime4+=$k4->montant_prime; ?>
             <?php }?>


             <?php foreach ($primes2 as $k2) {?>
              <tr>
               <th id="r">1013</th>
               <th id="r"><?php echo $k2->libelle_prime; ?></th>
               <th id="r"><?php echo $k2->montant_prime; ?><th>
                 <th id="r"><?php echo $k2->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
               <?php $totalprime2+=$k2->montant_prime; ?>
             <?php }?>

             <?php foreach ($primes3 as $k3) {?>
              <tr>
               <th id="r">1013</th>
               <th id="r"><?php echo $k3->libelle_prime; ?></th>
               <th id="r"><?php echo $k3->montant_prime; ?><th>
                 <th id="r"><?php echo $k3->montant_prime; ?></th>

                 <th id="r" colspan="2"></th>                  
               </tr>
               <?php $totalprime3+=$k3->montant_prime; ?>
             <?php }?>

             <?php foreach ($heures as $h3) {?>
              <tr>
               <th id="r">1016</th>
               <th id="r">heure supplementaire</th>
               <th id="r"><?php echo $heure = ($h3->nbre_heure*$h3->montant_heure);?></th>
               <th id="r"></th>
               <th id="r"><?php echo $heure;?></th>
             </tr>
           <?php } ?>

           <tr style="background:#93d896;">  
            <th id="r" colspan="4" style="color:black; font-weight:bold;"><h5>Salaire Brut</h5></th>
            <th id="r" style="color:black; font-weight:bold;"><h5><?php

            if(isset($heure)&&!empty($heure)){
             echo($h=$salaire+$totalprime+$r+$heure+$totalprime1+$totalprime2+$totalprime3+$totalprime4);
           }elseif(isset($heures)&&!empty($heures)){
            echo($h=$salaire+$totalprime+$r+$totalprime1+$totalprime2+$totalprime3+$totalprime4);
          }else{
            echo($h=$salaire+$totalprime+$r+$totalprime1+$totalprime2+$totalprime3+$totalprime4);

          }

          ?>
          <?php  ($sdi=$h-$totalprime1-$totalprime2-$totalprime4); ?>

          <?php 
          $tot=0;
          $tot1=0;

          foreach($primes as $b){

            if (($sdi*($b->taux_prime/100))> $b->montant_prime) {

              $tot+=$b->montant_prime;
            }else{

              $tot+=($sdi*$b->taux_prime/100); 
            }
          }

          foreach($primes4 as $b1){

            if (($sdi*($b1->taux_prime/100))> $b1->montant_prime) {

             $tot1+=$b1->montant_prime;
           }else{

            $tot1+=($sdi*$b1->taux_prime/100); 
          }
        }

        $sbt=$sdi+$tot+$tot1;
        ?>

        <?php  ($sc=$h-$totalprime1-$totalprime2); ?>



      </h5></th>
      <th id="r" colspan="2"></th>     
    </tr>
  </tr>
  <tr><th id="tab" colspan="7"><h6>Retenue Salariale</h6></th></tr>
  <tr>
   <th id="r">2015</th>
   <th id="r">irpp</th>
   <th id="r">
    <?php if ($sc>750000) {
      $t=750000*0.042; 
    }else{
      $t=$sc*0.042;
    }  round($t,0,PHP_ROUND_HALF_UP); ?>
    <?php 
    $pensionV=$t*12;
    $revenuglobale=($sbt*12)-(0.3*$sbt*12)-500000-$pensionV;
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

 ?>
 <?php  echo round($irp,0,PHP_ROUND_HALF_UP); ?>
</th>
<th id="r"></th>
<th id="r"><?php echo round($irp,0,PHP_ROUND_HALF_UP);?></th>
</tr>

<tr>
 <th id="r">2016</th>
 <th id="r">cac</th>
 <th id="r"><?php echo round($irp,0,PHP_ROUND_HALF_UP);?></th>
 <th id="r">10%</th>
 <th id="r"><?php $cac=strtoupper($irp*10/100);  echo round($cac,0,PHP_ROUND_HALF_UP);?></th>
</tr>

<tr>
 <th id="r">2012</th>
 <th id="r">redevence Audio visuelle</th>
 <th id="r"><?php echo strtoupper($h);?></th>
 <th id="r"></th>
 <th id="r"><?php if($sc==0&&$sc<=50000) {
  echo $rad=0;
}elseif ($sc>=50000&&$sc<=100000) {
  echo $rad=750;
}elseif ($sc>100000&&$sc<=200000) {
  echo $rad=1950;
}elseif ($sc>200000&&$sc<=300000) {
  echo $rad=3250;
}elseif ($sc>300000&&$sc<=400000) {
  echo $rad=4550;
}elseif ($sc>400000&&$sc<=500000) {
  echo $rad=5850;
}elseif ($sc>500000&&$sc<=600000) {
  echo $rad=7150;
}elseif ($sc>600000&&$sc<=700000) {
  echo $rad=8450;
}elseif ($sc>700000&&$sc<=800000) {
  echo $rad=9750;
}elseif ($sc>800000&&$sc<=900000) {
  echo $rad=11050;
}elseif ($sc>900000&&$sc<=1000000) {
  echo $rad=12350;
}else{echo $rad=13000;} ?></th>
</tr>

<tr>
 <th id="r">2013</th>
 <th id="r">Taxe au  devellopement local</th>
 <th id="r"><?php echo strtoupper($salaire);?></th>
 <th id="r"></th>
 <th id="r"><?php if($salaire<=62000) {
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
}else{echo $TLD=2500;} ?></th>
</tr>

<tr>
 <th id="r">2014</th>
 <th id="r">cnps salariale</th>
 <th id="r"><?php if ($sc>750000) {
   echo $scc=750000;
 }else{echo $scc=$sc;}?></th>
 <th id="r">4.2%</th>
 <th id="r"><?php $t=$scc*0.042; echo round($t,0,PHP_ROUND_HALF_UP); ?></th>
</tr>
<tr>
 <th id="r">2011</th>
 <th id="r">credit foncier salarial</th>
 <th id="r"><?php echo strtoupper($sbt);?></th>
 <th id="r">1%</th>
 <th id="r"><?php $ti=$sbt*0.01; echo round($ti,0,PHP_ROUND_HALF_UP);?></th>
</tr>
<tr style="background:#93d896;">  
  <th id="r" colspan="4" id="r" style="color:black; font-weight:bold;"><h5>Total retenue Salarial:</h5></th>
  <th  id="r" id="r" style="color:black; font-weight:bold;"><h5><?php echo round($chargeS=($u=$irp+($irp*0.1)+$TLD+$t+$ti+$rad),0,PHP_ROUND_HALF_UP); ?></h5></th>
  <th id="r" colspan="2"></th>     
</tr>

<tr><th id="tab" colspan="7" id="r" style="color:black; font-weight:bold;"><h6>Charges Patronales</h6></th></tr>
<tr>
 <th id="r">5011</th>
 <th id="r">Accident de travail</th>                 
 <th id="r"><?php
 echo $sc;
?></th>
<th id="r" colspan="2"></th>
<th id="r">
  <?php
  if ($admins->niveau_risque == "niveau risque faible") { 
    echo "1.75%";
  }elseif ($admins->niveau_risque == "niveau risque moyen") {
   echo "2.5%";
 }else{
  echo "5%";
} 
?>

</th>
<th id="r">

  <?php
  if ($admins->niveau_risque=="niveau risque faible") { 
    $a=$sc*0.0175;
    echo round($a,0,PHP_ROUND_HALF_UP);
  }elseif ($admins->niveau_risque=="niveau risque moyen") {
   $a=$sc*0.025;
   echo round($a,0,PHP_ROUND_HALF_UP);
 }else{
  $a=$sc*0.05;
  echo round($a,0,PHP_ROUND_HALF_UP);
} 
?>
</th>
</tr>
<tr>
 <th id="r">3012</th>
 <th id="r">allocation familliale</th>
 <th id="r"><?php echo strtoupper($sc);?></th>
 <th id="r" colspan="2"></th>
 <th id="r">7%</th>
 <th id="r"><?php $b=$sc*0.07; echo round($b,0,PHP_ROUND_HALF_UP);?></th>
</tr>
<tr>
 <th id="r">3013</th>
 <th id="r">cnps patronale</th>
 <th id="r"><?php if ($sc>750000) {
   echo $sct=750000;
 }else{echo $sct=$sc;}?></th>
 <th id="r"colspan="2"></th>
 <th id="r">4,2%</th>
 <th id="r"><?php $c=$sct*0.042; echo round($c,0,PHP_ROUND_HALF_UP);?></th>
</tr>

<tr>
 <th id="r">3014</th>
 <th  id="r">Credit Foncier Patronale</th>
 <th id="r"><?php echo strtoupper($h);?></th>
 <th id="r" colspan="2"></th>
 <th id="r">1,5%</th>
 <th id="r"><?php $d=$h*0.015; echo round($d,0,PHP_ROUND_HALF_UP);?></th>
</tr>

<tr>
 <th id="r">3015</th>
 <th id="r">FNE</th>
 <th  id="r"><?php echo strtoupper($h);?></th>
 <th id="r" colspan="2"></th>
 <th id="r">1%</th>
 <th id="r"><?php $e=$h*0.01; echo round($e,0,PHP_ROUND_HALF_UP);?></th>
</tr>

<tr style="background:#93d896;">  
  <th id="r" colspan="4" id="r" style="color:black; font-weight:bold;"><h5>Total charge patronal:</h5></th>
  <th id="r" colspan="2"></th>      
  <th id="r" id="r" style="color:black; font-weight:bold;"><h5><?php echo round(($chargeP=$a+$b+$c+$d+$e),0,PHP_ROUND_HALF_UP); ?></h5></th>    
</tr>
<tr><th id="tab" colspan="7" id="r" style="color:black; font-weight:bold;"><h6>Non Soumis</h6></th></tr>

<tr>
 <th id="r">5014</th>
 <th id="r">avance sur salaire</th>
 <th id="r"><?php
 if(isset($avances)&& !empty($avances)){

  foreach ($avances as $value) {
    echo $avance=$value->montant_avance;
  }

}else{
  echo $avance=0;
} 
?></th>
<th id="r"></th>
<th id="r"><?php
if(isset($avances)&& !empty($avances)){
 foreach ($avances as $value) {
  echo $avance=$value->montant_avance;
}
}else{
  echo $avance=0;
} 
?></th>
<th id="r" colspan="2"></th>
</tr>

<?php if (isset($pointages)) {?>
  <tr>
   <th  id="r">5015</th>
   <th id="r">absence non justifeé</th>
   <th id="r">
    <?php 
    echo $absence=round((($salaire/24)*$pointages),0,PHP_ROUND_HALF_UP);
  ?></th>
  <th  id="r"></th>
  <th id="r">0</th>
  <th id="r" colspan="2"></th>

</tr>
<?php }else{$absence=0;} ?>
<tr style="background:#93d896; height:40px;">  
  <th id="r" colspan="4" id="r" style="color:black; font-weight:bold;"><h5>Total Non soumis:</h5></th>
  <th id="r" id="r" style="color:black; font-weight:bold;"><h5><?php if(isset($avance)&&!empty($avance)){echo $rt=$avance+$absence;}else{echo $rt=$absence;}  ?></h5></th>
  <th id="r" colspan="2"></th>     
</tr>
<tr id="style" style="color:black;">  
  <th id="r" colspan="4"><h5>Net a payer:</h5></th>
  <th id="r"><h5><?php $net=($h-$u-$rt); ?> <?php echo round($net,0,PHP_ROUND_HALF_UP); ?> FCFA</h5></th>
  <th id="r" colspan="2"></th>     
</tr>

<?php \App\Models\User::insert($user->idbul ,$user->id , $net);?>
<?php \App\Models\User::insertfiscale($user->id , $chargeS , $chargeP);?>
</table>
</div>
</div>
<div class="row d-print-none mt-2">
  <div class="col-12 text-end"><a class="btn btn-primary" href="javascript:window.print();"><i class="bi bi-printer me-2"></i> Imprimer</a></div>
</div>
</section>
</div>
</div>
</div> 
</main>
@endif
@endforeach
@endsection
