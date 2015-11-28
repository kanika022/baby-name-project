<?php

	$error=null;


	if( empty($_POST['name']) )
	{
		$error="Please enter a Name";
		header("location: index.php?errorType=2&error=".$error);
		die();
	}

	//Input validation
	if(empty($_POST['year']) || ((int)$_POST['year'] < 1944 ) || ((int)$_POST['year'] > 2013 ) )
	{
		$error="Please enter a valid Year between 1944 to 2013";
		header("location: index.php?errorType=2&error=".$error);
		die();
	}

	//Set the year
	$year=(int)$_POST['year'];
	$name=$_POST['name'];
	$name_upper=strtoupper($_POST['name']);
	$gender=$_POST['gender'];

	$nameList=array(); //Holds the matched names incase its a partial search

	for($i=$year;$i<2014;$i++)
	{
		$fh=fopen("names/".$gender."_cy".$i."_top.csv","r");

		while(!feof($fh))
		{
			$record=fgetcsv($fh);

			if(strpos($record[0],$name_upper) === 0 )
			{
					if(empty($nameList[$record[0]]))
					{
						$nameList[$record[0]]=array();
					}
					$record[2]=(int)preg_replace("/[^0-9]/", "", $record[2]);
					$nameList[$record[0]][$i]=array($record[1],$record[2]);
			}

		}
		fclose($fh);
	}


	//Make bar graphs for the names
	foreach($nameList as $_name=>$data)
	{
		$amounts=array();
		$labels=array();
		foreach($data as $year=>$val)
		{
			$amounts[]=$val[0];
			$labels[]=$year;
		}
		$nameList[$_name]['graph']=makeGraph($amounts,$labels);
	}

?>


<html>

	<head>
		<title>::Baby Names::</title>
		<link rel='stylesheet' href='style.css' />
	</head>

	<body>

	<h1 align="left" style="margin:10px;color:#fff">
		::Baby Names::
	</h1>

	<table width='99%' style="margin:auto;padding:20px;box-sizing:border-box" border=0 >

	<tr>
		<td align="center" style="color:#fff;font-size:20px;padding:10px">
			<div style='float:left'>
				<a href='index.php' style="font-size:16px;color:#aaf" >Go To Home </a>
			</div>
		</td>
	</tr>

	 <tr>

	 	<td width="50%" align="center" style="padding-right:20px;vertical-align:top">

	 		<?php
	 			foreach($nameList as $name=>$record )
	 			{
	 				$img=$record['graph'];
	 				unset($record['graph']);
	 		?>
		 		<div style="background-color:#fff;padding:20px 10px;font-size:16px;font-weight:bold;border:solid #222 1px">

		 			<div style="margin:10px;background-color:#eee;border-radius:10px;padding:10px;border:solid #222 1px;text-align:left;color:#233">
		 				<center><?php echo $name; ?></center>
		 				<table width="100%">
			 				<tr>
			 					<td  align="center" >
			 						<?php echo "<img src='data:image/jpeg;base64,".$img."' />"; ?>

			 					</td>
			 				</tr>
		 				</table>
		 			</div>

		 		</div>
		 	<?php
		 		}
		 	?>
	 	</td>
	 </tr>

	</table>

	</body>

</html>


<?php
function makeGraph($values,$labels){
		$values[]='0';
		$labels[]='';

	// Standard inclusions
	 include_once("charts/pChart.class");
	 include_once("charts/pData.class");

	 // Dataset definition
	 $DataSet = new pData;
	 $DataSet->AddPoint($values,"Serie2");
	 $DataSet->AddPoint($labels,"Xlabel");

	 $DataSet->AddSerie("Serie2");
	 $DataSet->SetAbsciseLabelSerie('Xlabel');

	 $DataSet->SetSerieName("No Of Births","Serie2");

	 // Initialise the graph
	 $Test = new pChart(700,230);
	 $Test->setFontProperties("Fonts/tahoma.ttf",8);
	 $Test->setGraphArea(50,30,585,200);
	 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);
	 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);
	 $Test->drawGraphArea(255,255,255,TRUE);
	 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2,TRUE);
	 $Test->drawGrid(4,TRUE,230,230,230,50);

	 // Draw the 0 line
	 $Test->setFontProperties("Fonts/tahoma.ttf",6);
	 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

	 // Draw the bar graph
	 $Test->drawOverlayBarGraph($DataSet->GetData(),$DataSet->GetDataDescription());

	 // Finish the graph
	 $Test->setFontProperties("Fonts/tahoma.ttf",8);
	 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);
	 $Test->setFontProperties("Fonts/tahoma.ttf",10);
	 $Test->drawTitle(50,22,"Change in name popularity",50,50,50,585);


	 ob_start();
	 $Test->Stroke();

	 $img=ob_get_clean();
	 $img=base64_encode($img);

	 return $img;
}

?>
