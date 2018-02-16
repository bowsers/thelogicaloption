			<div class="row" id="simulator">
                <div class="12u">
                    <h4><strong>Simulator</strong>
                    	<a bubbletooltip="This tool takes the inputs, runs several thousand simulations, and reports the distribution of the ending account values. The output can be used to estimate expected risk and reward based on different trading strategies. The simulator assumes that each trade closes before the next trade is taken." style="text-transform:none"><?php echo $tooltip_icon; ?></a>
                    	<a href="https://www.youtube.com/watch?v=jt0sb1XVvng" target="_blank" class="icon fa-youtube" style="margin-left:10px"><span class="label">YoutTube</span></a>
                    </h4>
                    <form method="post" action="<?php echo HTML_LINK_ROOT; ?>?page=toolbox#simulator">
					<section class="box" id="">
                        <div class="row">
                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                      Frequency of Stake Percentage Calculation
                                      <a bubbletooltip="DAILY: re-calculates the trade amount at the beginning of the day and trade that dollar amount for the entire day. AFTER EACH TRADE: re-calculates the dollar amount to be traded before each new trade. NEVER: calculates the trade size at the beginning and then trades that amount for the entire simulation. 'AFTER EACH TRADE' is the recommended strategy to use, but if this added complication increases the amount of errors in trading then it would be wise to calculate the trade amount at the beginning of each day. It is recommended to use a smaller perentage trading if using the daily configuration as the risk will be higher."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <?php
									echo '<select id="method_sim" name="method">';
									echo '<option value="0"';
									if($simulate == "on" && $error == "" && $_POST["method"] == 0) { echo " SELECTED"; }
									echo '>Daily</option>';
									echo '<option value="1"';
									if($simulate == "on" && $error == "" && $_POST["method"] == 1) { echo " SELECTED"; }
									echo '>After Each Trade</option>';
									echo '<option value ="2"';
									if($simulate == "on" && $error == "" && $_POST["method"] == 2) { echo " SELECTED"; }
									echo '>Never</option>';
									echo '</select>';									
									?>
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group">
								<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                        Win Rate:
                                        <a  bubbletooltip="Expected success rate of the indicators that you are using to trade binary options. For updated Win Rate for all of our recommended signal providers check out the 'Trading' tab."><?php echo $tooltip_icon; ?></a>                                    </label>
                                    <input type="number" class="textbox_sml" id="win_rate_sim" name="win_rate" min="0" max="100" step="0.1" value="<?php if($simulate == "on" && $error == "") { echo $_POST["win_rate"]; } ?>">
									<input type="text" value="%" readonly="true" class="textbox_relative"/>			
                                </div>
                            </div>
                            <div class="3u"> 
                                <div class="form-group dollar">
								<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                        Initial Investment:
                                        <a  bubbletooltip="Initial Investment. The minimum deposit amount ranges from $200 - $500 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="investment_sim" class="pad_left dlr" name="investment" min="10" step="0.01" value="<?php if($simulate == "on" && $error == "") { echo $_POST["investment"]; } ?>">
                                </div>
                            </div>

                            <div class="3u">
                                <div class="form-group">
								<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                        Number of Trades Per Day:
                                        <a  bubbletooltips="The expected trade volume per day. For updated expected trade volume for all of our recommended signal providers check out the 'Trading' tab."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" id="number_sim" name="number" value="<?php if($simulate == "on" && $error == "") { echo $_POST["number"]; } ?>">
                                </div>
                            </div>

                        </div>
           
                    <div class="row">
                            <div class="3u">
                                <div class="form-group">
									<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                     Number of Days:
                                     <a bubbletooltip="Number of days to run simulation for: 1 year ~ 251 days, 6 months ~ 125 days, 1 month ~ 21 days"><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" id="time_period_sim" name="time_period" value="<?php if($simulate == "on" && $error == "") { echo $_POST["time_period"]; } ?>">
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group">
								<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                       Percent Staked per Trade:
                                       <a bubbletooltips="Percent of balance to be traded. This will be implemented base on the selection for 'Frequency of Stake Percentage Calculation'. In general as the percent of balance being traded increases both the risk and expected return will increase as well."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" class="textbox_sml" id="stake_percent_sim" name="stake_percent" min="0" max="100" step="0.01" value="<?php if($simulate == "on" && $error == "") { echo $_POST["stake_percent"]; } ?>" >
									<input type="text" value="%" readonly="true" class="textbox_relative"/>
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group dollar">
								
                                    <label>
                                       Minimum Balance Threshold (Dollar Amount):
                                       <a bubbletooltip="Minimum account balance willing to reach. If this amount is reached in any of the simulations the simulator will stop trading. If this amount is less than the minimum allowed stake per trade, then any balance below the minimum stake per trade will be considered ruin."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="threshold_sim" class="pad_left dlr" name="threshold" min="0" step="0.01" value="<?php if($simulate == "on" && $error == "") { echo $_POST["threshold"]; } ?>">
                                </div>
                            </div>

                            <div class="3u">
                                <div class="form-group dollar">
									<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                       Min Allowed Stake per Trade:
                                       <a bubbletooltips="Minimum dollar amount that is allowed to be traded. This normally ranges between $5 - $25 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="min_sim" class="pad_left dlr" name="min" min="0" step="0.01" value="<?php if($simulate == "on" && $error == "") { echo $_POST["min"]; } ?>" >
                                </div>
                            </div>
                        </div>
							 <div class="row">
                            
                            <div class="3u">
                                <div class="form-group dollar">
									<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                       Max Allowed Stake per Trade:
                                       <a bubbletooltipb="Maximum dollar amount that is allowed to be traded. This ranges from about $2,000 - $15,000 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="max_sim" class="pad_left dlr" name="max" min="10" step="0.01" value="<?php if($simulate == "on" && $error == "") { echo $_POST["max"]; } ?>" >
                                </div>
                            </div>
                            

                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                      Return on Investment for Winning Trade:
                                      <a bubbletooltipr="Return on Investment for Winning Trade. This normally ranges from about 70% - 85% depending on several things including the broker being used, currency pairs being traded on, and current liquidity of the markets."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" id="return_sim" class="textbox_sml" name="return" min="0" max="100" step="1" value="<?php if($simulate == "on" && $error == "") { echo $_POST["return"]; } ?>" >
									<input type="text" value="%" readonly="true" class="textbox_relative"/>
                                </div>
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="3u">
                                <div class="form-group">
                                  <input class="button special" type="submit" name="submit" value="Run Simulation" onclick="check();">
                                </div>
                            </div>
						
                        </div>
						
						
						   <div class="row">
						               <div class="12u">
						<?php
						/*
						 *AVAILABLE VARIABLES (set in toolbox.php)
						 *
						 *$r      = $_POST["return"]/100;
						 *$p      = $_POST["win_rate"]/100;
						 *$i      = $_POST["investment"];
						 *$n      = $_POST["number"];
						 *$t      = $_POST["stake_percent"]/100;
						 *$max    = $_POST["max"];
						 *$min    = $_POST["min"];
						 *$f      = $_POST["method"];
						 *$period = $_POST["time_period"];
						 *$thresh = $_POST["threshold"];
						 *$risk   = $_POST["risk"];
						 *
						 *$error 
						 *
						 */
						if($simulate == "on") 
						{
							if($error == "") {
								ini_set('max_execution_time',120);
								//set_time_limit(120);				
							
								$days = $period;
								$tpd  = $n;
								$ruin = max($thresh,$min);
							
								if($_POST["method"] == 0) {
									$results = simdaily(1500, $i, $days, $t, $min, $max, $tpd, $ruin, $p, $r);
								}elseif($_POST["method"] == 1){
									$n = $tpd * $days;
									$results = simulator(1500, $i, $n, $ruin, $t, $min, $max, $p, $r);
								}else{
									$results = flatsim(1500, $i, $days, $t, $min, $max, $tpd, $ruin, $p, $r);
								}
								$divisor = 1;
								//if we want to make the x-axis label dynamic -- find related: XAXDYNAMIC
								//$graph_label = "Bankroll Dollars";
								
								$max_val = max($results);
								if($max_val >= 10000000) {
									//find related: XAXDYNAMIC
									//$graph_label = "Bankroll X $1 Million";
									$divisor = 1000000;
								}else{
									if($max_val >= 10000) {
										//find related: XAXDYNAMIC
										//$graph_label = "Bankroll X $1,000";
										$divisor = 1000;
									}
								}
								$count_var = 0;
								//$ruin_freq = 0;
								foreach($results as $key => $result){
									//if($result <= $ruin) {
									//    $ruin_freq += 1;
									//}
									$results[$key] = round($result,2);
									$count_var += 1;
								}
								//risk($results,$ruin)'<p><span style="background:red; width:20px"></span> Risk of ruin (10%)</p>';
								$risk_ruin = round(100*risk($results,$ruin)/$count_var, 2);
								$risk_loss = round(100*risk($results,$i)/$count_var, 2);
								$prob_win = 100 - $risk_loss;
								$sim_results  = "<div style='background:#EEE; width:100%; max-width:310px; border:1.5px solid black;padding:10px'><div style='background:red;width:20px;height:10px;border:1px solid black;display:inline-block'></div> Risk of ruin: ". $risk_ruin ."%";
								$sim_results .= "<br><div style='background:yellow;width:20px;height:10px;border:1px solid black;display:inline-block'></div> Risk of loss (without ruin): ". ($risk_loss - $risk_ruin) ."%";
								$sim_results .= "<br><div style='background:green;width:20px;height:10px;border:1px solid black;display:inline-block'></div> Probability of positive return: ". $prob_win ."%</div>";
							
								$sim_results .= "<p>Minimum Bankroll: ". dollar_format(min($results));
								$sim_results .= "<br>25th Percentile Bankroll: ". dollar_format(percentile(25, $results));
								$sim_results .= "<br><span><strong>50th Percentile (Median) Bankroll: ". dollar_format(percentile(50, $results)) ."</strong></span>";
								$sim_results .= "<br>75th Percentile Bankroll: ". dollar_format(percentile(75, $results));
								$sim_results .= "<br>Maximum Bankroll: ". dollar_format(max($results));
								$sim_results .= "<br>Average Bankroll: ". dollar_format(array_sum($results)/$count_var) ."</p>";
								$data = json_encode($results);
								echo '<div class="demo-container row">
								<div class="6u demo-placeholder">
									<div id="placeholder" style="width:100%;max-width:475px;height:300px;"><!-- max-width was not set by developer -->
								</div>
								</div>
								<div class="6u"><div id="sim_results"></div></div></div>';
								echo '<div id="graph_label" style="text-align:center;max-width:500px;">Bankroll</div>';
								echo '<script type="text/javascript">';
								echo 'get_histogram('.$data.', 1, '.$count_var.', '.$divisor.', '.$ruin.', '.$i.');';
								//find related: XAXDYNAMIC
								//echo 'document.getElementById("graph_label").innerHTML="'.$graph_label.'";';
								echo 'document.getElementById("sim_results").innerHTML="'.$sim_results.'";';
								echo '</script>';
							}else{
								echo $error;
							}
						}
						?>
						
						</div>
						</div>

                    </section>
					</form>
                </div>
            </div>