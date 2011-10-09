
	<div id="search-results">
		<h1>Current Proposals</h1>
		<div id="search-filters">
			<ul>
				<li>filter proposals by:</li>
				<li><a href="<?=HTTP_BASE ?>projects/category/1">wind</a> <span>|</span> </li>
				<li><a href="<?=HTTP_BASE ?>projects/category/2">transportation</a> <span>|</span> </li>
				<li><a href="<?=HTTP_BASE ?>projects/category/3">water</a> <span>|</span> </li>
				<li><a href="<?=HTTP_BASE ?>projects/category/4">solar</a> <span>|</span> </li>
				<li><a href="<?=HTTP_BASE ?>projects/category/5">energy storage</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<div id="search-items">
			<ul>
				<? foreach ($projects as $project) { ?>
				<li class="search-item">
					<ul>
						<li class="col1"><img src="<?=HTTP_BASE ?>img/monkey.jpg" /></li>
						<li class="col2"><h2><a href="<?=HTTP_BASE ?>projects/view/<?=$project['Project']['slug']?>"><?=$project['Project']['title']?></a></h2>
							<div class="submitted">Posted <?=Date('M d, Y', strtotime($project['Project']['timestamp']));?> by <a href=""><?=$project['User']['name']?></a> in <a href="">Category <?=$project['Project']['project_category_id']?></a></div>
							
							<? 
							$abstract = $project['Project']['abstract'];
							
							$abstract = preg_replace('{(<br(\s*/)?>|&nbsp;)+}i', '', $abstract);

							if (strlen($abstract) > 225) $abstract = substr($abstract, 0, 225) . '...'; ?>
							
							<p><?=$abstract?></p>
						</li>
						<li class="col3">
							<div class="donate">
								<a class="default-donate" href="">I'll Donate $25</a>
								<a class="other-donate" href="">OR DONATE ANOTHER AMOUNT &gt;&gt;</a>
							</div>
							<img src="" />
							<div class="raised">$0.00 raised</div>
							<div class="to-go">$5,000.00 to go</div>
						</li>
					</ul>
				</li>
				<div class="clear"></div>				
				<? } ?>
			</ul>
		</div> <!-- search-items -->
	
	
	</div> <!-- search-results -->
