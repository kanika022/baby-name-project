
<html>

	<head>
		<title>::Baby Names Project::</title>
		<link rel='stylesheet' href='style.css' />
		<script type="text/javascript" src='jquery.js'></script>
	</head>

	<body>

	<h1 align="left" style="margin:10px;color:#fff">
		::Baby Names Project::
	</h1>

	<div id='menu' style="padding:40p;margin:auto;color:#eee;font-size:30px;font-weight:bold;text-align:center;margin-top:100px">
		<div>
			What do you want to do ?
		</div>
		<br>
		<div style="text-align:left;margin:auto;display:inline-block;">
			<span class='option' id='option1'>&gt;&gt;&nbsp;Search most popular names of a year.</span>
			<br>
			<span class='option' id='option2'>&gt;&gt;&nbsp;Search change in pouplarity of a name over a period of time.</span>
		</div>
	</div>

	<table width='90%' style="margin:auto;padding:20px;box-sizing:border-box" border=0>
	 <tr>
	 	<td width="100%" align="center" style="vertical-align:top">
	 		
	 		<div id='yearwise' style="position:relative;display:none;color:#666;border-radius:15px;background-color:#eee;padding:60px 10px;font-size:16px;font-weight:bold;border:solid #222 1px">
	 			
	 			<div style="cursor:pointer;font-family:arial;position:absolute;top:10px;right:25px;font-size:30px;" class='close' onclick="showMenu('yearwise')">
	 				X
	 			</div>

	 			<h2 style="margin:0;" >Find Popular Names By Birth Year</h2>
	 			<br>
	 			<form action='yearwise.php' method='post'  >
	 				<table align="center">
	 					<tr>
	 						<td align="left" class="home-table-td" >
	 							Enter Year:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='year' placeholder='Year between 1944 to 2013' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							Select Gender:
	 						</td>
	 						<td align="left">
	 							<select name="gender">
	 								<option value='male' >Male</option>
	 								<option value='female' >Female</option>
	 								<option value='both' >Both</option>
	 							</select>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							How many results to show:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='limit' placeholder='For example: Enter 20 see top 20 names' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td colspan="2" align="center">
	 							<button class='home-submit' >Search</button>
	 						</td>
	 					</tr>

						<?php
	 						if(!empty($_GET['errorType']) && $_GET['errorType']==1 && !empty($_GET['error']))
	 						{
	 					?>
						<tr>
	 						<td colspan="2" align="center">
	 							<div style="margin:auto;color:#c22">
	 								<?php echo $_GET['error']; ?>
	 							</div>
	 						</td>
	 					</tr>	
	 					<?php } ?>

	 				</table>
	 			</form>

	 		</div>
	 	</td>
	 </tr>
	 <tr>
	 	<td width="100%" align="center" style="vertical-align:top">
	 		<div id='namewise'  style="position:relative;display:none;color:#666;background-color:#eee;border-radius:15px;padding:60px 10px;font-size:16px;font-weight:bold;border:solid #222 1px">
	 			

				<div style="cursor:pointer;font-family:arial;position:absolute;top:10px;right:25px;font-size:30px;" class='close' onclick="showMenu('namewise')">
	 				X
	 			</div>
	 			<h2 style="margin:0;" >See Change In Popularity Of Names </h2>
	 			<br>
				<form action='namewise.php' method='post'  >
	 				<table align="center">
	 					<tr>
	 						<td align="left" class="home-table-td" >
	 							Name:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='name' placeholder='Name to search for' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							From:
	 						</td>
	 						<td align="left">
	 							<input type='text' name='year' placeholder='Starting year' size="30" />
	 						</td>
	 					</tr>
	 					<tr>
	 						<td align="left" class="home-table-td">
	 							Gender:
	 						</td>
	 						<td align="left">
	 							<select name="gender" >
	 								<option value='male' >Male</option>
	 								<option value='female' >Female</option>
	 							</select>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td colspan="2" align="center">
	 							<button class='home-submit' >Search</button>
	 						</td>
	 					</tr>

	 					<?php
	 						if(!empty($_GET['errorType']) && $_GET['errorType']==2 && !empty($_GET['error']))
	 						{
	 					?>
						<tr>
	 						<td colspan="2" align="center">
	 							<div style="margin:auto;color:#c22">
	 								<?php echo $_GET['error']; ?>
	 							</div>
	 						</td>
	 					</tr>	
	 					<?php } ?>
	 				</table>
	 			</form>

	 		</div>
	 	</td>
	 </tr>
	</table>

	<script type="text/javascript">
	$("#option1").click(function(){
		$("#menu").fadeOut(function(){
			$("#yearwise").fadeIn('slow');
		});
	});
	$("#option2").click(function(){
		$("#menu").fadeOut(function(){
			$("#namewise").fadeIn('slow');
		});
	});

	function showMenu(id){
		$("#"+id).fadeOut(function(){
			$("#menu").fadeIn('slow');
		});
	};
	</script>

	</body>

</html>	
