<?php
images - this is the folder for the form template's images
CSS classes and id's included in this file are:
componentheading - used if you choose to display the page title
<h1> - used if you choose to show the form label
fabrikMainError -
Other form elements that can be styled here are:
legend
fieldset
To learn about all the different elements in a basic form see http://www.w3schools.com/tags/tag_legend.asp.
<!--If you have set to show the page title in the forms layout parameters, then the page title will show-->
<?php if ($this->params->get('show_page_title', 1)) { ?>
	<div class="componentheading<?php echo $this->params->get('pageclass_sfx')?>"><?php echo $this->escape($this->params->get('page_title')); ?></div>
<?php } ?>
<?php $form = $this->form;
//echo $form->startTag;
if ($this->params->get('show-title', 1)) {?>

<!--This will show the forms label-->
<h1><?php echo $form->label;?></h1>

<!--This area will show the form's intro as well as any errors-->
<?php }
echo $form->intro;
echo $this->plugintop;
$active = ($form->error != '') ? '' : ' fabrikHide';
echo "<div class=\"fabrikMainError fabrikError$active\">";
echo FabrikHelperHTML::image('alert.png', 'form', $this->tmpl);
echo "$form->error</div>";?>
	<?php
	if ($this->showEmail) {
		echo $this->emailLink;
	}
	if ($this->showPDF) {
		echo $this->pdfLink;
	}
	if ($this->showPrint) {
		echo $this->printLink;
	}
	echo $this->loadTemplate('relateddata');
	foreach ($this->groups as $group) {
		?>

<!-- This is where the fieldset is set up -->
		<fieldset class="fabrikGroup" id="group<?php echo $group->id;?>" style="<?php echo $group->css;?>">
		<?php if (trim($group->title) !== '') {?>

<!-- This is where the legend is set up -->
			<legend><span><?php echo $group->title;?></span></legend>
		<?php }?>

<!-- This is where the group intro is shown -->
		<?php if ($group->intro !== '') {?>
		<div class="groupintro"><?php echo $group->intro ?></div>
		<?php }?>

		<?php if ($group->canRepeat) {
			foreach ($group->subgroups as $subgroup) {
			?>
				<div class="fabrikSubGroup">
					<div class="fabrikSubGroupElements">
						<?php
						$this->elements = $subgroup;
						echo $this->loadTemplate('group');
						?>
					</div>
					<?php if ($group->editable) { ?>
						<div class="fabrikGroupRepeater">
							<a class="addGroup" href="#">
							<a class="deleteGroup" href="#">
						</div>
					<?php } ?>
				</div>
				<?php
			}
		} else {
			$this->elements = $group->elements;
			echo $this->loadTemplate('group');
		}?>
	</fieldset>
<?php
	}
	echo $this->hiddenFields;
	?>
	<?php echo $this->pluginbottom; ?>

<!-- This is where the buttons at the bottom of the form are set up -->
	<div class="fabrikActions"><?php echo $form->resetButton;?> <?php echo $form->submitButton;?>
	<?php echo $form->prevButton?> <?php echo $form->nextButton?> 
	 <?php echo $form->applyButton;?>
	<?php echo $form->copyButton  . " " . $form->gobackButton . ' ' . $form->deleteButton . ' ' . $this->message ?>
	</div>

<?php
echo $form->endTag;



echo FabrikHelperHTML::keepalive();?>