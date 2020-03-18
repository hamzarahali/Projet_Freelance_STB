<!-- HEADER --> 
        <?php include 'includes/navbar.php' ?>
    
<div class="container" style="padding: 30px 190px;">

<!-- INSCRIPTION -->
    <?php 
        if ( isset ($_POST ['inscription'])) {

            $nom = $_POST ['nom'] ;
            $prenom = $_POST ['prenom'] ; 
            $pays = $_POST ['pays'] ; 
            $date = $_POST ['date'] ; 
            $devise = $_POST ['devise'] ;
            $nature = $_POST ['nature'] ; 
            $email = $_POST ['email'] ; 
            $mdp = md5($_POST ['mdp']) ; 

            $req = " SELECT * FROM client WHERE email LIKE '$email' " ; 
            $res = mysqli_query ( $con , $req ) ; 
            $row = mysqli_num_rows ($res) ;
            if ( $row == 0 ) {
                $req = " INSERT INTO client ( nom , prenom , pays , date , email , mdp , id_devise , id_nature ) " ; 
                $req .= " VALUES ( '$nom' , '$prenom' , '$pays' , '$date' , '$email' , '$mdp' , '$devise' , '$nature') " ; 
                $res = mysqli_query ($con,$req) ; 

                if ( !$res ) 
                    echo ("QueryField".mysqli_error()) ; 
                else 
                    header ("location: connection.php") ; 
            } else {
                echo "<h5 class='alert alert-danger text-center'> E-mail dejà existe </h5>" ;
            }
        }
    ?>

    <form action="" method="POST">
        <h1 class="Nexa-Bold" style='text-align :center;margin-bottom:30px'>Bienvenue à la banque en ligne de la Société Tunisienne de Banque</h1>
        <div class="row">
            <div class="col-md-6" style="border-right: 1px solid #00000030;padding: 30px;">
                <div class="form-group">
                    <br> <br>
                    <label for="firstname"> Nom : </label>
                    <input type="text" name="nom" id="firstname" class="form-control">

                    <label for="lastname"> Prénom : </label>
                    <input type="text" name="prenom" id="lastname" class="form-control">

                    <label for="country"> Pays : </label>
                    <input type="text" name="pays" id="country" class="form-control" />

                    <label for="date"> Date de naissance : </label>
                    <input type="date" name="date" id="date" class="form-control" max="2019-06-25">
                    
                    <label for="date"> Devise : </label>
                    <select class="form-control" name="devise">
                        <option> Choisir la devise de compte </option>
                        <option value="3"> TND </option>
                    </select>

                    <label for="date"> Nature : </label>
                    <select class="form-control" name="nature">
                        <option> Choisir la nature de compte </option>
                    <?php 
                        $req = " SELECT * FROM nature " ; 
                        $res = mysqli_query ($con,$req) ; 
                        while ( $row = mysqli_fetch_array($res) ) {
                    ?>  
                        <option value="<?= $row['id'] ?>"> <?= $row ['lib_nature'] ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <br><br><br>
                <h1 class="Nexa-Bold">Autres informations :</h1>
                <br>
                <br>
                <label for="email"> E-mail : </label>
                <input type="email" name="email" id="email" class="form-control">

                <label for="password"> Mot de passe : </label>
                <input type="password" id='password1' name="mdp" class="form-control">

                <label for="password"> Confirmer mot de passe : </label>
                <input type="password" id='password2' name="password2" class="form-control">
                
            </div>
        </div>
        <div class="form-group">
         <br>   
         <div class="row">  
             <div class="col-md-4"></div>
             <div class="col-md-4">
             <input type="submit" name="inscription" onclick="return validate()" class="btn btn-warning form-control" Value="Inscription">

             </div>
             <div class="col-md-4"></div>
         </div>
            
        </div>
    </form>
</div>

<script src="layout/scripts/validation.js"></script>

<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>