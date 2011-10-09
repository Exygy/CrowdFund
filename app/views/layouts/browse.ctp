	<?php echo $this->element('page-init', array('title_for_layout'=>$title_for_layout,'HTTP_BASE'=>HTTP_BASE)); ?>



<div id="wrap">
		<?php echo $this->element('header-main'); ?>	
		<?php echo $this->element('header-icons'); ?>
		<?php echo $this->element('header-end'); ?>

			<?php $session->flash(); ?>

			<?php echo $content_for_layout; ?>

	


	<?php echo $this->element('footer'); ?>
