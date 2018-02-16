	<div class="row" id="forecast">
                <div class="12u">
					<h4><strong>Quick Forecast*</strong>
						<a bubbletooltipbtm="This tool will give an estimate of the most probable outcome for your specific configuration. This assumes that each trade taken is a percent of the available balance at the time of taking the trade. For more advanced forecasting analytics please use the tools below" style="text-transform:none"><?php echo $tooltip_icon; ?></a>
						<a href="https://www.youtube.com/watch?v=MFjkQoYscyc" target="_blank" class="icon fa-youtube" style="margin-left:10px"><span class="label">YouTube</span></a>
					</h4>
					<form method="post" action="<?php echo HTML_LINK_ROOT; ?>?page=toolbox#forecast">
                    <section class="box">
                        <div class="row">
                            <div class="3u">
                            <?php
                                $value = "";
                                if($expectedvalue == "on" && $error == "") { $value = $_POST["win_rate"]; }
                                win_rate_input("bubbletooltip", "win_rate", $value, $tooltip_icon);
                            ?>
                            </div>
                            <div class="3u">
                                <div class="form-group dollar">
                                    <label>
                                        Initial Investment:
                                        <a  bubbletooltip="Initial Investment. The minimum deposit amount ranges from $200 - $500 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="investment" class="pad_left dlr" name="investment" min="10" step="0.01" value="<?php if($expectedvalue == "on" && $error == "") { echo $_POST["investment"]; } ?>">
									
                                </div>
                            </div>
							
							<div class="3u">
                                <div class="form-group">
                                    <label>
                                        Number of Trades:
                                        <a  bubbletooltip="Number of Trades"><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" id="number" name="number" value="<?php if($expectedvalue == "on" && $error == "") { echo $_POST["number"]; } ?>">
									
                                </div>
                            </div>
							
                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                        Percent Staked per Trade:
                                        <a  bubbletooltips="Percent of balance to be traded. The dollar amount of each trade will be adjusted by the given percentage multiplied by the balance at the time of taking each trade."><?php echo $tooltip_icon; ?></a>
                                    </label>
                                    <input type="number" class="textbox_sml" id="stake_percent" name="stake_percent" min="1" max="100" step="1" value="<?php if($expectedvalue == "on" && $error == "") { echo $_POST["stake_percent"]; } ?>">
									<input type="text" value="%" readonly="true" class="textbox_relative"/>
                                </div>
                            </div>
			</div>
          		<div class="row">
                            <div class="3u">
                                <div class="form-group dollar">
								<label class="fff">
                                     &nbsp; &nbsp;
                                    </label>
                                    <label>
                                        Max Allowed Stake per Trade:
                                        <a bubbletooltips="Maximum dollar amount that is allowed to be traded. This ranges from about $2,000 - $15,000 depending on the broker being used."><?php echo $tooltip_icon; ?></a>
                                    </label>
									
                                    <input type="number" id="max" name="max" class="pad_left dlr"  min="10" step="0.01" value="<?php if($expectedvalue == "on" && $error == "") { echo $_POST["max"]; } ?>">
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group">
                                    <label>
                                        Return on Investment for Winning Trade:
                                        <a bubbletooltipr="Return on Investment for Winning Trade. This normally ranges from about 70% - 85% depending on several things including the broker being used, currency pairs being traded on, and current liquidity of the markets."><?php echo $tooltip_icon; ?></a>
                                    </label>
									  
                                    <input type="number" id="return" class="textbox_sml" name="return" min="1" max="100" step="1" value="<?php if($expectedvalue == "on" && $error == "") { echo $_POST["return"]; } ?>">
									<input type="text" value="%" readonly="true" class="textbox_relative"/>
                                </div>
                            </div>
                            <div class="3u">
                                <div class="form-group">
                                      <label class="fff">
                                                 &nbsp; &nbsp;
                                    </label>
									  <label class="fff">
                                                 &nbsp; &nbsp;
                                    </label>
									<input type="submit" id="submit" class="button special" style="margin-top: 0; padding-left:5px;" name="submit" value="Calculate Forecast" onclick="check();" />
                                </div>
                            </div>
							<?php
							if($expectedvalue == "on") {
							?>
							 <div class="3u">
                                <div class="form-group">
                                    <label class="fff">
                                                   &nbsp; &nbsp;
                                    </label>
									  <label class="fff">
                                                 &nbsp; &nbsp;
                                    </label>
									<?php
									
									
									if($error == "") {
										$expect = ExpectedValue($i, $n, $t, $max, $r, $p);
										$forecast = dollar_format($expect);
                                    						echo '<p>Your forecasted bankroll is: <br>'.$forecast.'</p>';
                                    					}else{
                                    						echo $error;
                                    					}
									?>
                                </div>
                            </div>
							<?php
							}
							?>
                            
                        </div>
                        <p> <font size="1">*Note: The quick forecast is for estimating the most probable outcome of the distribution. Since this is an eqution that outputs a single number describing a distribution containing a high amount of variance there may be unexpected results if the number of trades entered is less than 10 and/or the trade size is near 100%. </font></p>
                    </section>
					</form>
					
                </div>
            </div>