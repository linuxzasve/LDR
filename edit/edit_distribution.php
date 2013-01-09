<h1>Uredi distribuciju</h1>

<?php
$distributionId=0;
if(isset($_GET['id']))
{
  $distributionId=$_GET['id'];
}
else
{
  $distributionId=0;
}

if(isset($_POST['deleteVersion']))
{
  $versionId=$_POST['versionId'];
  if($versionId>0)
  {
    $queryDeleteVersion= "DELETE FROM tblDistributionVersion WHERE id= ".$versionId;
    mysql_query($queryDeleteVersion) or die(mysql_error());
  }
}

if(isset($_POST['submitDistribution']))
{
  if($distributionId==0)
  {
    $queryInsertDistribution = "INSERT INTO tblDistribution";

    $columns=" name";
    $values="'".$_POST['name']."'";

    $columns.=", webpage";
    $values.=", '".$_POST['webpage']."'";

    $columns.=", descripy";
    $values.=", '".$_POST['descripy']."'";

    $queryInsertDistribution.= "(".$columns.") VALUES (".$values.")";
    mysql_query($queryInsertDistribution,$connection) or die('Error, query failed'.$queryInsertSubject);
    $distributionId = mysql_insert_id();
  }
  else
  {
    $queryUpdateDistribution = "UPDATE tblDistribution SET ";
    $queryUpdateDistribution.= "name = '".$_POST['name']."'";
    $queryUpdateDistribution.= " , webpage = '".$_POST['webpage']."'";
    $queryUpdateDistribution.= " , descripy = '".$_POST['descripy']."'";
    $queryUpdateDistribution.= " WHERE id = '".$distributionId."'";
    mysql_query($queryUpdateDistribution,$connection) or die('Error, query failed'.$queryUpdateDistribution);
  }
}

if($distributionId>0)
{
  $queryDistros = "SELECT * FROM tblDistribution WHERE id=".$distributionId.' LIMIT 1';
  $distros = mysql_query($queryDistros,$connection) or die('Error, query failed:'.mysql_error());
  $distro=mysql_fetch_array($distros);
}

echo "<form action=\"index.php?menu=editdistro&id=".$distributionId."\" method=\"post\">";
echo '<div class="form_row">';
echo '<label>Ime</label>';
echo '<input class="form_input" type="text" name="name" value="'.$distro['name'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Web stranica</label>';
echo '<input class="form_input" type="text" name="webpage" value="'.$distro['webpage'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Opis</label>';
echo '<textarea name="descripy">'.$distro['descripy'].'</textarea>';
echo '</div>';

echo '<div class="form_row">';
echo '<input type="submit" class="small secondary button" value="';
if($distributionId>0){echo "Spremi";}else{echo "Stvori";}
echo '" name="submitDistribution">';
echo '</div>';

echo "</form>";

echo '<br/><br/><br/><br/>';

if($distributionId>0)
{
  echo 'Verzije:';

  echo '<form action="index.php?menu=editversion&id=0" method="post">';
  echo '<div class="right inline"><input class="small secondary button radius" type="submit" value="Dodaj verziju" /></div>';
  echo '<input name="distributionId" type="hidden" value="'.$distro['id'].'"/>';
  echo '</form><br/>';

  $queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE distributionId=".$distro['id'].' ORDER BY releaseDate';
  $versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error());
  while($version=mysql_fetch_array($versions))
  {
    echo '<div>';
    echo '<h3>'.$version['version'].'</h3>';
    echo '<div class="right inline">';
    echo '<form action="index.php?menu=editversion&id='.$version['id'].'" method="post">';
    echo '<input class="small secondary button radius" type="submit" value="Uredi verziju" />';
    echo '</form>';
    echo '<form action="index.php?menu=editdistro&id='.$distributionId.'" method="post">';
    echo '<span class="has-tip" data-width="210" title="Ova opcija nepovratno briše verziju i sve povezane ocjene!"><input class="small alert button radius" name="deleteVersion" type="submit" value="Obriši verziju" /></span>';
    echo '<input name="versionId" type="hidden" value="'.$version['id'].'"/>';
    echo '</form>';
    echo '</div>';
    echo '<hr></div>';
  }
}

?>