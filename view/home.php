<ul class="tabs-content">
        <li class="active" id="simple1Tab"><h2>Popis distribucija</h2><br>
<?php
$queryDistros = "SELECT * FROM tblDistribution ORDER BY name";
$distros = mysql_query($queryDistros,$connection) or die('Error, query failed:'.mysql_error());
while($distro=mysql_fetch_array($distros))
{
  echo '<div id="home-distro-list">';
  echo '<h4><a href="?menu=distro&id='.$distro['id'].'">'.$distro['name'].'</a></h4>';
  
  $queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE distributionId=".$distro['id'].' ORDER BY releaseDate';
  $versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error().' '.$queryDistroVersions);
  while($version=mysql_fetch_array($versions))
  {
    echo '<p  style="display:inline; padding-right:10px;">'.$version['version'].'</p>';
  }
  echo '<hr></div>';
}
?>
<!--
<ul class="pagination">
	<li class="arrow unavailable"><a href="">&laquo;</a></li>
	<li class="current"><a href="">1</a></li>
	<li><a href="">2</a></li>
	<li><a href="">3</a></li>
	<li><a href="">4</a></li>
	<li class="unavailable"><a href="">&hellip;</a></li>
	<li><a href="">12</a></li>
	<li><a href="">13</a></li>
	<li class="arrow"><a href="">&raquo;</a></li>
      </ul>
-->      <!-- <h1>Linux distributions<h1> -->