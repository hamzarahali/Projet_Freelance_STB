<!-- HEADER --> 
    <?php include 'includes/navbar.php' ?>
    
    <div class="container" style="padding: 30px 190px;">

<!-- MODIFIER COMPTE -->
    <?php
        if ( isset ( $_POST ['modifier'] ) ) {
            $nom = $_POST ['nom'] ;
            $prenom = $_POST ['prenom'] ; 
            $pays = $_POST ['pays'] ; 
            $date = $_POST ['date'] ; 
            $devise = $_POST ['devise'] ;
            $nature = $_POST ['nature'] ; 
            $email = $_SESSION ['email'] ; 
            $mdp = md5($_POST ['mdp']) ; 

            $req = " UPDATE client SET nom = '$nom' , prenom = '$prenom' , pays = '$pays' , date = '$date' ," ;
            $req .= " id_devise = '$devise' , id_nature = '$nature' , mdp = '$mdp' " ; 
            $req .= " WHERE email LIKE '$email' " ; 
            
            $res = mysqli_query ($con,$req) ; 
            if ( $res ) 
                echo "<h3 class='alert alert-success text-center'> Modification avec success </h3>" ; 
        }
    ?>

    <!-- SUPPRIMER COMPTE -->
    <?php 
        if ( isset ( $_POST ['supprimer'] ) ) {
            $email = $_SESSION ['email'] ; 

            $req = " DELETE FROM client WHERE email LIKE '$email' " ;
            $res = mysqli_query ($con,$req) ; 
            if ( $res ) {
                session_destroy();
                header ("location: ./") ;
            }
        }
    ?>

<!-- COMPTE COURANT -->
    <?php 
        $email = $_SESSION ['email'] ; 

        $req = " SELECT * FROM client WHERE email LIKE '$email' " ; 
        $res = mysqli_query ( $con , $req ) ; 
        while ( $row = mysqli_fetch_assoc ($res) ) {
    ?>

    
        <form action="" method="POST">
            <h3 class="Nexa-Bold alert alert-primary" style='text-align :center;margin-bottom:30px'> Mon compte </h3>
            <div class="row">
                <div class="col-md-6" style="border-right: 1px solid #00000030;padding: 30px;">
                    <div class="form-group">
                        <br> <br>
                        <label for="firstname"> Nom : </label>
                        <input type="text" name="nom" id="firstname" class="form-control" value="<?= $row ['nom'] ?>" required>
    
                        <label for="lastname"> Prénom : </label>
                        <input type="text" name="prenom" id="lastname" class="form-control" value="<?= $row ['prenom'] ?>"required>
    
                        <label for="country"> Pays : </label>
                        <input type="text" name="pays" id="country" class="form-control" value="<?= $row ['pays'] ?>"required/>
    
                        <label for="date"> Date de naissance : </label>
                        <input type="date" name="date" id="date" class="form-control" max="2019-06-25" value="<?= $row ['date'] ?>"required>

                        <label for="date"> Devise : </label>
                        <select class="form-control" name="devise" required>
                            <option> Choisir la devise de compte </option>
                            <?php 
                                $req = "SELECT * FROM devise " ; 
                                $res = mysqli_query ($con,$req) ; 
                                while ( $row = mysqli_fetch_array($res) ) {
                            ?>  
                            <option value="<?= $row['id'] ?>"> <?= $row ['lib_devise'] ?> </option>
                            <?php } ?>
                        </select>

                        <label for="date"> Nature : </label>
                        <select class="form-control" name="nature"required>
                            <option> Choisir la nature de compte </option>
                            <?php 
                                $req = "SELECT * FROM nature " ; 
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
                    <input type="email" name="email" id="email" class="form-control" value="<?= $row ['email'] ?>" >
    
                    <label for="password"> Mot de passe : </label>
                    <input type="password" id='password1' name="mdp" class="form-control" value="<?= $row ['mdp'] ?>"> 
    
                    <label for="password"> Confirmer mot de passe : </label>
                    <input type="password" id='password2' name="password2" class="form-control">
                    
                </div>
            </div>
            <div class="form-group">
             <br>   
             <div class="row">  
                 <div class="col-md-4"></div>
                 <div class="col-md-4">
                 <input type="submit" name="modifier" onclick="return validate()" class="btn btn-warning form-control" Value="Modifier">
    
                 </div>
                 <div class="col-md-4"></div>
             </div>
            </div>
        </form>
        <?php } ?>
        <div class="form-group" >
             <div class="row">  
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="" method="POST">
                        <input type="submit" name="supprimer" style="text-transform: lowercase;"onclick="return validate()" class="btn btn-danger form-control" Value="Supprimer compte">
                    </form>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    
<!-- VALIDATION DU FORMULAIRE -->
    <script src="layout/scripts/validation.js"></script>
    
<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>