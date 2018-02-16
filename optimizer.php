            <div class="row" id="optimizer">
                <div class="12u">
                    <h4><strong>Optimizer</strong>
                       <a bubbletooltip="This tool takes the inputs and reports the trade percentage that will maximize the expected profit based on the desired risk." style="text-transform:none"><?php echo $tooltip_icon; ?></a>
		       <a href="https://www.youtube.com/watch?v=U5bgt8HUYeY" target="_blank" class="icon fa-youtube" style="margin-left:10px"><span class="label">YoutTube</span></a>
                    </h4>
                    <form method="post" action="<?php echo HTML_LINK_ROOT; ?>?page=toolbox#optimizer">
					<section class="box">
                        <div class="row">
                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                      Frequency of Stake Percentage Calculation
                                      <a bubbletooltip="DAILY: re-calculates the trade amount at the beginning of the day and trade that dollar amount for the entire day. AFTER EACH TRADE: re-calculates the dollar amount to be traded before each new trade. 'AFTER EACH TRADE' is the recommended strategy to use, but if this added complication increases the amount of errors in trading then it would be wise to calculate the trade amount at the beginning of each day. It is recommended to use a smaller perentage trading if using the daily configuration as the risk will be higher."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <?php
									echo '<select id="method_mp" name="method">';
									echo '<option value="0"';
									if($maximize == "on" && $_POST["method"] == 0) { echo " SELECTED"; }
									echo '>Daily</option>';
									echo '<option value="1"';
									if($maximize == "on" && $_POST["method"] == 1) { echo " SELECTED"; }
									echo '>After Each Trade</option>';
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
                                        <a  bubbletooltip="Expected success rate of the indicators that you are using to trade binary options. For updated Win Rate for all of our recommended signal providers check out the 'Trading' tab."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" class="textbox_sml" id="win_rate_mp" name="win_rate" min="0" max="100" step="1" value="<?php if($maximize == "on") { echo $_POST["win_rate"]; } ?>">
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
									
                                    <input type="number" id="investment_mp" class="pad_left dlr" name="investment" min="10" step="0.01" value="<?php if($maximize == "on") { echo $_POST["investment"]; } ?>">
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
                                    <input type="number" id="number_mp" name="number" value="<?php if($maximize == "on") { echo $_POST["number"]; } ?>">
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
                                     Time Period*:
                                     <a bubbletooltip="Select time period to simulate"><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <?php
									echo '<select id="time_period_mp" name="time_period">';
									echo '<option value="1"';
									if($maximize == "on" && $_POST["time_period"] == 1) { echo " SELECTED"; }
									echo '>1 Month</option>';
								//	echo '<option value="6"';
								//	if($maximize == "on" && $_POST["time_period"] == 6) { echo " SELECTED"; }
								//	echo '>6 Months</option>';
								//	echo '<option value="12"';
								//	if($maximize == "on" && $_POST["time_period"] == 12) { echo " SELECTED"; }
								//	echo '>1 Year</option>';
									echo '</select>';
									?>
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group dollar">
								<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                       Min Allowed Stake per Trade:
                                       <a bubbletooltips="Minimum dollar amount that is allowed to be traded. This normally ranges between $1 - $25 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="min_mp" class="pad_left dlr" name="min" min="0" step="0.01" value="<?php if($maximize == "on") { echo $_POST["min"]; } ?>">
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group dollar">
									<label class="fff">
                                     &nbsp;
                                    </label>
                                    <label>
                                       Max Allowed Stake per Trade:
                                       <a  bubbletooltips="Maximum dollar amount that is allowed to be traded. This ranges from about $1,000 - $15,000 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="max_mp" class="pad_left dlr" name="max" min="10" step="0.01" value="<?php if($maximize == "on") { echo $_POST["max"]; } ?>">
                                </div>
                            </div>

                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                       Return on Investment for Winning Trade:
                                       <a bubbletooltip="Return on Investment for Winning Trade. This normally ranges from about 70% - 85% depending on several things including the broker being used, currency pairs being traded on, and current liquidity of the markets."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" id="return_mp" class="textbox_sml" name="return" min="0" max="100" step="1" value="<?php if($maximize == "on") { echo $_POST["return"]; } ?>" >
									<input type="text" value="%" readonly="true" class="textbox_relative"/>
                                </div>
                            </div>
                        </div>
							 <div class="row">
                        <div class="6u">
                            <div class="row">
                                <div class="12u">
                                    <label>Maximum Loss Threshold
                                    <!-- div class="1u" -->
					<a bubbletooltipb="Percent of balnce willing to lose. Simulations will stop if this percent loss in balance is achieved" style="top:10px"><?php echo $tooltip_icon; ?></a>
				    <!-- /div -->
				    </label>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="trade_11" name="threshold" value="0.25" <?php if($maximize == "on" && $_POST["threshold"] == 0.25) { echo " CHECKED"; } ?>>
                                        <label for="trade_11"><span></span></label>
                                        <label class="radio-text">25% Loss</label>
                                    </div>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="Radio1" name="threshold" value="0.5" <?php if($maximize == "on" && $_POST["threshold"] == 0.5) { echo " CHECKED"; } ?>>
                                        <label for="Radio1"><span></span></label>
                                        <label class="radio-text">50% Loss</label>
                                    </div>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="Radio2" name="threshold" value="0.75" <?php if($maximize == "on" && $_POST["threshold"] == 0.75) { echo " CHECKED"; } ?>>
                                        <label for="Radio2"><span></span></label>
                                        <label class="radio-text">75% Loss</label>
                                    </div>
                                </div>
								
								
                            </div>
                        </div>

                        <div class="6u">
                            <div class="row">
                                <div class="12u">
                                    <label>Desired Risk of Hitting Maximum Loss Threshold:
                                    <!-- div class="1u" -->
					<a bubbletooltip="Percent chance that the Maximum Loss Threshhold is achieved." style="top:10px"><?php echo $tooltip_icon; ?></a>
				    <!-- /div -->
				    </label>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="Radio3" name="risk" value="0.01" <?php if($maximize == "on" && $_POST["risk"] == 0.01) { echo " CHECKED"; } ?> >
                                        <label for="Radio3"><span></span></label>
                                        <label class="radio-text">1% Risk</label>
                                    </div>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="Radio4" name="risk" value="0.05" <?php if($maximize == "on" && $_POST["risk"] == 0.05) { echo " CHECKED"; } ?> >
                                        <label for="Radio4"><span></span></label>
                                        <label class="radio-text">5% Risk</label>
                                    </div>
                                </div>
                                <div class="3u">
                                    <div class="form-group">
                                        <input type="radio" id="Radio5" name="risk" value="0.1" <?php if($maximize == "on" && $_POST["risk"] == 0.1) { echo " CHECKED"; } ?> >
                                        <label for="Radio5"><span></span></label>
                                        <label class="radio-text">10% Risk</label>
                                    </div>
                                </div>
								
								
                            </div>
                        </div>
                            </div>

                        
                        <div class="row">
                            <div class="3u">
                                <div class="form-group">
                                  <input class="button special" type="submit" name="submit" value="Maximize Profit" onclick="check();">
                                </div>
                            </div>
						
                        </div>
						
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
						if($maximize == "on") 
						{
							if($error == "") {
								ini_set('max_execution_time',300);
								//set_time_limit(300);
							
								$days = $period * 21;
								$tpd  = $n;
								$rp   = $thresh;
								$dr   = $risk;
							
								if($_POST["method"] == 0) {
									$result = OptimizerDaily($i, $r, $p, $min, $max, $rp, $tpd, $days, $dr);
								}else{
									$result = Optimizer($i, $r, $p, $min, $max, $rp, $tpd, $days, $dr);
								}
								$otr = 100 * round($result,3);
								echo '<div class="row"><div class="6u"><h3>Your optimal trade ratio is '.$otr.'%</h3></div></div>';
							}else{
								echo $error;
							}
						}
						
						?>
				<p> <font size="1"> *Note: due to the size of the server currently being used the optimizer is only able to run for one month. Once The Logical Option gets a larger server 6 month and 1 year options will be made available. </font></p>
                    </section>
					</form>
                </div>
            </div>