<?php /* (c)Bittion Admin Module | Created: 18/08/2014 | Developer:reyro | View: AdmActions/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmActions/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title'=>'Crear Acción', 'icon'=>'<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmAction'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->select('AdmModule.id', 'col-3', array('label' => 'Módulo:', 'options' => $modules, 'empty' => array('name' => 'Elija un módulo', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>
        <?php echo $this->SmartForm->select('adm_controller_id', 'col-3', array('label' => 'Controlador:', 'empty' => array('name' => 'Elija un controlador', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>
        <?php echo $this->SmartForm->select('name', 'col-3', array('label' => 'Acción:', 'empty' => array('name' => 'Elija una acción', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>
        <?php echo $this->SmartForm->input('description', 'col-3', array('label' => 'Descripción:', 'maxLength'=>'60')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->