<h1>Edit distribution version</h1>

<?php
$versionId=0;
if(isset($_GET['id']))
{
  $versionId=$_GET['id'];
}
if(isset($_POST['distributionId']))
{
  $distributionId=$_POST['distributionId'];
}

if(isset($_POST['submitVersion']))
{
  if($versionId==0)
  {
    $queryInsertVersion = "INSERT INTO tblDistributionVersion";

    $columns=" version";
    $values="'".$_POST['version']."'";

    $columns.=", releaseDate";
    $values.=", '".$_POST['releaseDate']."'";

    $columns.=", distributionId";
    $values.=", '".$_POST['distributionId']."'";
    
    $columns.=", ss1";
    $values.=", '".$_POST['ss1']."'";
     
    $columns.=", ss2";
    $values.=", '".$_POST['ss2']."'";
    
    $columns.=", ss3";
    $values.=", '".$_POST['ss3']."'";

    $queryInsertVersion.= "(".$columns.") VALUES (".$values.")";
    mysql_query($queryInsertVersion,$connection) or die('Error, query failed'.$queryInsertVersion);
    $versionId = mysql_insert_id();
  }
  else
  {
    $queryUpdateDistribution = "UPDATE tblDistributionVersion SET ";
    $queryUpdateDistribution.= "version = '".$_POST['version']."'";
    $queryUpdateDistribution.= " , releaseDate = '".$_POST['releaseDate']."'";
    $queryUpdateDistribution.= " , distributionId = '".$_POST['distributionId']."'";
    $queryUpdateDistribution.= " , ss1 = '".$_POST['ss1']."'";
    $queryUpdateDistribution.= " , ss2 = '".$_POST['ss2']."'";
    $queryUpdateDistribution.= " , ss3 = '".$_POST['ss3']."'";
    $queryUpdateDistribution.= " WHERE id = '".$versionId."'";
    mysql_query($queryUpdateDistribution,$connection) or die('Error, query failed'.$queryUpdateDistribution);
  }
}

if($versionId>0)
{
  $queryVersion = "SELECT * FROM tblDistributionVersion WHERE id=".$versionId.' LIMIT 1';
  $versions = mysql_query($queryVersion,$connection) or die('Error, query failed:'.mysql_error());
  $version=mysql_fetch_array($versions);
}

echo "<form action=\"index.php?menu=editversion&id=".$versionId."\" method=\"post\">";

echo '<div class="form_row">';
echo '<label>Distribucija</label>';
echo '<select class="form_input" name="distributionId"/>';
$queryDistros= "SELECT * FROM tblDistribution";
$distros = mysql_query($queryDistros,$connection) or die('Error, query failed');
//echo '<option value="0">-</option>';
while($distro=mysql_fetch_array($distros))
{
  $selected="";
  if($distro['id']==$version['distributionId'] || $distributionId==$distro['id']){$selected=" selected";}
  echo '<option value="'.$distro['id'].'"'.$selected.'>'.$distro['name'].'</option>';
}
echo '</select>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Verzija</label>';
echo '<input class="form_input" type="text" name="version" value="'.$version['version'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Datum izlaska (GGGG-MM-DD)</label>';
echo '<input class="form_input" type="text" name="releaseDate" value="'.$version['releaseDate'].'"/>';
echo '</div>';

echo '<h2>Screenshoti</h2>';
echo '<div class="form_row">';
echo '<label>Screenshot 1</label>';
echo '<input class="form_input" type="text" name="ss1" value="'.$version['ss1'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Screenshot 2</label>';
echo '<input class="form_input" type="text" name="ss2" value="'.$version['ss2'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>Screenshot 3</label>';
echo '<input class="form_input" type="text" name="ss3" value="'.$version['ss3'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<input type="submit" class="small secondary button radius" value="';
if($versionId>0){echo "Spremi";}else{echo "Stvori";}
echo '" name="submitVersion">';
echo '</div>';


echo "</form>";


?>