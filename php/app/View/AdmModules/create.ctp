<?php /* (c)Bittion Admin Module | Created: 14/08/2014 | Developer:reyro | View: AdmModules/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmModules/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Crear Módulo', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmModule'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('name', 'col-4', array('label' => 'Nombre:', 'maxLength'=>'15')); ?>
        <?php echo $this->SmartForm->input('initials', 'col-2', array('label' => 'Sigla:', 'maxLength'=>'3')); ?>
        <?php echo $this->SmartForm->input('description', 'col-6', array('label' => 'Descripción:', 'maxLength'=>'60')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

