<?php /* (c)Bittion Admin Module | Created: 15/08/2014 | Developer:reyro | View: AdmControllers/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmControllers/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Crear Controlador', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmController'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->select('AdmModule.initials', 'col-3', array('label' => 'Módulo:', 'options' => $modules)); ?>
        <?php echo $this->SmartForm->select('name', 'col-3', array('label' => 'Controlador:', 'options' => $controllers, 'empty' => array('name' => 'Elija un controlador', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>
        <?php echo $this->SmartForm->input('description', 'col-4', array('label' => 'Descripción:', 'maxLength'=>'60')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

