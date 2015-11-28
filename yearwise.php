<?php

	$error=null;
	
	//Input validation
	if(empty($_POST['year']) || ((int)$_POST['year'] < 1944 ) || ((int)$_POST['year'] > 2013 ) )
	{
		$error="Enter correct year";
		header("location: index.php?errorType=1&error=".$error);
		die();
	}

	if( empty($_POST['limit']) )
	{
		$error="Enter how many names to show";
		header("location: index.php?errorType=1&error=".$error);
		die();
	}

	//Set the limit
	$top_limit=(int)$_POST['limit'];

	$show_male=false;
	$show_female=false;

	//Set the gender
	switch($_POST['gender'])
	{
		case 'male':
			$show_male=true;
			break;
		case 'female':
			$show_female=true;
			break;
		case 'both':
			$show_male=true;
			$show_female=true;
			break;
	}

	//Set the year
	$year=$_POST['year'];

	$records=array(); //Holds the extracted records

	//Male Records
	if($show_male)
	{

		$records['male']=array();

		//Read the correct csv file
		$fh=fopen("names/male_cy1996_top.csv","r");

		fgetcsv($fh);//Discard the headers


		//Iterate through the records unless eof or limit is reached
		while(!feof($fh))
		{
			$record=fgetcsv($fh);
			
			$record[2]=(int)preg_replace("/[^0-9]/", "", $record[2]);

			if($record[2]>($top_limit))
				break;


			$records['male'][]=$record;

		}

		fclose($fh);
	}
	//Male Records
	if($show_female)
	{
		$records['female']=array();

		//Read the correct csv file
		$fh=fopen("names/female_cy1996_top.csv","r");

		fgetcsv($fh);//Discard the headers


		//Iterate through the records unless eof or limit is reached
		while(!feof($fh))
		{
			$record=fgetcsv($fh);

			$record[2]=(int)preg_replace("/[^0-9]/", "", $record[2]);

			if($record[2]>($top_limit))
				break;

			$records['female'][]=$record;

		}
		
		fclose($fh);
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

	<table width='90%' style="margin:auto;padding:0px;box-sizing:border-box" border=0 >

	<tr>
		<td align="center" style="color:#fff;font-size:20px;padding:10px">
			Top <?php echo $top_limit; ?> names of year <?php echo $year; ?>
			<br>
			<div style='float:left'>
				<a href='index.php' style="font-size:16px;color:#aaf" >Go To Home </a>
			</div>
		</td>t
	</tr>

	 <tr>

 	<?php if($show_male) { ?>

	 	<td width="50%" align="center" style="padding-right:20px;vertical-align:top">
	 		
	 		<div style="background-color:#fff;padding:20px 10px;font-size:16px;font-weight:bold;border:solid #222 1px">
	 			<table style="width:90%" class="striped-table" cellspacing="0">
	 				<tr style="background-color:#000;color:#fff">
	 					<td align="center" width="34%">
	 						<h3 style="margin:0;text-decoration:none">Rank</h3>
	 					</td>
	 					<td align="center" width="33%">
	 						<h3 style="margin:0;text-decoration:none">Name</h3>
	 					</td>
	 					<td align="center" width="33%">
	 						<h3 style="margin:0;text-decoration:none">Number of Births</h3>
	 					</td>
	 				</tr>

	 				<?php
	 					foreach($records['male'] as $record)
	 					{
	 				?>
	 				<tr>
	 					<td align="center" width="34%">
	 						<?php echo $record[2]; ?>
	 					</td>
	 					<td align="center" width="33%">
	 						<?php echo $record[0]; ?>
	 					</td>
	 					<td align="center" width="33%">
	 						<?php echo $record[1]; ?>
	 					</td>
	 				</tr>
	 				<?php
	 					}
	 				?>
	 			</table>
	 			
	 		</div>
	 	</td>

	 <?php } if($show_female) { ?>

	 	<td width="50%" align="center" style="padding-right:20px;vertical-align:top">
	 		<div style="background-color:#ddd;padding:7px;font-size:18px;font-weight:bold;border:solid #222 1px">
	 			Female Names Popularity
	 		</div>

	 		<div style="background-color:#fff;padding:20px 10px;font-size:16px;font-weight:bold;border:solid #222 1px">
	 			<table style="width:90%" class="striped-table">
	 				<tr style="background-color:#aaa">
	 					<td align="center" width="34%">
	 						<h3 style="margin:0;text-decoration:none">Rank</h3>
	 					</td>
	 					<td align="center" width="33%">
	 						<h3 style="margin:0;text-decoration:none">Name</h3>
	 					</td>
	 					<td align="center" width="33%">
	 						<h3 style="margin:0;text-decoration:none">Number of Births</h3>
	 					</td>
	 				</tr>

	 				<?php
	 					foreach($records['female'] as $record)
	 					{
	 				?>
	 				<tr>
	 					<td align="center" width="34%">
	 						<?php echo $record[2]; ?>
	 					</td>
	 					<td align="center" width="33%">
	 						<?php echo $record[0]; ?>
	 					</td>
	 					<td align="center" width="33%">
	 						<?php echo $record[1]; ?>
	 					</td>
	 				</tr>
	 				<?php
	 					}
	 				?>
	 			</table>
	 			
	 		</div>
	 	</td>
	 <?php } ?>
	 </tr>
	</table>

	</body>

</html>	
