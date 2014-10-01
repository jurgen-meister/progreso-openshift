<?php /* (c)Bittion | Created: 18/09/2014 | Developer:reyro | View: InvProducts/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/InvProducts/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Producto', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('InvProduct'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->inputAutocomplete('category', 'col-4', array('id' => 'listCategory', 'list' => $categories), array('label' => '* Categoria :', 'maxlength' => '120')); ?>
        <?php echo $this->SmartForm->inputAutocomplete('type', 'col-4', array('id' => 'listType', 'list' => $types), array('label' => '* Tipo de producto:', 'maxlength' => '120')); ?>
    </div>
    <div class="row">
        <?php echo $this->SmartForm->input('name', 'col-6', array('label' => '* Nombre:', 'maxlength' => '160')); ?>                            
        <?php echo $this->SmartForm->inputAutocomplete('measure', 'col-4', array('id' => 'listMeasure', 'list' => $measures), array('label' => '* Medida:', 'maxlength' => '50')); ?>
        <?php echo $this->SmartForm->input('code', 'col-2', array('label' => 'Codigo de producto:', 'maxlength' => '50')); ?>                            
    </div>
    <!--<div class="row">-->
    <?php echo $this->SmartForm->textarea('description', '', array('rows' => '2', 'label' => 'Descripción:', 'maxlength' => '600')); ?>                            
    <!--</div>-->
    <div class="row">
        <?php echo $this->SmartForm->inputAutocomplete('brand', 'col-4', array('id' => 'listBrand', 'list' => $brands), array('label' => '* Marca:', 'maxlength' => '80')); ?>                            
        <?php echo $this->SmartForm->input('InvPrice.0.price', 'col-2', array('label' => '* Precio Unitario:', 'maxlength' => '15')); ?>                            
    </div>
    <!--<div class="row">-->
    <?php // echo $this->SmartForm->select('website', 'col-2', array('label' => 'Mostrar producto en la pagina web:', 'options' => $booleans)); ?>                            
    <!--</div>-->
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->
