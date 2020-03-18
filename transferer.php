<!-- HEADER --> 
    <?php include 'includes/navbar.php' ?> 
          
<div class="container text-center" style="padding:30px">

<!-- ENVOYER DE L'ARGENT DU COMPTE VERS UN AUTRE COMPTE -->
    <?php 
        if ( isset ( $_POST ['transfere'] ) )  {
            $email_env = $_SESSION ['email'] ;
            $email_rec = $_POST ['client_rec'] ; 
            $montant = $_POST ['montant'] ; 
            $msg = $_POST ['msg'] ;

            // VERRIFIER SI LE SOLDE DE COMPTE > MONTANT ENVOYER 
            $req = " SELECT solde FROM client WHERE email LIKE '$email_env'" ; 
            $res = mysqli_query ($con,$req) ; 
            $row = mysqli_fetch_assoc ($res) ; 
            if ( $row ['solde'] > $montant ) {
                $req = " SELECT * FROM client WHERE email LIKE '$email_rec' " ; 
                $res = mysqli_query ($con,$req) ; 
                if ( mysqli_num_rows($res) == 0 ) 
                    echo "<h5 class='alert alert-danger'> Email de client a envoyer non valide </h5>" ; 
                else {
                    $req = " INSERT INTO historique ( id_client_envoye , id_client_recu , montant , msg ) " ; 
                    $req .= " VALUES ( '$email_env' , '$email_rec' , '$montant' , '$msg' ) " ; 
                    $res = mysqli_query ($con,$req) ; 
                    $req = " UPDATE client SET solde = solde + '$montant' WHERE email LIKE '$email_rec' " ;
                    $req2 = "UPDATE client SET solde = solde - '$montant' WHERE email LIKE '$email_env' " ;
                    $res = mysqli_query ($con,$req) ; 
                    $res = mysqli_query ($con,$req2) ; 
                    if ( !$res )
                        echo ("Queryfield".mysqli_error()) ; 
                    else 
                        echo "<h5 class='alert alert-success text-center' style='text-transform: uppercase'> Argent transferer avec success </h5>" ;
                } 
            } else 
                echo "<h5 class='alert alert-danger text-center' style='text-transform: uppercase'> Montant à envoyer supperieur a votre solde </h5>" ;
        }
    ?>

<!-- CREDIT --> 
    <?php 
        if ( isset ( $_POST ['credit'] ) ) {
            $email = $_SESSION ['email'] ; 
            $nom_agence = "STB Bank" ; 
            $montant = $_POST ['montant'] ; 
            $id_devise = 3 ; 

            $req = " INSERT INTO crediter_debiter ( email_client_recu , nom_agence , montant , id_devise ) " ;
            $req .= " VALUES ( '$email' , '$nom_agence' , '$montant' , '$id_devise' )  " ; 
            $res = mysqli_query ($con,$req) ;
            if ( !$res )
                echo ("Queryfield".mysqli_error()) ; 
            else 
                echo "<h5 class='alert alert-success text-center' style='text-transform: uppercase'> Credit avec success </h5>" ;
        }
    ?>

</div>
    <div class="row text-center">
        <div class="col-md-6" style="padding: 0px 150px 50px">
            <h3 class="alert alert-info">Credit</h3>
            <form action="" method="POST" >
                <div class="form-group">
                    <label for="email"> Nom agence : </label>
                    <input type="email" name="client_env" id="email" class="form-control" value="STB Bank" disabled> 
                </div>
                <div class="form-group">
                    <label for="email2"> E-mail de client à envoyer : </label>
                    <input type="email" name="client_rec" id="email2" class="form-control"  value="<?= $_SESSION['email'] ?>" disabled>
                </div>
                <div class="form-group">
                    <label for="montant"> Montant ( TND ) : </label>
                    <input type="number" name="montant" id="montant" class="form-control" required>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" name="credit" class="form-control btn btn-warning">
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form> 
        </div>
        <div class="col-md-6" style="padding: 0px 150px 50px">
            <h3 class="alert alert-info">Transferer de l'argent</h3>
            <form action="" method="POST" >
                <div class="form-group">
                    <label for="email"> E-mail : </label>
                    <input type="email" name="client_env" id="email" class="form-control" value="<?= $_SESSION['email'] ?>" disabled> 
                </div>
                <div class="form-group">
                    <label for="email2"> E-mail de client à envoyer : </label>
                    <input type="email" name="client_rec" id="email2" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="montant"> Montant ( TND ) : </label>
                    <input type="number" name="montant" id="montant" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="msg"> Message : </label>
                    <textarea name="msg" id="msg" class="form-control" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <input type="submit" name="transfere" class="form-control btn btn-warning">
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form> 
        </div>
    </div>
</div>
      
<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>