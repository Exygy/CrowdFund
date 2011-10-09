<?=$this->element( 'users/edit/basic-user-form-start' )?>
<div style="float:left;">
<fieldset>
<legend>Academic Info</legend>
<dl>
<div class="field-hint-inactive" id="data[Scientist][university]-H"><div><?=TT_SCIENTIST_UNIVERSITY?></div></div>
<?= $form->input('Scientist.university') ?>
</dl>

<dl>
<div class="field-hint-inactive" id="data[Scientist][city]-H"><div><?=TT_SCIENTIST_CITY?></div></div>
<?= $form->input('Scientist.city') ?> 
</dl>
<dl>
<?= $form->label('Scientist.state', 'State').$form->select('Scientist.state', $geography->stateList(), (isset($this->data['User']['Scientist']['state'])?$this->data['User']['Scientist']['state']:null), array()) ?>
</dl>
</fieldset>
</div>
<div style="float:right;">

<fieldset>
<legend>Research Interests</legend>
<dl>
<div class="multi">
<? echo $form->input('Expertise', array( 'type'=>'select', 
					'multiple'=>'checkbox', 
					'options'=>$expertise, 
					'label'=>'Expertise')); ?> 
</div>
</dl>
<dl>
<div class="field-hint-inactive" id="data[Scientist][details]-H"><div><?=TT_SCIENTIST_DETAILS?></div></div>
<?= $form->input('Scientist.details', array('cols'=>35, 'rows'=>10)) ?>
</dl>
</fieldset>


</div>

<div class="clear"></div>
