				<li class="search-item">
					<ul>
					
						<? if (!empty($project['Image'])) { 
								$sortedImages = $project['Image'];
							    usort($sortedImages, 'orderCmp');
								$image=IMG_UPLOAD_THUMBS_DIR.$sortedImages[0]['thumb_path'];
 
							} else { 
								$image=HTTP_BASE.'img/monkey.jpg'; 
							}
						?>
						<li class="col1"><?=$html->link( $html->image( $image ), '/projects/view/' . $project['Project']['slug'], array( 'escape' => false ) )?></li>
						<li class="col2"><h2><?=$html->link( $project['Project']['title'], '/projects/view/' . $project['Project']['slug'] )?></h2>
							<div class="submitted">Posted <?=Date('M d, Y', strtotime($project['Project']['timestamp']));?> by <?=$html->link($project['User']['fname'].' '.$project['User']['lname'], '/users/profile/'.$project['User']['id'])?> in <a href="<?=HTTP_BASE ?>projects/category/<?=$project['Project']['project_category_id']?>"><?=$projectCategories[$project['Project']['project_category_id']]?></a></div>
							
							<? 
							$abstract = $project['Project']['abstract'];
							
							$abstract = preg_replace('{(<br(\s*/)?>|&nbsp;)+}i', '', $abstract);

							if (strlen($abstract) > 225) $abstract = substr($abstract, 0, 225) . '...'; ?>
							
							<p><?=$abstract?></p>
						</li>
						<li class="col3">
							<div class="donate">
								<a class="default-donate" href="/projects/donate/<?=$project['Project']['id']?>/25">I'll Donate $25</a>
								<a class="other-donate" href="/projects/donate/<?=$project['Project']['id']?>/">OR DONATE ANOTHER AMOUNT &gt;&gt;</a>
							</div>
					
							<? 
							
							$lineItems = $project['LineItem'];
							$donations = $project['Donation'];
							
							$goal=0;
							foreach ($lineItems as $lineItem) {
								$goal += $lineItem['amount'];
							}
							$raised=0;
							foreach ($donations as $donation) {
								$raised += $donation['project_donation_amt'];
							}
							
							if ($goal==0) $goal=1; //unnecessary? prevent divide by 0
							
							$ratio = min($raised/$goal, 1);
							
							$goalDiff = $goal-$raised;
							
							if ($goalDiff<0) $goalDiff = 0; 
							
							$thermoFill = (1-$ratio)*136;
							$thermoMove = 56+136-$thermoFill;
							
							?>
							
							<div id="thermometer" onClick="location.href='/projects/view/<?=$project['Project']['slug']?>';">
								<div id="fill" style="width:<?=$thermoFill?>px; left:<?=$thermoMove?>px">
								</div>
							</div>

							
							
							<div class="raised">$<?=number_format($raised, 2, '.', ',');?> raised</div>
							<div class="to-go">$<?=number_format($goalDiff, 2, '.', ',');?> to go</div>
						</li>
					</ul>
				</li>
				<div class="clear"></div>