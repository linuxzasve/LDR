<?php
$distributionId=$_GET['id'];
$queryDistros = "SELECT * FROM tblDistribution WHERE id=".$distributionId.' LIMIT 1';
$distros = mysql_query($queryDistros,$connection) or die('Error, query failed:'.mysql_error());
$distro=mysql_fetch_array($distros);

echo '<h2>'.$distro['name'].'</h2>';
echo '<p><img src="icons/Globe.png" alt="Web stranica" title="Web stranica" /> <a href="'.$distro['webpage'].'">'.$distro['webpage'].'</a></p>';

echo '' .$distro['descripy']. '';
echo '<p>Verzije: ';
$queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE distributionId=".$distro['id'].' ORDER BY releaseDate';
$versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error());
while($version=mysql_fetch_array($versions))
{
  echo '<div><a href="?menu=version&id='.$version['id'].'">'.$version['version'].'</a> objavljena na '.$version['releaseDate'].'</div>';
}
echo '</p>';



if(is_logged_in())
{
  echo 'Ulogiran si, pa možeš glasati! Ali sačekaj da prvo implementiram glasanje ;)';
}
else
{
  echo 'Za glasanje se treba logirati!';
  }
?>
