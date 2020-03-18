<!-- HEADER -->
<?php include 'includes/navbar.php' ?>

<!-- Print -->
    <script>
        function myFunction() {
            window.print();
        }
    </script>

<style>
    .p1 { padding : 30px 100px }
</style>

            <div class="container p1 text-center">
                <h2 class="alert alert-success text-center"> Facture </h2>
                <div  style="padding : 0px 100px">
                    <?php 
                        $id = $_GET ['id'] ; 
                        $email = $_SESSION ['email'] ; 
                        $req = " SELECT * FROM crediter_debiter WHERE id = $id " ; 
                        $res = mysqli_query ($con,$req) ;
                        while ( $row = mysqli_fetch_array($res) ) {
                    ?>
                    <br>
                    <table class="table text-center" >
                        <?php if ( $row ['nom_agence'] == 'STB Bank' ) { ?>
                            <tr><h4 class="alert alert-danger"> Credit </h4></tr>
                        <?php } ?>
                        <tr> 
                            <td> <label> Numéro  </label> </td>
                            <td> : </td> 
                            <td> <?= $row ['id'] ?> </td> 
                        </tr>
                        <tr> 
                            <td> <label> Nom Agence / Entreprise / Bank  </label> </td> 
                            <td> : </td>
                            <td> <?= $row ['nom_agence'] ?> </td> 
                        </tr>
                        <tr> 
                            <td> <label> E-mail recu  </label> </td>
                            <td> : </td> 
                            <td> <?= $row ['email_client_recu'] ?> </td>
                        </tr>
                        <tr> 
                            <td> <label> Montant </label> </td> 
                            <td> : </td>
                            <td> <?= $row ['montant'] ?> </td>
                        </tr>
                        <?php
                            $id = $row ['id_devise'] ;
                            $req = " SELECT * FROM devise WHERE id = $id " ; 
                            $res2 = mysqli_query ($con,$req) ;
                            $row2 = mysqli_fetch_array ($res2) ; 
                        ?> 
                        <tr> 
                            <td> <label> Devise </label> </td> 
                            <td> : </td>
                            <td> <?= $row2 ['lib_devise'] ?> </td>
                        </tr>
                        <?php if ( $row ['nom_agence'] == 'STB Bank' ) { ?>
                            <tr> 
                                <td> <label> Montant à retourner </label> </td> 
                                <td> : </td>
                                <td> <?= ( $row ['montant'] * 12 / 100 ) + $row ['montant'] ?> </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                    </table>
                </div>
            <div class="form-group"> 
                <button onclick="myFunction()" class="btn btn-warning">Imprimer</button>
            </div>
        </div>

<!-- FOOTER -->
    <?php include 'includes/footer.php' ?>