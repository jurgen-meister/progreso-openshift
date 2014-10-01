<?php /* (c)Bittion | Created: 22/09/2014 | Developer:reyro | View: SalCustomers/save | Description: create and update (customers and their employees */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/jquery.dataTables.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.colVis.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.tableTools.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.bootstrap.min', FALSE); ?> 
<?php echo $this->Html->script('modules/SalCustomers/save', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Cliente', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('SalCustomer'); ?>
<?php echo $this->SmartForm->hidden('id'); ?>                            
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('name', 'col-5', array('label' => '* Nombre:', 'maxlength' => '160', 'placeholder' => 'Persona o Empresa')); ?>                            
        <?php echo $this->SmartForm->input('nit', 'col-3', array('label' => 'NIT:', 'maxlength' => '40')); ?>                            
        <?php echo $this->SmartForm->input('nit_name', 'col-4', array('label' => 'Nombre para Factura:', 'maxlength' => '160')); ?>                            
    </div>
    <div class="row">
        <?php echo $this->SmartForm->input('email', 'col-4', array('label' => 'Correo Electrónico:', 'maxlength' => '80')); ?>                            
        <?php echo $this->SmartForm->input('phone', 'col-2', array('label' => 'Telefono 1:', 'maxlength' => '30')); ?>                            
        <?php echo $this->SmartForm->input('phone2', 'col-2', array('label' => 'Telefono 2:', 'maxlength' => '30')); ?>      
        <?php echo $this->SmartForm->inputAutocomplete('sector', 'col-4', array('id' => 'listSector', 'list' => $sectors), array('placeholder' => 'Ej: Industria textil', 'label' => 'Sector:', 'maxlength' => '100')); ?>                            
    </div>
    <div class="row">
        <?php echo $this->SmartForm->textarea('address', 'col-6', array('rows' => '2', 'label' => 'Dirección:', 'maxlength' => '300')); ?>  
        <?php echo $this->SmartForm->textarea('note', 'col-6', array('rows' => '2', 'label' => 'Nota:', 'maxlength' => '600')); ?>
    </div>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>

<ul id="myTab" class="nav nav-tabs bordered">
    <li class="active">
        <a href="#s1" data-toggle="tab">Empleados o Involucrados</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="s1">
        <?php echo $this->Form->button('<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary', 'id' => 'btnModalCreateEmployee', 'type'=>'button', 'title'=>'Nuevo')); ?>
        <!---------------------------------------- START TAB1 CONTENT ---------------------------------------->
        <table id="SalCustomersEmployeeIndexDT" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>* Nombre</th>
                    <th>Telefono</th>
                    <th>Correo Electrónico</th>
                    <th>Cargo o Relación</th>
                    <th></th> <!-- BUTTONS -->
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <!---------------------------------------- END TAB1 CONTENT ----------------------------------------->
    </div>
</div>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->




<!-- -------------------------------------------------- START MODAL ---------------------------------------------------->
<div class="modal fade" id="modalEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel2">Empleado o Involucrado</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->SmartForm->create('SalCustomersEmployee'); ?>
                <?php echo $this->SmartForm->hidden('id'); ?>
                <?php echo $this->SmartForm->hidden('sal_customer_id'); ?>
                <div class="row">
                    <?php echo $this->SmartForm->input('name', '', array('label' => '* Nombre:', 'maxlength' => '160')); ?>                            
                    <?php echo $this->SmartForm->input('phone', '', array('label' => 'Telefono:', 'maxlength' => '40')); ?>                            
                    <?php echo $this->SmartForm->input('email', '', array('label' => 'Correo Electrónico:', 'maxlength' => '160')); ?>                            
                    <?php echo $this->SmartForm->input('job_title', '', array('label' => 'Cargo o Relación:', 'maxlength' => '160')); ?>    
                </div>
            </div>
            <div class="modal-footer">
                <?php echo $this->SmartForm->button('Guardar', array('class' => 'btn btn-primary')); ?>
                <?php echo $this->SmartForm->button('Cancelar', array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')); ?>
            </div>
            <?php echo $this->SmartForm->end(); ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- -------------------------------------------------- END MODAL ---------------------------------------------------->