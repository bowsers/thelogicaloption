<div class="row" id="break">
						<div class="12u">
							<h4><strong>Break Even Win Rate</strong>
								<a bubbletooltips="This tool returns the needed win rate to be able to break even with the given payout percentage. To make money the win rate needs to be greater than this."style="text-transform:none"><?php echo $tooltip_icon; ?></a>
								<a href="https://www.youtube.com/watch?v=2ptIm0vvAIM" target="_blank" class="icon fa-youtube" style="margin-left:10px"><span class="label">YouTube</span></a>
							</h4>
							<form method="post" action="<?php echo HTML_LINK_ROOT; ?>?page=toolbox#break">
								<section class="box">
									<div class="row">
										<div class="3u">
											<div class="form-group">	
												<label>Return on Investment for Winning Trade:
													<a bubbletooltip="Return on Investment for Winning Trade. This normally ranges from about 70% - 85% depending on several things including the broker being used, currency pairs being traded on, and current liquidity of the markets."><?php echo $tooltip_icon; ?></a>
												</label>
												<input type="number" id="return" class="textbox_sml" name="return" step="0.01" value="<?php if($breakevenrate == "on" && $error == "") { echo $_POST["return"]; } ?>">
												<input type="text" value="%" readonly="true" class="textbox_relative"/>
											</div>
										</div>
										<div class="3u">
											<div class="form-group">
												<label class="fff">&nbsp; &nbsp;</label>
												<label class="fff">&nbsp; &nbsp;</label>
												<input type="submit" id="submit" class="button special" style="margin-top: 0; padding-left:5px;" name="submit" value="Calculate Win Rate" onclick="check();" />
											</div>
										</div>
										<?php
										if($breakevenrate == "on") {
										?>
										<div class="3u">
											<div class="form-group">
												<label class="fff">&nbsp; &nbsp;</label>
									 			<label class="fff">&nbsp; &nbsp;</label>
												<?php
												
												if($error == ""){
													$return = $r;
													$break = breakeven($return);
													$rate = 100 * round($break,3)."%";
                                    									echo '<p>Your Needed Win Rate to Break Even is: '.$rate.'</p>';
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
								</section>
							</form>
						</div>
					</div>