<!-- CONNECTION A LA BASE -->
  <?php include 'includes/db.php' ?>


<html>
<head>
  <title>STB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body id="top">

<div class="bgded overlay" style="background-image:url('images/demo/backgrounds/6406.jpg');"> 
  <header id="header" class="hoc clear"> 
      <div id="logo" class="fl_left">
        <h1><a href="./">STB</a></h1>
      </div>
      <?php 
          session_start();
          if ( !isset ( $_SESSION ['email'] ) ) { ?> 
            <nav id="mainav" class="fl_right">
              <ul class="clear">
                <li class="active"><a href="./">Accueil</a></li>
                <li> </li>
                <li> </li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connection.php">Connection</a></li>
                <li><a href="contact.php">Contact</a></li>
              </ul>
            </nav>
          <?php } else {  ?>
            <li class="text-right">  
                <form action="" method="POST">
                  <input type="submit" name="deconnection" value="deconnection" class="btn btn-warning">
               </form> 
              </li>
            <nav id="mainav" class="fl_right">
              <ul class="clear">
                <li class="active"><a href="./">Accueil</a></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li> <a href="transferer.php"> Transfere argent / Credit </a> </li>
                <li> <a href="historique.php"> Historique </a> </li>
                <li> <a href="compte.php"> Mon compte </a> </li>
                <li> <a href="contact.php"> Contact </a> </li>
                <li></li>
                <li></li>
                <li></li>
                <li> 
                <?php
                    $email = $_SESSION ['email'] ; 
                    $req = " SELECT * FROM crediter_debiter WHERE email_client_recu LIKE '$email' " ; 
                    $res = mysqli_query ($con,$req) ; 
                    if (!$res) 
                      echo ("quer".mysqli_error()) ; 
                    else {
                    while ( $row = mysqli_fetch_array($res) ) {
                      if ( $row ['test'] == '' ) {
                        $devise = $row ['id_devise'] ; 
                        $req = " SELECT lib_devise FROM devise WHERE id = '$devise' " ; 
                        $res2 = mysqli_query ($con,$req) ; 
                        $row2 = mysqli_fetch_assoc($res2) ; 
                        if ( $row2 ['lib_devise'] == 'EUR' ) 
                          $solde = $row['montant'] * 3.12 ; 
                        else if ( $row2 ['lib_devise'] == 'USD' ) 
                                $solde = $row['montant'] * 2.82 ; 
                              else $solde = $row ['montant'] ;

                        $req = " UPDATE client SET solde = solde + $solde WHERE email LIKE '$email' " ; 
                        $res3 = mysqli_query($con,$req) ; 
                        $id = $row ['id'] ; 
                        $req = " UPDATE crediter_debiter SET test = 'O' WHERE id = '$id' " ; 
                        $res4 = mysqli_query ($con,$req) ; 
                      }
                    }}
                    $email = $_SESSION ['email'] ; 
                    $req = " SELECT solde FROM client WHERE email LIKE '$email' " ;
                    $res = mysqli_query ($con,$req) ; 
                    $row = mysqli_fetch_assoc($res) ; 
                    if ( !$res ) 
                      echo ( " QueryField " . mysqli_error() ) ; 
                    else 
                      echo "<li class='active'><a href='historique.php' class=''>".$row ['solde']."  </a></li>" ; 
                  ?>
                </li>
            </nav>
          <?php } ?>
    </header>
</div>

<?php if ( isset ( $_POST ['deconnection'] ) ) {
  session_destroy();
  header ("location: ./") ;
}