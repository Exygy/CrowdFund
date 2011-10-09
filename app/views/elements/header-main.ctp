<div id="header">
		<div id="header-top" class="header-section">
		
			<div id="logo"><a href="<?=HTTP_BASE ?>"><img src="<?=HTTP_BASE ?>img/logo_beta_new.jpg" /></a>
			</div>
			
			<div id="top-right">
				<div id="top-links">
				<ul>
<li><?= (empty( $logged_in_user['User']['id']) ? $html->link('Home', '/') . " | " : $html->link('My Account', '/users/profile') . " | ") ?></li>
<li><?= (!empty( $logged_in_user['User']['id']) ? $html->link('Logout', '/users/logout') . " | " : $html->link('Login', '/users/login') . " | ") ?></li>
<?= (!empty( $logged_in_user['User']['id']) ? "" : "<li>" . $html->link('Donate', '/projects/donate/eurekafund') . "| </li>") ?>
<?= (!empty( $logged_in_user['User']['id']) && $logged_in_user['User']['privileges'] == 1 ? '<li>' . $html->link('Admin', '/admin/projects') . "| </li>": '' ) ?>
<li><?= $html->link('Help', '/pages/help') ?></li>
				</ul>
				</div>
				<div id="search">
					<table>
						<tr><td align="top">
						<form id="SearchFindForm" method="post" action="/search/input"><fieldset style="display:none;"><input type="hidden" name="_method" value="POST" /></fieldset>
						<input type="text" value="<?php if(false) { echo 'search query string'; } else { echo 'Search'; } ?>" name="data[searchstr]" id="SearchSearchstr" onfocus="if(this.value=='Search')this.value='<?php echo ''; ?>'" onblur="if(this.value=='')this.value='Search'" onKeyPress="return submitenter(this,event)"/></td><td align="top"><button id="search-button"></button></td></tr>
						<?php echo $form->end();?>
					</table>
				</div>
				<div class="clear"></div>
				
				<!--
				<div id="top-tabs"> 
					<ul> 
						<li><span class="left"></span><?php echo $html->link('browse projects', '/projects/category'); ?><span class="right"></span></li> 
						<li><span class="left"></span><?php echo $html->link('submit proposal', '/pages/project-intro'); ?><span class="right"></span></li>                      
					</ul> 
				</div>
				--> 
			
			</div>
		
		</div> <!-- header-top -->

		<div class="clear"></div>	
