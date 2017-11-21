<?php
require_once ('../_assets/_inc/init.inc.php');
require_once ('../_assets/_inc/haut.inc.php');
require_once ('../_assets/_inc/header.inc.php');

?>


    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Back-Office</h1>
          <div class="list-group">
            <a href="#" class="list-group-item">Category 1</a>
            <a href="#" class="list-group-item">Category 2</a>
            <a href="#" class="list-group-item">Category 3</a>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

          <div class="row">

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#">Item One</a>
                  </h4>
                    <?php
                    $resultat = $bdd -> query("SELECT salle.titre, SUM(avis.note) FROM avis LEFT JOIN salle ON avis.id_salle = salle.id_salle GROUP BY salle.titre ORDER BY SUM(avis.note) DESC LIMIT 0,5;");
                    echo '<h5>Top 5 des salles les mieux notées : </h5>' ;
                    echo '<table border="1">';
                    echo '<tr>'; 
                    for($i = 0; $i < $resultat -> columnCount(); $i++){
                      $champs = $resultat -> getColumnMeta($i);
                      echo '<th>' . $champs['name'] . '</th>';        
                    }
                    echo '</tr>';
                    while ($infos = $resultat -> fetch(PDO::FETCH_ASSOC)) {
                      echo '<tr>';  
                      foreach ($infos as $key => $value) {
                      echo '<td>' . $value . '</td>';
                      }
                    } 
                    echo '</tr>';
                    echo '</table><br/><br/>';
                    ?>
                </div>
                <div class="card-footer">
                  <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
              </div>
            </div>

          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
<?php
require_once ('../_assets/_inc/footer.inc.php');
?>