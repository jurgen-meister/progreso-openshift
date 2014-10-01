<?php /* (c)Bittion Admin Module | Created: 19/08/2014 | Developer:reyro | View: AdmRoles/update */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmRoles/update', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Editar Rol', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmRole'); ?>
<?php echo $this->SmartForm->hidden('id'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('name', 'col-6', array('label' => 'Nombre:', 'maxLength'=>'30')); ?>
        <?php echo $this->SmartForm->input('description', 'col-6', array('label' => 'Descripción:', 'maxLength'=>'60')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->
