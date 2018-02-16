<?php
$tooltip_icon = '<img src="'.HTML_LINK_ROOT.'design/images/rsz_tooltip_icon3.png" style="display: inline;">';
$postmethod = "no";
$error = "";
$tool = "none";
$expectedvalue = "off";
$maximize = "off";
$simulate = "off";
$breakevenrate = "off";
if($_SERVER["REQUEST_METHOD"] == "POST") {$postmethod = "yes";$tool = $_POST["submit"];}
if($postmethod == "yes") {
	if(isset($_POST["return"]))       { $r      = $_POST["return"]/100; $rd = $_POST["return"]; }
	if(isset($_POST["win_rate"]))     { $p      = $_POST["win_rate"]/100; $pd = $_POST["win_rate"]; }
	if(isset($_POST["investment"]))   { $i      = $_POST["investment"]; }
	if(isset($_POST["number"]))       { $n      = $_POST["number"]; }
	if(isset($_POST["stake_percent"])){ $t      = $_POST["stake_percent"]/100; $td = $_POST["stake_percent"]; }
	if(isset($_POST["max"]))          { $max    = $_POST["max"]; }
	if(isset($_POST["min"]))          { $min    = $_POST["min"]; }
	if(isset($_POST["method"]))       { $f      = $_POST["method"]; }
	if(isset($_POST["time_period"]))  { $period = $_POST["time_period"]; }
	if(isset($_POST["threshold"]))    { $thresh = $_POST["threshold"]; }
	if(isset($_POST["risk"]))         { $risk   = $_POST["risk"]; }
	if($tool == "Calculate Win Rate"){ $breakevenrate = "on"; $error = general_form_check($rd,1,1,1,1,1,1,1); }
	if($tool == "Calculate Forecast"){ $expectedvalue = "on"; $error = general_form_check($rd,$pd,$i,$n,$td,$max,1,1); }
	if($tool == "Run Simulation"){ $simulate = "on"; $error = general_form_check($rd,$pd,$i,$n*$period,$td,$max,$min,$thresh); }
	if($tool == "Maximize Profit"){ $maximize = "on"; $error = general_form_check($rd,$pd,$i,$n*$period,1,$max,$min,1); }
}
if(isset($_POST['submit']))
{
	echo "<div class='se-pre-con'></div>";
}
?>