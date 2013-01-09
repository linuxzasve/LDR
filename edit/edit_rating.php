<h1>Ocjeni distribuciju</h1>

<?php
$ratingId=0;
if(isset($_GET['id']))
{
  $ratingId=$_GET['id'];
}
if(isset($_POST['versionId']))
{
  $versionId=$_POST['versionId'];
}

if(isset($_POST['submitRating']))
{
  if($ratingId==0)
  {
    $queryInsertRating = "INSERT INTO tblRating";

    $columns=" userId";
    $values="'".user_id()."'";

    $columns.=", versionId";
    $values.=", '".$versionId."'";

    $columns.=", rating1";
    $values.=", '".$_POST['rating1']."'";

    $columns.=", rating2";
    $values.=", '".$_POST['rating2']."'";
    
    $queryInsertRating.= "(".$columns.") VALUES (".$values.")";
    mysql_query($queryInsertRating,$connection) or die('Error, query failed'.$queryInsertRating);
    $ratingId = mysql_insert_id();
    
    echo $queryInsertRating;
  }
  else
  {
    $queryUpdateRating = "UPDATE tblRating SET ";
    $queryUpdateRating.= "userId = '".user_id()."'";
    $queryUpdateRating.= " , versionId = '".$_POST['versionId']."'";
    $queryUpdateRating.= " , rating1 = '".$_POST['rating1']."'";
    $queryUpdateRating.= " , rating2 = '".$_POST['rating2']."'";
    $queryUpdateRating.= " WHERE id = '".$versionId."'";
    mysql_query($queryUpdateRating,$connection) or die('Error, query failed'.$queryUpdateRating);
  }
}

if($ratingId>0)
{
  $queryRating = "SELECT * FROM tblRating WHERE id=".$ratingId.' LIMIT 1';
  $ratings = mysql_query($queryRating,$connection) or die('Error, query failed:'.mysql_error());
  $rating=mysql_fetch_array($ratings);
  $versionId=$rating['versionId'];
}

$queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE id=".$versionId.' LIMIT 1';
$versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error().$queryDistroVersions);
$version=mysql_fetch_array($versions);

$queryDistros = "SELECT * FROM tblDistribution WHERE id=".$version['distributionId'].' LIMIT 1';
$distros = mysql_query($queryDistros,$connection) or die('xxError, query failed:'.mysql_error().$queryDistros);
$distro=mysql_fetch_array($distros);

echo "<form action=\"index.php?menu=editrating&id=".$ratingId."\" method=\"post\">";
echo '<input name="versionId" type="hidden" value="'.$versionId.'"/>';

echo '<div class="form_row">';
echo '<label>Distribucija</label>';
echo '<input readonly class="form_input" type="text" name="version" value="'.$distro['name'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Verzija</label>';
echo '<input readonly class="form_input" type="text" name="version" value="'.$version['version'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Datum objave</label>';
echo '<input readonly class="form_input" type="text" name="releaseDate" value="'.$version['releaseDate'].'"/>';
echo '</div>';


echo '<div class="form_row">';
echo '<label>Stabilnost</label>';
echo '<input id="amount1" name="rating1" type="range">';
echo '</div>';

echo '<br><br>';

echo '<div class="form_row">';
echo '<label>Hardware</label>';
echo '<input id="amount2" name="rating2" type="range">';
echo '</div>';

/*
echo '<div class="form_row">';
echo '<label>Stabilnost</label>';
echo '<input class="form_input" type="text" name="rating1" value="'.$rating['rating1'].'"/>';
echo '</div>';


echo '<div class="form_row">';
echo '<label>Hardware</label>';
echo '<input class="form_input" type="text" name="rating2" value="'.$rating['rating2'].'"/>';
echo '</div>';
*/

echo '<br><br>Imate poteškoća s glasanjem? Pokušajte pristupiti ovaj stranici iz <a href="fallback.php">fallback načina rada</a>.
';


echo '<div class="form_row">';
echo '<input type="submit" class="small secondary button radius" value="Glasaj!" name="submitRating">';
echo '</div>';


echo "</form>";


?>
	
	
	







<meta charset="utf-8">
	
	
	
	
	
	
	

<script>
$(function() {
  $( "#slider-range-min1" ).slider({
    range: "min",
    value:<?php echo $rating['rating1'];?>,
    min: 0,
    max: 10,
    step:0.5,
    slide: function( event, ui ) {
      $( "#amount1" ).val(  ui.value );
    }
  });
  $( "#amount1" ).val(  $( "#slider-range-min1" ).slider( "value" ) );
});
</script>

<script>
$(function() {
  $( "#slider-range-min2" ).slider({
    range: "min",
    value:<?php echo $rating['rating2'];?>,
    min: 0,
    max: 10,
    step:0.5,
    slide: function( event, ui ) {
      $( "#amount2" ).val(  ui.value );
    }
  });
  $( "#amount2" ).val(  $( "#slider-range-min2" ).slider( "value" ) );
});
</script>