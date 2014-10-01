<?php /* (c)Bittion Admin Module | Created: 01/09/2014 | Developer:reyro | View: AdmUsers/create */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmUsers/create', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Crear Usuario', 'icon'=>'<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('AdmUser'); ?>
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('AdmProfile.given_name', 'col-6', array('label' => 'Nombre(s):', 'iconPrepend' => 'fa-user', 'maxLength'=>'60')); ?>
        <?php echo $this->SmartForm->input('AdmProfile.family_name', 'col-6', array('label' => 'Apellido(s):', 'iconPrepend' => 'fa-user', 'maxLength'=>'60')); ?>
    </div>
    <div class="row">
        <?php echo $this->SmartForm->input('username', 'col-4', array('label' => 'Nombre de Usuario:', 'maxLength'=>'30', 'after' => '<a href="#" id="linkGenerateUsername">Generar usuario mediante sistema</a>', 'iconPrepend' => 'fa-user', 'placeholder' => 'Puede crearlo o generarlo por sistema')); ?>
        <?php echo $this->SmartForm->select('adm_role_id', 'col-4', array('label' => 'Rol de Usuario:', 'options' => $roles, 'empty' => array('name' => 'Elija un rol', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>
        <?php echo $this->SmartForm->input('AdmProfile.email', 'col-4', array('label' => 'Correo Electrónico:', 'iconPrepend' => 'fa-envelope-o', 'maxLength'=>'60')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons', array('btnExtra1' => $this->Form->button('Guardar y Editar', array('type' => 'button', 'id' => 'btnCreateUpdatePerfil', 'class' => 'btn btn-primary')))); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

