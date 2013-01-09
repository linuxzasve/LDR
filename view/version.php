<?php
$versionId=$_GET['id'];
$queryDistroVersions = "SELECT * FROM tblDistributionVersion WHERE id=".$versionId.' LIMIT 1';
$versions = mysql_query($queryDistroVersions,$connection) or die('Error, query failed:'.mysql_error().$queryDistroVersions);
$version=mysql_fetch_array($versions);

$queryDistros = "SELECT * FROM tblDistribution WHERE id=".$version['distributionId'].' LIMIT 1';
$distros = mysql_query($queryDistros,$connection) or die('Error, query failed:'.mysql_error().$queryDistros);
$distro=mysql_fetch_array($distros);

echo '<h2>'.$distro['name'].' '.$version['version'].'</h2>';
echo '<p><img src="icons/Globe.png" alt="Web stranica" title="Web stranica" /> <a href="'.$distro['webpage'].'">'.$distro['webpage'].'</a></p>';
echo '<div class="row">
    <div class="twelve columns">
      <h3>Screenshoti</h3>
      <div id="featured">
      <img src="'.$version['ss1'].'">
      <img src="'.$version['ss2'].'">
      <img src="'.$version['ss3'].'"></div></div></div>';

echo '</p>';

      
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {

	window.chart = new Highcharts.Chart({
	           
	colors: [
//	'rgba(50,205,50,0.75)',
//	'rgba(238,221,130,0.75)',
	'#32cd32', 
	'#daa520', 
	'#9900CC'
], 
	    chart: {
	        renderTo: 'characteristics',
	        polar: true,
	        type: 'line'
	    },
	    
	    title: {
	        text: 'General Characteristics',
	        x: -80
	    },
	    
	    pane: {
	    	size: '80%'
	    },
	    
	    xAxis: {
	        categories: ['Hardware','Speed','Desktop','Software','Comunity','Support','Idiot-proof','Server','Stabillity'],
	        tickmarkPlacement: 'on',
	        lineWidth: 0
	    },
	        
	    yAxis: {
		labels: [],
	        gridLineInterpolation: 'polygon',
	        lineWidth: 0,
	        min: 0,
		max: 10
	    },
	    
	    tooltip: {
	    	shared: true,
	        valuePrefix: 'LZS grade: '
	    },
	    
	    legend: {
	        align: 'right',
	        verticalAlign: 'top',
	        y: 100,
	        layout: 'vertical'
	    },
	    
	    series: [{
		type: 'area',
	        name: 'openSUSE 12.2',
	        data: [8.5,9.6,9.8,9.6,9.2,7.8,7.0,7.5,9.4],
	        pointPlacement: 'on'
	    }, {
		type: 'area',
	        name: 'Ubuntu 12.04',
	        data: [8.7,8.4,8.8,9.7,9.7,9.0,8.5,8.3,8.3],
	        pointPlacement: 'on'
	    }, {
		type: 'area',
	        name: 'CentOS 6.3',
	        data: [8.7,8.8,8.2,8.4,7.0,10.0,6.5,9.7,9.8],
	        pointPlacement: 'on'
	    }]
	});
	window.chart.series[2].hide();
});
		</script>

<script type="text/javascript">
$(function () {

	window.chart = new Highcharts.Chart({
	           
	colors: [
//	'rgba(50,205,50,0.75)',
//	'rgba(238,221,130,0.75)',
	'#32cd32', 
	'#daa520', 
	'#9900CC'
], 
	    chart: {
	        renderTo: 'environments',
	        polar: true,
	        type: 'line'
	    },
	    
	    title: {
	        text: 'Desktop Environments',
	        x: -80
	    },
	    
	    pane: {
	    	size: '80%'
	    },
	    
	    xAxis: {
	        categories: ['KDE','Gnome','Unity','XFCE','LXDE'],
	        tickmarkPlacement: 'on',
	        lineWidth: 0
	    },
	        
	    yAxis: {
		labels: [],
	        gridLineInterpolation: 'polygon',
	        lineWidth: 0,
	        tickmarkPlacement: 'off',
	        min: 0,
		max: 10
	    },
	    
	    tooltip: {
	    	shared: true,
	        valuePrefix: 'LZS grade: '
	    },
	    
	    legend: {
	        align: 'right',
	        verticalAlign: 'top',
	        y: 100,
	        layout: 'vertical'
	    },
	    
	    series: [{
		type: 'area',
	        name: 'openSUSE 12.2',
	        data: [10,7,3,7,7],
	        pointPlacement: 'on'
	    }, {
		type: 'area',
	        name: 'Ubuntu 12.04',
	        data: [8,6,10,6,6],
	        pointPlacement: 'on'
	    }, {
		type: 'area',
	        name: 'CentOS 6.3',
	        data: [8,8,0,8,8],
	        pointPlacement: 'on'
	    }]
	});
	window.chart.series[2].hide();
});
		</script>

	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/highcharts-more.js"></script>
<script src="js/modules/exporting.js"></script>
<?
if(is_logged_in())
{
  echo 'Ulogiran si, pa možeš glasati! Ali sačekaj da prvo implementiram glasanje ;)<br/>';
  
  
  $queryRatings = "SELECT * FROM tblRating WHERE userId=".user_id().' AND versionId='.$versionId.' LIMIT 1';
  $ratings = mysql_query($queryRatings,$connection) or die('Error, query failed:'.mysql_error().$queryRatings);
  if (mysql_num_rows($ratings) > 0)
  {
    $rating=mysql_fetch_array($ratings);
    echo 'Već si glasao!<br/>';
    //echo '<a href="?menu=editrating&id='.$rating['id'].'">Promjeni ocjenu</a>';
    
    
  echo '<form action="index.php?menu=editrating&id='.$rating['id'].'" method="post">';
  echo '<input class="small secondary button radius" type="submit" value="Promjeni ocjene!!" />';
  echo '<input name="versionId" type="hidden" value="'.$versionId.'"/>';
  echo '</form><br/>';
  
  }
  else
  {
    echo 'Nisi glasao!<br/>';
//    echo '<a href="?menu=editrating&id=0">Glasaj</a>';
  echo '<form action="?menu=editrating&id=0" method="post">';
  echo '<input class="small secondary button radius" type="submit" value="Glasaj!" />';
  echo '<input name="versionId" type="hidden" value="'.$versionId.'"/>';
  echo '</form><br/>';
    }
}
else
{
  echo 'Za glasanje se treba logirati!<br/>';
  }
?>
<div id="characteristics" style="width: 700px; height: 400px; margin: 0 auto"></div>
<div id="environments" style="width: 700px; height: 300px; margin: 0 auto"></div>
