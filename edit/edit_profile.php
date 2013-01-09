<h1>Edit profile (još ne dela!)</h1>

<?php
if(isset($_SESSION['username']))
{
  $queryUsers = "SELECT * FROM tblUser WHERE username='".$_SESSION['username']."' LIMIT 1";
  $users = mysql_query($queryUsers,$connection) or die('Error, query failed:'.mysql_error().$queryUsers);
  $user=mysql_fetch_array($users);
  $userId=$user['id'];
}

if(isset($_POST['submitVersion']))
{
    $queryUpdateDistribution = "UPDATE tblUser SET ";
    $queryUpdateDistribution.= "username = '".$_POST['username']."'";
//    $queryUpdateDistribution.= " , releaseDate = '".$_POST['releaseDate']."'";
//    $queryUpdateDistribution.= " , distributionId = '".$_POST['distributionId']."'";
    $queryUpdateDistribution.= " WHERE id = '".$userId."'";
    mysql_query($queryUpdateDistribution,$connection) or die('Error, query failed'.$queryUpdateDistribution);
 }


echo "<form action=\"index.php?menu=editversion&id=".$versionId."\" method=\"post\">";
/*
echo '<div class="form_row">';
echo '<label>Distribution</label>';
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
*/
echo '<div class="form_row">';
echo '<label>username</label>';
echo '<input class="form_input" type="text" name="username" value="'.$user['username'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<label>još nešto</label>';
echo '<input class="form_input" type="text" name="releaseDate" value="'.$version['releaseDate'].'"/>';
echo '</div>';

echo '<div class="form_row">';
echo '<input type="submit" class="small secondary button radius disabled" value="Save" name="submitVersion"> (ne radi)';
echo '</div>';


echo "</form>";


?>
