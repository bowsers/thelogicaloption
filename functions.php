<?php
function general_form_check($return,$win_rate,$investment,$n,$stake,$max_stake,$min_stake,$thresh) {
	$error = "";
	if( !is_numeric($return) || $return < 0 ||
	    !is_numeric($win_rate) || $win_rate < 0 || $win_rate > 100 ||
	    !is_numeric($investment) || $investment < $min_stake ||
	    !is_numeric($n) || $n <= 0 ||
	    !is_numeric($stake) || $stake < 0 || $stake > 100 ||
	    !is_numeric($max_stake) || $max_stake < 0 || $min_stake > $max_stake ||
	    !is_numeric($min_stake) || $min_stake < 0 ||
	    !is_numeric($thresh) || $thresh < 0 || $thresh > $investment
	  ){
		$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input</div>";
		/*
		if($return < 0) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 1</div>";}
		if($win_rate < 0 || $win_rate > 100) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 2</div>";}
		if($investment < $min_stake) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 3</div>";}
		if($n <= 0) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 4</div>";}
		if($stake < 0 || $stake > 100) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 5</div>";}
		if($max_stake < 0 || $min_stake > $max_stake) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 6</div>";}
		if($min_stake < 0) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 7</div>";}
		if($thresh < 0 || $thresh > $investment) {$error = "<div style='text-align:center;background:#FAD7D7;border:1px solid red;border-radius:6px'>ERROR: Invalid Input 8</div>";}
		*/
	}
	return $error;
}
function win_rate_input($bubbletooltip, $id, $value, $tooltip_icon) {
	echo '<div class="form-group">';
	echo '<label>Win Rate:';
	echo '<a '. $bubbletooltip . '="Expected success rate of the indicators that you are using to trade binary options. For updated Win Rate for all of our recommended signal providers check out the \'Trading\' tab.">' . $tooltip_icon . '</a>';
	echo '</label>';
	echo '<input type="number" class="textbox_sml" id="' . $id . '" name="win_rate" step="0.001" value="' . $value . '">';
	echo '<input type="text" value="%" readonly="true" class="textbox_relative"/>';
	echo '</div>';
}
function dollar_format($float) {
	$result = "";
	$rounded = round($float,2);
	$dollars = floor($float);
	$cents = round(($rounded - $dollars) * 100,0);
	$dollars_as_string = strval($dollars);
	$dollars_as_array = str_split($dollars_as_string);
	$reversed = array_reverse($dollars_as_array);
	$i = 1;
	$len = count($reversed);
	foreach($reversed as $digit) {
		$result = $digit . $result;
		if( $i % 3 == 0 && $i != $len ) { $result = "," . $result; }
		$i += 1;
	}
	if( $cents < 10 ) { $cents = "0" . $cents; }
	$result = "$ " . $result . "." . $cents;
	return $result;
}
function logged_in_pages() {
	$logged_in_pages = array(
		"home" => array(
			"level" => 0,
			"file_path" => "views/home.php"
		),
		"videos" => array(
			"level" => 0,
			"file_path" => "views/videos.php"
		),
		"toolbox" => array(
			"level" => 1,
			"file_path" => "views/toolbox.php"
		),
		"contact" => array(
			"level" => 0,
			"file_path" => "views/contact.php"
		),
		"trading" => array(
			"level" => 0,
			"file_path" => "views/trading.php"
		),
		"upgrade" => array(
			"level" => 0,
			"file_path" => "views/upgrade.php"
		),
		"faq" => array(
			"level" => 0,
			"file_path" => "views/faq.php"
		),
		"process" => array(
			"level" => 0,
			"file_path" => "views/process.php"
		),
		"forgot" => array(
			"level" => 0,
			"file_path" => "views/forgot.php"
		)
	);
	return $logged_in_pages;
}
//simulator functions
 
/* linsim
 * linear simulation -- set dollar amount staked per trade
 *
 * INPUT VARS:
 * $bal   -- current available bankroll balance
 * $trade -- dollar amount staked per trade
 * $s     -- random float number in (0,1) used to determine trade outcome
 * $p     -- probability of successful trade
 * $r     -- return on investment from a winning trade
 */
function linsim($bal, $trade, $s, $p, $r){
	//determine success of trade	
	if($s < $p){
		//case: success, trade wins -- calc new balance
		$bal = $bal + ($trade * $r);
	}else {
		//failed trade -- calc new balance
		$bal = $bal - $trade;
	}
	return $bal;
}

/* expsim
 * exponential simulation -- set percent of balance staked per trade
 *
 * INPUT VARS:
 * $bal -- current available bankroll balance
 * $t   -- percent of current bankroll staked per trade
 * $s   -- random float number in (0,1) used to determine trade outcome
 * $p   -- probability of successful trade
 * $r   -- return on investment from a winning trade
 */
function expsim($bal, $t, $s, $p, $r){
	if($s < $p){ //successful trade
		$bal = $bal + ($bal * $t *$r);
	}else { //failed trade
		$bal = $bal - ($bal * $t);
	}
	return $bal;
}

/* percentile
 * calculates the array element (or average of two consecutive elements) such that the
 * specified percentage of array entries have a value below the value of that element
 *
 * INPUT VARS:
 * $percentile -- the specified percentage (which percentile of the array is desired)
 * $array      -- the array in which we search for the specified percentile
 */
function percentile($percentile, $array){
	//order the array elements least to greatest
	sort($array);
	
	//calculate the index of the element for the desired percentile by
	//taking the integer ceiling of the theoretical index
	$index = ceil(($percentile / 100) * count($array));
	return $array[$index];
}
/* ExpectedValue
 * does not incorporate increased risk of ruin caused by hitting min trade size
 *
 * INPUT VARS:
 * $i   -- initial investment
 * $n   -- number of trades
 * $t   -- percent of current bankroll staked per trade
 * $max -- maximum allowed stake per trade
 * $r   -- return on investment from a winning trade
 * $p   -- probability of success (win-rate)
 */
 
 
 function ExpectedValue($i, $n, $t, $max, $r, $p){
	//calculate $q (probability of failure)
	$q = 1 - $p;

	$x = 1;
	$ev = $i;

	while ($x <= $n) {
		if($ev * $t < $max){
			$ev = $ev * pow( (1 + ($r * $t) ), $p ) * pow( (1 - $t), $q ); //exponential expected value
		}else {
			$ev = $ev + ($max * $p * $r) - ($max * $q); //linear expected value
		}
		$x++;
	}
	return $ev;
}

//function ExpectedValue($i, $n, $t, $max, $r, $p){
//	//calculate $q (probability of failure)
//	$q = 1 - $p;
//		
//	//calculate $N (number of trades at which linear growth is expected due to reaching $max)
//	$N = log($max / ($t * $i)) / log(pow( (1 + ($r * $t) ), $p ) * pow( (1 - $t), $q ));		
//	if($n >= $N) {
//		//case: growth has reached linear
//		$ev = $i * pow((1+($r*$t)),$p*$N) * pow((1-$t),$q*$N) + ($n-$N) * (($max*$p*$r) - ($max*$q));
//	}else{
//		//case: growth is still exponential
//		$ev = $i * pow((1+($r*$t)),$p*$n) * pow((1-$t),$q*$n);
//	}
//	return $ev;
//}
//Simulator Daily
//Assumes each trade is independent of previous trades
//Trade amount is calculated at beginning of each day based on percentage of balance at the beginning of the day.
//$sims -- number of iterations set to run ( I will give a recommendation on that later... I probably have it be a function of total trades
//$i -- initial investment
//$days -- number of days to run simulation
//$t -- trades size as a percentage of current balance
//$min -- minimum trade size allowed

//$max -- maximum trade size allowed
//$tradesperday -- average number of trades per day -- each day number of trades will be calculated by normal approximation
//$ruin -- dollar amount that user can specify for their ruin. The simulator will stop if this is reached.
//$p -- probability of success
//$r -- return on successul trade
function simdaily($sims, $i, $days, $t, $min, $max, $tradesperday, $ruin, $p, $r){

	$ruin = max($ruin, $min);

	$z = 1;
	$sim_results_daily = array();
	while($z <= $sims){
		$bal = $i; //balance
		$y = 1;
	
		while($y <= $days){
			$x = 1;
			if($bal * $t <= $min){
				$daytrade = $min; //min dollar amount traded each day
			}elseif($bal * $t >= $max){
				$daytrade = $max; //max dollar amount traded each day
			}else{
				$daytrade = $bal * $t; //dollar amount traded each day
			}
			$tradedistribution = mt_rand(0,$tradesperday) + mt_rand(0,$tradesperday); //calculate number of trades for the day using normal approximation
			while($x <= $tradedistribution && $bal > $ruin && $bal >= $daytrade){
				$s = mt_rand(0,999) / 1000; //random number generator
				$bal = linsim($bal, $daytrade, $s, $p, $r);
				$x++;
			}
			$y++;
		}
		$sim_results_daily[] = $bal;
		$z++;
	}
	return $sim_results_daily;
	
	//return array("hi",1,2,3,4);
}
//Simulator
//Assumes each trade is independent of previous trades
//Every trade is adjusted to trade as a percentage of current balance
//$sims -- number of iterations set to run ( I will give a recommendation on that later... I might have it be a function of $n
//$i -- initial investment
//$n -- number of trades
//$ruin -- dollar amount that user can specify for their ruin. The simulator will stop if this is reached.
//$t -- trades size as a percentage of current balance
//$min -- minimum trade size allowed
//$max -- maximum trade size allowed
//$p -- probability of success
//$r -- return on successul trade

//Outputs an array of length = $sims. this is the final value of each iteration.

function simulator($sims, $i, $n, $ruin, $t, $min, $max, $p, $r){

	$ruin = max($ruin, $min);

	$y = 1;
	$sim_results = array();

	while($y <= $sims){
		$bal = $i; //balance
		$x = 1;
		while($x <= $n && $bal > $ruin){
			$s = mt_rand(0,999) / 1000; //random number generator
			if($bal * $t <= $min){ //min linear growth simulation
				$bal = linsim($bal, $min, $s, $p, $r);
			}elseif($bal * $t < $max){ //exponential growth simulation
				$bal = expsim($bal, $t, $s, $p, $r);
			}else{ //max linear growth simulation
				$bal = linsim($bal, $max, $s, $p, $r);
			}
			$x++;
		}
		$sim_results[] = $bal;
		$y++;
	}
	return $sim_results;
}

function flatsim($sims, $i, $days, $t, $min, $max, $tradesperday, $ruin, $p, $r){

	$ruin = max($ruin, $min);

	$y = 1;
	$flatsim_results = array();
	$tradesize = $t * $i;
	$n = $days * $tradesperday;
	while($y <= $sims){
		$bal = $i; //balance
		$x = 1;
		while($x <= $n && $bal > $ruin){
			$s = mt_rand(0,999) / 1000; //random number generator
			if($tradesize >= $max){
				$bal = linsim($bal, $max, $s, $p, $r);
			}elseif($bal <= $tradesize){
				$trade = $bal;
				$bal = linsim($bal, $trade, $s, $p, $r);
			}else{
				$bal = linsim($bal, $tradesize, $s, $p, $r);
			}
		$x++;
		}
	$flatsim_results[] = $bal;
	$y++;
	}
return $flatsim_results;
}

//Martingale Simulator

function martingale($sims, $i, $days, $tradesperday, $ruin, $t, $min, $max, $p, $r){
	
	$ruin = max($ruin, $min);
	$n = $days * $tradesperday;
	$y = 1;
	$martingale_results = array();
	while($y <= $sims){
		$bal = $i;
		$x = 1;
		while($x <= $n && $bal > $ruin){
			$tradesize = max($t * $bal, $min);
			$profitneeded = $tradesize * $r;
			$amounttraded = 0;
			$startingbal = $bal;
			$bool = true;
			while($bool){
				$s = mt_rand(0,1000) / 1000; //random number generator
				$bal = linsim($bal, $tradesize, $s, $p, $r);
				$x++;
				$amounttraded = $amounttraded + $tradesize;
				$neededtradesize = min( ( ($amounttraded + $profitneeded) / $r), ( ($profitneeded + $startingbal - $bal ) / $r) );
				if($bal >= $startingbal + $profitneeded || $bal <= $ruin){
					$bool = false;
				}else{
					$tradesize = min($neededtradesize, $bal);
				}
				$x++;
			}
		}
		$y++;
		$martingale_results[] = $bal;
	}
	return $martingale_results;
}


function Optimizer($i, $r, $p, $min, $max, $ruinpercentage, $tradesperday, $days, $dr){

	$ruin = (1 - $ruinpercentage) * $i;
	$n = $days * $tradesperday;

	$x = .0001;
	$evold = 0; // set initial points for most probable outcome calculator
	$evnew = .0001; // set initial points for most probable outcome calculator
	while($evold < $evnew){
		$evold = $evnew;
		$evnew = ExpectedValue($i, $n, $x, $max, $r, $p);
		$x = $x + .0001;
	}
	
	$maxtradesize = $x;

	$upper = $x;
	$lower = 0;
	$bisect = ( $upper + $lower ) / 2;
	
	$sims = 2000;
	
	$upperresult = simulator($sims, $i, $n, $ruin, $upper, $min, $max, $p, $r);
	$upperrisk = risk($upperresult, $ruin) / count($upperresult);

	if($upperrisk <= $dr){
		$recommendedtradesize = $upper;
		$recommendedtraderisk = $upperrisk;
	}else{
		$sims = 1000;
		$bisectresult = simulator($sims, $i, $n, $ruin, $bisect, $min, $max, $p, $r);
		$bisectrisk = risk($bisectresult, $ruin) / count($bisectresult);
		$error = .01 * $dr; //deviation from desired risk used to stop the simmulation
		$max_iterate_b = 6; //maximum number of iterations used for bisecting before cutting off loop
		$min_iterate_b = 4; //minimum number of iterations before average happens
		$error = .01 * $dr; //deviation from desired risk used to stop the simmulation

		$x = 1;
		$bool = true;
		while($bool){
			if($bisectrisk > $dr){
				$upper = $bisect;
				$upperrisk = $bisectrisk;
				$bisect = ($bisect + $lower ) / 2;
			}else{
				$lower = $bisect;
				$lowerrisk = $bisectrisk;
				$bisect = ( $upper + $bisect ) / 2;
			}
			$bisectresult = simulator($sims, $i, $n, $ruin, $bisect, $min, $max, $p, $r);
			$bisectrisk = risk($bisectresult, $ruin) / count($bisectresult);
		

			$riskarray[] = $bisectrisk;
			$tradeoptimize[] = $bisect;
			
			$recommendedtradesize = $bisect;
			$recommendedtraderisk = $bisectrisk;
	
			if( ( ($dr - $error) < $bisectrisk && $bisectrisk < ($dr + $error) && ($x > 3) ) || $x > $max_iterate_b ){
				$bool = false;
			}
			if($x < 3){
				$sims = 1000;
			}else{
				$sims = 3500;
			}
			
			$x++;
		}
	}
	return $recommendedtradesize;
}
function OptimizerDaily($i, $r, $p, $min, $max, $ruinpercentage, $tradesperday, $days, $dr){

	$ruin = (1 - $ruinpercentage) * $i;
	$n = $days * $tradesperday;

	$x = .0001;
	$evold = 0; // set initial points for most probable outcome calculator
	$evnew = .0001; // set initial points for most probable outcome calculator
	while($evold < $evnew){
		$evold = $evnew;
		$evnew = ExpectedValue($i, $n, $x, $max, $r, $p);
		$x = $x + .0001;
	}
	
	$maxtradesize = $x;

	$upper = $x;
	$lower = 0;
	$bisect = ( $upper + $lower ) / 2;
	
	$sims = 2000;
	
	$upperresult = simdaily($sims, $i, $days, $upper, $min, $max, $tradesperday, $ruin, $p, $r);
	$upperrisk = risk($upperresult, $ruin) / count($upperresult);

	if($upperrisk <= $dr){
		$recommendedtradesize = $upper;
		$recommendedtraderisk = $upperrisk;
	}else{
		$sims = 1000;
		$bisectresult = simdaily($sims, $i, $days, $bisect, $min, $max, $tradesperday, $ruin, $p, $r);
		$bisectrisk = risk($bisectresult, $ruin) / count($bisectresult);
		$error = .01 * $dr; //deviation from desired risk used to stop the simmulation
		$max_iterate_b = 6; //maximum number of iterations used for bisecting before cutting off loop
		$min_iterate_b = 4; //minimum number of iterations before average happens
		$error = .01 * $dr; //deviation from desired risk used to stop the simmulation

		$x = 1;
		$bool = true;
		while($bool){
			if($bisectrisk > $dr){
				$upper = $bisect;
				$upperrisk = $bisectrisk;
				$bisect = ($bisect + $lower ) / 2;
			}else{
				$lower = $bisect;
				$lowerrisk = $bisectrisk;
				$bisect = ( $upper + $bisect ) / 2;
			}
			$bisectresult = simdaily($sims, $i, $days, $bisect, $min, $max, $tradesperday, $ruin, $p, $r);
			$bisectrisk = risk($bisectresult, $ruin) / count($bisectresult);
		

			$riskarray[] = $bisectrisk;
			$tradeoptimize[] = $bisect;
			
			$recommendedtradesize = $bisect;
			$recommendedtraderisk = $bisectrisk;
			if( ( ($dr - $error) < $bisectrisk && $bisectrisk < ($dr + $error) && ($x > 3) ) || $x > $max_iterate_b ){
				$bool = false;
			}
			if($x < 3){
				$sims = 1000;
			}else{
				$sims = 3500;
			}
			
			$x++;
		}
	}
	return $recommendedtradesize;
}
function risk($array, $ruin){
	$counter = 0;
	for($a = 0, $b = count($array); $a < $b; $a++){
		if( $array[$a] <= $ruin ){ $counter += 1; }
	}
	return $counter;
}
function breakeven($r){
		$breakevenrate = 1 / (1 + $r);
		return $breakevenrate;
}
function spread_simulator($sims, $i, $n, $ruin, $t, $min, $max, $p1, $p2, $p3, $p4, $t1, $t2, $t3, $t4, $r1, $r2, $r3, $r4, $sp2, $sp3, $sp4){
	$sp1 = 1 - ( $sp2 + $sp3 + $sp4 );
	
	$ruin = max($ruin, $min);

	$y = 1;
	$sim_results = array();

	while($y <= $sims){
		$bal = $i; //balance
		$x = 1;
		while($x <= $n && $bal > $ruin){
			$rand = mt_rand(0,999) / 1000;
			if($rand <= $sp1){
				$p = $p1;
				$t = $t1;
				$r = $r1;
			}elseif( $rand <= ($sp1 + $sp2) ){
				$p = $p2;
				$t = $t2;
				$r = $r2;
			}elseif( $rand <= ($sp1 + $sp2 + $sp3) ){
				$p = $p3;
				$t = $t3;
				$r = $r3;
			}else{
				$p = $p4;
				$t = $t4;
				$r = $r4;
			}
			$s = mt_rand(0,999) / 1000; //random number generator
			if($bal * $t <= $min){ //min linear growth simulation
				$bal = linsim($bal, $min, $s, $p, $r);
			}elseif($bal * $t < $max){ //exponential growth simulation
				$bal = expsim($bal, $t, $s, $p, $r);
			}else{ //max linear growth simulation
				$bal = linsim($bal, $max, $s, $p, $r);
			}
			$x++;
		}
		$spread_sim_results[] = $bal;
		$y++;
	}
	return $spread_sim_results;
}

function spread_simdaily($sims, $i, $days, $min, $max, $tradesperday, $ruin, $p1, $p2, $p3, $p4, $t1, $t2, $t3, $t4, $r1, $r2, $r3, $r4, $sp2, $sp3, $sp4){
	$sp1 = 1 - ( $sp2 + $sp3 + $sp4 );
	
	$ruin = max($ruin, $min);

	$z = 1;
	$sim_results_daily = array();
	while($z <= $sims){
		$bal = $i; //balance
		$y = 1;
	
		while($y <= $days){
			$x = 1;
			for( $f = 1; $f <= 4; $f++ ){
				if($bal * ${"t".$f} <= $min){
					${"daytrade".$f} = $min; //min dollar amount traded each day
				}elseif($bal * ${"t".$f} >= $max){
					${"daytrade".$f} = $max; //max dollar amount traded each day
				}else{
					${"daytrade".$f} = $bal * ${"t".$f}; //dollar amount traded each day
				}
//				echo ${"daytrade".$f}."<br/>";
			}
//			echo "<br/>";

			$tradedistribution = mt_rand(0,$tradesperday) + mt_rand(0,$tradesperday); //calculate number of trades for the day using normal approximation
			while( $x <= $tradedistribution && $bal > $ruin ){
				$rand = mt_rand(0,999) / 1000;
				if($rand <= $sp1){
					$daytrade = $daytrade1;
					$p = $p1;
					$r = $r1;
				}elseif( $rand <= ($sp1 + $sp2) ){
					$daytrade = $daytrade2;
					$p = $p2;
					$r = $r2;
				}elseif( $rand <= ($sp1 + $sp2 + $sp3) ){
					$daytrade = $daytrade3;
					$p = $p3;
					$r = $r3;
				}else{
					$daytrade = $daytrade4;
					$p = $p4;
					$r = $r4;
				}
				if( $bal < $daytrade ){
					$daytrade = 0;
				}
				$s = mt_rand(0,999) / 1000; //random number generator
				$bal = linsim($bal, $daytrade, $s, $p, $r);
				$x++;
			}
			$y++;
		}
		$sim_results_daily[] = $bal;
		$z++;
	}
	return $sim_results_daily;
}

function spread_flatsim($sims, $i, $days, $min, $max, $tradesperday, $ruin, $p1, $p2, $p3, $p4, $t1, $t2, $t3, $t4, $r1, $r2, $r3, $r4, $sp2, $sp3, $sp4){
	$sp1 = 1 - ( $sp2 + $sp3 + $sp4 );
	
	$ruin = max($ruin, $min);

	$y = 1;
	$flatsim_results = array();
	for( $f = 1; $f <= 4; $f++ ){
		${"tradesize".$f} = ${"t".$f} * $i;
	}
	$n = $days * $tradesperday;
	while($y <= $sims){
		$bal = $i; //balance
		$x = 1;
		while($x <= $n && $bal > $ruin){
			$rand = mt_rand(0,999) / 1000;
			if($rand <= $sp1){
				$p = $p1;
				$tradesize = $tradesize1;
				$r = $r1;
			}elseif( $rand <= ($sp1 + $sp2) ){
				$p = $p2;
				$tradesize = $tradesize2;
				$r = $r2;
			}elseif( $rand <= ($sp1 + $sp2 + $sp3) ){
				$p = $p3;
				$tradesize = $tradesize3;
				$r = $r3;
			}else{
				$p = $p4;
				$t = $tradesize = $tradesize4;
				$r = $r4;
			}
			$s = mt_rand(0,999) / 1000; //random number generator
			if($tradesize >= $max){
				$bal = linsim($bal, $max, $s, $p, $r);
			}elseif($bal <= $tradesize){
				$trade = $bal;
				$bal = linsim($bal, $trade, $s, $p, $r);
			}else{
				$bal = linsim($bal, $tradesize, $s, $p, $r);
			}
		$x++;
		}
	$flatsim_results[] = $bal;
	$y++;
	}
return $flatsim_results;
}

?>