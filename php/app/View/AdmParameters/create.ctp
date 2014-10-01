<?php /* (c)Bittion Admin Module | Created: 20/08/2014 | Developer:reyro | View: AdmParameters/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmParameters/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Crear Parámetro', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmParameter'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('parameter_key', 'col-4', array('label' => 'Parámetro Clave:')); ?>
    </div>

    <div class="row">
        <?php echo $this->SmartForm->input('var_string_short', 'col-2', array('label' => 'var_string_short:', 'maxlength' => '10')); ?>                            
        <?php echo $this->SmartForm->input('var_string_long', 'col-2', array('label' => 'var_string_long:', 'maxlength' => '80')); ?>                               
        <?php echo $this->SmartForm->input('var_integer', 'col-2', array('label' => 'var_integer:', 'maxlength' => '10')); ?>                                
        <?php echo $this->SmartForm->select('var_boolean', 'col-2', array('label' => 'var_boolean:', 'options' => $booleans, 'empty' => array('name' => 'Ninguno', 'value' => '', 'selected' => TRUE))); ?>                            
        <?php echo $this->SmartForm->input('var_decimal', 'col-2', array('label' => 'var_decimal:', 'maxlength' => '15')); ?>                                
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

