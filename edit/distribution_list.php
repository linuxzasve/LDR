<h1>Administrate distributions</h1>
<?php
//if(is_logged_in())
{

	if(isset($_POST['removeSubject']))
	{
		$subjectId=$_POST['subjectId'];
		if($subjectId>0)
		{	
			$queryDeleteLecturers= "DELETE FROM tblLecturers WHERE subjectID = ".$subjectId;
			mysql_query($queryDeleteLecturers) or die(mysql_error());	
			$queryDeleteSubject= "DELETE FROM tblSubjects WHERE id = ".$subjectId;
			mysql_query($queryDeleteSubject) or die(mysql_error());
			$queryDeletePermissions = "DELETE FROM tblPermissions WHERE ObjectType = 2 AND ObjectId = ".$subjectId;
			mysql_query($queryDeletePermissions) or die(mysql_error());
		}
	}	
	
	//echo "<table cellspacing=\"0\" cellpadding=\"0\">";
	//echo "<tr ><td colspan=5>";	
	//echo '<div id="admin-distribution-list">';	
	echo "<form action=\"index.php?menu=admin&id=0\" method=\"post\">";
	echo "<input style=\"float:left;\"class=\"form_submit\" type=\"submit\" value=\"New subject\" name=\"editSubject\"/>";
	echo "</form>";
	//echo '</div>';
}
?>
      


<?php
if(is_logged_in())
{
	$querySubjects = "SELECT * FROM tblSubjects ORDER BY Study,Semestar";	
	$subjects = mysql_query($querySubjects,$connection) or die('Error, query failed');
	//echo "</td></tr>";
	//echo "<tr><th>Naslov</th><th>Autor</th><th>Objava</th><th>Zadnja promjena</th><th></th></tr>";
	while($subject=mysql_fetch_array($subjects))
	{
		echo '<div class="archive_post" style="padding-top:15px;">';
		echo '<div style="width:600px; float:left; clear:none; margin:0; padding:0; display:block;">';
		echo '<h4>'.SubjectEditLink($subject).'</h4>';
		/*
		$queryAuthor= "SELECT * FROM tblUsers WHERE id=".$news['AuthorID']." LIMIT 1";
		$authors = mysql_query($queryAuthor,$connection) or die('Error, query failed');
		$autor=mysql_fetch_array($authors);

		echo 'Posted by <a href="#">'.JustName($autor).'</a></br>'; 
		echo 'on '.date("Y. M d. H:i", strtotime($news['PostDate']))."</br>";
		echo 'last edited on '.date("Y. M d. H:i", strtotime($news['EditDate']));
		*/
		//echo StudyNameEng($subject['Study']);
		
		if($subject['Study'] == 1)
			echo "Undergraduate";
		else if($subject['Study'] == 2)
			echo "Graduate";
		
		echo '</br>Semester: '.$subject['Semestar'];
		echo '</div>';
		
		echo '<div style="width:200px; float:left; clear:none; margin:0; padding:0; display:block;">';
		echo "<form action=\"index.php?menu=newslist\" method=\"post\">";
		$disabled='';
		if(!canDelete(2,$subject['id'],$_SESSION['userId'])) $disabled=' disabled';
		echo "<input class=\"form_submit\" type=\"submit\" value=\"Delete subject\" name=\"removeSubject\"".$disabled." />";
		echo "<input name=\"subjectId\" type=\"hidden\" value=\"".$subject['id']."\" />";
		echo "</form>";
		echo '</div>';

		echo "</div>";
	}
//	echo "</table>";
}
else
{
	echo "<p>:(</p>";
}
echo '</div>';
?>
