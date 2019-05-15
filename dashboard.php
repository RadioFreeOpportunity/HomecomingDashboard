<?php
//This code is mega ugly and is mainly just a proof of concept

$content=file_get_contents("http://127.0.0.1:8913/paragon/dbserver"); //URL for JSON data from Server API
$data=json_decode($content); //Decode into somehting useful

function barPercentColor($percent)
{
	if($percent <= 50)
	{
		return "bg-success";
	}
	else if ($percent >= 50)
	{
		if($percent <= 75)
		{
			return "bg-warning";
		}
		else {
			return "bg-danger";
		}
	}
}


		//get values and do math for mem/cpu
		$physMemUsed = $data->Paragon->dbserver->TotalPhysUsed;
		$physMemMax = $data->Paragon->dbserver->MaxPhysAvail;
		$memPhysUsedPercent = $physMemUsed / $physMemMax * 100;
		$memPhysUsedRound = round($memPhysUsedPercent);
		$memPhysBarColor = barPercentColor($memPhysUsedRound);
		
		$virtMemUsed = $data->Paragon->dbserver->TotalVirtUsed;
		$virtMemMax = $data->Paragon->dbserver->MaxVirtAvail;
		$memVirtUsedPercent = $virtMemUsed / $virtMemMax * 100;
		$memVirtUsedRound = round($memVirtUsedPercent);
		$memVirtBarColor = barPercentColor($memVirtUsedRound);
		
		$avgCPU = $data->Paragon->dbserver->AvgCPU;
		$avgCPUMax = $data->Paragon->dbserver->MaxCPU;
		$avgCPUPercent = $avgCPU / $avgCPUMax * 100;
		$avgCPURound = round($avgCPUPercent);
		$avgCPUBarColor = barPercentColor($avgCPURound);
		
		$avgCPU60 = $data->Paragon->dbserver->AvgCPU60;
		$avgCPU60Max = $data->Paragon->dbserver->MaxCPU60;
		$avgCPUPercent = $avgCPU60 / $avgCPU60Max * 100;
		$avgCPU60Round = round($avgCPUPercent);
		$avgCPU60BarColor = barPercentColor($avgCPU60Round);
		
		
		?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport"
     content="width=device-width, initial-scale=1, user-scalable=yes">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</head>
<body>
 
<div class="container-fluid">
  <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10"></div>
      <div class="col-md-1"></div>
  </div>
 
  <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-7">
        <h1>Server Dashboard</h1>
        <h2>Server: Paragon</h2>
		<h3>Status: <?php echo $data->Paragon->status;?></h3>
		<h3>Players Online: <?php echo $data->Paragon->dbserver->numPlaying;?></h3> 
		<h5 class="text-primary">Heroes: <?php echo $data->Paragon->dbserver->numHeroes;?></h5><h5 class="text-danger"> Villains: <?php echo $data->Paragon->dbserver->numVillains;?></h5>
		<h3>Mapservers Online: <?php echo $data->Paragon->dbserver->MapServers;?></h3>
		<h4>Physical Memory Usage:</h4>
		
		
		
		<div class="progress" style="height: 25px;">
		<?php
		echo "<div class='progress-bar ".$memPhysBarColor."' role='progressbar' style='width: ".$memPhysUsedRound."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$memPhysUsedRound."% - [".$physMemUsed."/".$physMemMax."]</div>";
		?>
		</div>
		<h4>Virtual Memory Usage:</h4>
		<div class="progress" style="height: 25px;">
		<?php
		echo "<div class='progress-bar ".$memVirtBarColor."' role='progressbar' style='width: ".$memVirtUsedRound."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$memVirtUsedRound."% - [".$virtMemUsed."/".$virtMemMax."]</div>";
		?>
		</div>
		
		<h4>CPU Usage:</h4>
		<div class="progress" style="height: 25px;">
		<?php
		echo "<div class='progress-bar ".$avgCPUBarColor."' role='progressbar' style='width: ".$avgCPURound."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$avgCPURound."% - [".$avgCPU."/".$avgCPUMax."]</div>";
		?>
		</div>
			<h4>CPU 60 Usage:</h4>
		<div class="progress" style="height: 25px;">
		<?php
		echo "<div class='progress-bar ".$avgCPU60BarColor."' role='progressbar' style='width: ".$avgCPU60Round."%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>".$avgCPU60Round."% - [".$avgCPU60."/".$avgCPU60Max."]</div>";
		?>
		</div>
		
		<?php
		//print_r($data);
		?>
		
      </div>
      <div class="col-md-3"></div>
  </div>
</div>
 
</body>
</html>
