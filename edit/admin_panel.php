<ul class="tabs-content">
        <li class="active" id="simple1Tab"><h2>Administracija</h2><br>

<?php
if(isset($_POST['deleteDistribution']))
{
  $distributionId=$_POST['distributionId'];
  if($distributionId>0)
  {		
    $queryDeleteVersions = "DELETE FROM tblDistributionVersion WHERE distributionId = ".$distributionId;
    mysql_query($queryDeleteVersions) or die(mysql_error().$queryDeleteVersions);
    $queryDeleteDistributions = "DELETE FROM tblDistribution WHERE id = ".$distributionId;
    mysql_query($queryDeleteDistributions) or die(mysql_error().$queryDeleteDistributions);
  }
}


echo '<div id="admin-home-distro" style="text:right-inline;">';
echo '<a href="index.php?menu=editdistro&id=0" class="bold button">';
echo '<img src="icons/Add.png" /> Nova distribucija';
echo '</a><a href="index.php?menu=upload" class="bold button"><img src="icons/Up.png" />Prenesi datoteku</img></a>';
echo '<hr></div>';

$queryDistros = "SELECT * FROM tblDistribution ORDER BY name";
$distros = mysql_query($queryDistros,$connection) or die('Error, query failed:'.mysql_error());
while($distro=mysql_fetch_array($distros))
{
  //echo '<div><h2>'.$distro['name'].'</h2>';

    echo '<h4>'.$distro['name'].'</h4>';
 
  echo '<div style="text-align:right;">';
  echo '<form action="index.php?menu=editdistro&id='.$distro['id'].'" method="post">';
  echo '<input class="button" type="submit" value="Uredi" />';
  echo '</form>';
  //echo '</div>';
  
  //echo '<div class="form_row">';
  echo '<form action="index.php?menu=admin" method="post">';
  echo '<input class="button" name="deleteDistribution" type="submit" value="Obriši" /></span>';
  echo '<input name="distributionId" type="hidden" value="'.$distro['id'].'"/>';
  echo '</form>';
  echo '</div>';
  
  echo 'Verzije: ';
  $queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE distributionId=".$distro['id'].' ORDER BY releaseDate';
  $versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error());
  while($version=mysql_fetch_array($versions))
  {
    echo '<p  style="display:inline; padding-right:10px;">'.$version['version'].'</p>';
  }
  echo '<hr>';
}
?>