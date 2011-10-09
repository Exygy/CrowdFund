					<div class="donate">
					<i>Help us reach our goal:</i> 
						<a class="default-donate" href="<?=HTTP_BASE ?>projects/donate/<?=$project['id']?>">Donate to this project!</a>
					<? 
					
					
					?>
					
					<div id="thermometer">
						<div id="fill" style="width:<?=$goal['thermoFill']?>px; left:<?=$goal['thermoMove']?>px">
						</div>
					</div>

					
<p class="goal"><span>Goal:</span> $<?=number_format($goal['total'], 2, '.', ',');?> 
<span class="small_text"><?=$html->link('Detailed Budget', 'financialDetails/'.$project['slug'], array( 'class' => 'financialDetails') )?></span>
</p>

<p class="raised"><span>Raised:</span> $<?=number_format($goal['raised'], 2, '.', ',');?></p>



					</div>
<script>
$(document).ready(function() {
	$("a.financialDetails").fancybox({
		'hideOnContentClick': false,
		frameWidth : 530,
		frameHeight: 410
		});
});
</script>
