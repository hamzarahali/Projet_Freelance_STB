<!-- HEADER --> 
    <?php include 'includes/navbar.php' ?> 
          
    <div class="container text-center" style="padding:50px">
        <h4 class="alert alert-info"> Historique du compte </h4>
        <br>
        <h5 style="text-transform: lowercase;"> E-mail : <?= $_SESSION ['email'] ?> </h5>
        <br>
        <div style="padding : 0px 50px">
            <div class="form-group">
                <table class="table table-bordered table-hover text-center">
                    <tr class="alert alert-success"> Historique du transfere de l'argent de compte vers un autre compte  </tr>
                    <tr>
                        <th> Id </th>
                        <th> Email </th>
                        <th> Montant ( TND ) </th>
                        <th></th>
                    </tr>
                    <?php 
                        $email = $_SESSION ['email'] ; 
                        $req = " SELECT * FROM historique WHERE id_client_envoye LIKE '$email' OR id_client_recu LIKE '$email'"  ; 
                        $res = mysqli_query ($con,$req) ; 
                        if ( !$res ) 
                            echo ("QueryFiels".mysqli_error()) ; 
                        else 
                            while ( $row = mysqli_fetch_array($res) ) {
                    ?>
                        <tr>
                            <td> <?= $row ['id'] ?> </td>
                            <td> 
                                <?php 
                                    if ( strcmp($email,$row ['id_client_envoye']) ==0 ) 
                                        echo $row ['id_client_recu'] ; 
                                    else 
                                        echo $row ['id_client_envoye'] ; 
                                ?> 
                            </td>
                            <td> 
                                <?php
                                    if ( strcmp($email,$row ['id_client_envoye']) ==0 ) 
                                        echo '- '.$row ['montant'] ;
                                    else 
                                        echo '+ '.$row ['montant'] ;
                                ?> 
                            </td>
                            <td> <a href="imprimer.php?id=<?= $row['id'] ?>"  class="btn btn-warning"> Récu </a> </td>
                        </tr>
                            <?php } ?>
                </table>
            </div>
            <div class="form-group">
                <table class="table table-bordered table-hover text-center">
                    
                    <tr>
                        <th> Id </th>
                        <th> Nom </th>
                        <th> Montant </th>
                        <th> Devise </th>
                        <th></th>
                    </tr>
                    <?php 
                        $email = $_SESSION ['email'] ; 
                        $req = " SELECT * FROM crediter_debiter WHERE email_client_recu LIKE '$email' " ; 
                        $res = mysqli_query ($con,$req) ; 
                        if ( !$res ) 
                            echo ("QueryFiels".mysqli_error()) ; 
                        else 
                            while ( $row = mysqli_fetch_array($res) ) {
                                $id = $row ['id_devise'] ;
                                $req = " SELECT * FROM devise WHERE id = $id " ;
                                $res2 = mysqli_query ($con,$req) ; 
                                $row2 = mysqli_fetch_array($res2) ; 
                    ?>
                        <tr>
                            <td> <?= $row ['id'] ?> </td>
                            <td> <?= $row ['nom_agence'] ?> </td>
                            <td> <?= '+ '.$row ['montant'] ?> </td>
                            <td> <?= $row2 ['lib_devise'] ?> </td>
                            <td> <a href="imprimer2.php?id=<?= $row['id'] ?>" class="btn btn-warning"> Récu </a> </td>
                        </tr>
                            <?php } ?>
                </table>
            </div>
        </div>
    </div>

<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>