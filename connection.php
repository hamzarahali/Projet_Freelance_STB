<!-- HEADER --> 
    <?php include 'includes/navbar.php' ?>

<div class="container text-center" style="margin: 1% auto;">

<!-- CONNECTION -->
    <?php 
        if ( isset ($_POST ['connection'] ) ) {
            $email = $_POST ['email'] ; 
            $mdp = md5($_POST ['mdp']) ; 

            $req = " SELECT * FROM client WHERE email LIKE '$email' AND mdp LIKE '$mdp'" ; 
            $res = mysqli_query ($con,$req) ; 
            $num = mysqli_num_rows ($res) ; 

            if ( $num == 0 ) 
                echo "<h5 class='alert alert-danger'> E-mail ou Mot de passe incorrecte </h5>" ;
            else {
                session_start();
                $_SESSION ['email'] = $email ; 
                header ("location: ./") ;
            }
        }
    ?>

    <div class="login-header">
        <h1>Ouvrir votre compte</h1>
        <a href="inscription.php"><h6> vous n'avez pas de compte ? S'inscrire maintenant </h6></a>
        <hr width=90%>
    </div>
    <form action="" method="POST">
        <input placeholder="Email" type="email" name="email" class="form-control" id="email"
            style="width: 230px;margin: 30px auto;">
        <input placeholder="Password" type="password" name="mdp" class="form-control" id="password"
            style="width: 230px;margin: 30px auto;">

        <div class="form-group">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-2">
                <input type="submit" name="connection" class="form-control login-btn btn-warning" Value="Connection">
                </div>
                <div class="col-md-5"></div>
            </div>
        </div>
    </form>
</div>

<!-- FOOTER  -->
    <?php include 'includes/footer.php' ?>