<?php /* (c)Bittion | Created: 23/09/2014 | Developer:reyro | View: SalOffers/save | Description: create and update (customers and their employees */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/jquery-form/jquery-form.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/jquery.dataTables.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.colVis.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.tableTools.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.bootstrap.min', FALSE); ?> 
<?php echo $this->Html->script('modules/SalOffers/save', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('title' => 'Cotización<span id="spanOfferTitle">'.$systemCode.'</span>', 'icon' => '<i class="fa fa-edit"></i>')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<?php echo $this->SmartForm->create('SalOffer'); ?>
<?php echo $this->SmartForm->hidden('id');?>                            
<fieldset>
    <div class="row">
        <?php echo $this->SmartForm->input('date', 'col-3', array('label' => '* Fecha:', 'value'=>$date,'maxlength' => '10', 'iconPrepend' => 'fa-calendar', 'data-mask' => '99/99/9999', 'data-mask-placeholder' => '-')); ?>    
    </div>
    <div class="row">
        <?php echo $this->SmartForm->select('sal_customer_id', 'col-5', array('label' => '* Cliente:', 'select2' => 'select2', 'options' => $customers, 'class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12', 'empty' => array('name' => 'Elija un cliente', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE))); ?>   
        <?php echo $this->SmartForm->inputAutocomplete('person_requesting', 'col-3', array('id' => 'listCustomersEmployee', 'list' => array()), array('label' => 'Persona solicitante:', 'placeholder' => 'Nombre y Apellido', 'maxlength' => '160')); ?>                            
    </div>
    <div class="row">
        <?php // echo $this->SmartForm->hidden('SalCustomersEmployee.id'); ?>
        <?php // echo $this->SmartForm->inputAutocomplete('SalCustomersEmployee.name', 'col-3',array('id' => 'listCustomersEmployee', 'list' => array()), array('label' => 'Nombre:', 'placeholder'=>'Persona Solicitante', 'maxlength' => '160')); ?>                            
        <?php // echo $this->SmartForm->input('SalCustomersEmployee.phone', 'col-2', array('label' => 'Telefono:', 'placeholder'=>'Persona Solicitante', 'maxlength' => '40')); ?>                            
        <?php // echo $this->SmartForm->input('SalCustomersEmployee.email', 'col-3', array('label' => 'Correo electrónico:', 'placeholder'=>'Persona Solicitante', 'maxlength' => '160')); ?>                            
        <?php // echo $this->SmartForm->input('SalCustomersEmployee.job_title', 'col-3', array('label' => 'Cargo o Relación:', 'placeholder'=>'Persona Solicitante', 'maxlength' => '160')); ?>                            
    </div>
    <?php echo $this->SmartForm->textarea('note', '', array('rows' => '2', 'label' => 'Nota:', 'maxlength' => '600')); ?>
</fieldset>
<?php echo $this->element('SmartFormButtons'); //default save and cancel ?>
<?php echo $this->SmartForm->end(); ?>

<ul id="myTab" class="nav nav-tabs bordered">
    <li class="active">
        <a href="#s1" data-toggle="tab">Productos</a>
    </li>
</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active in" id="s1">
        <?php echo $this->Form->button('<i class="fa fa-plus"></i>', array('class' => 'btn btn-primary', 'id' => 'btnModalCreateProduct', 'type' => 'button', 'title' => 'Nuevo')); ?>
        <!---------------------------------------- START TAB1 CONTENT ---------------------------------------->
        <table id="SalOffersDetailIndexDT" class="table table-striped table-bordered table-hover" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Codido de Sistema</th>
                    <th>Producto</th>
                    <th>Precio (BOB)</th>
                    <th>Cantidad</th>
                    <th>Medida</th>
                    <th>Subtotal (BOB)</th>
                    <th></th> <!-- BUTTONS -->
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td colspan="6" style="font-weight: bold;text-align: right;padding-right: 20px;">TOTAL</td>
                    <td colspan="2" style="font-weight: bold;"><span id="spanTotal">0.00</span></td>
                </tr>
            </tfoot>
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
<div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel2">Producto </h4>
            </div>
            <div class="modal-body">
                <?php echo $this->SmartForm->create('SalOffersDetail'); ?>
                <?php echo $this->SmartForm->hidden('id'); ?>
                <div class="row">
                    <section id="sectionUpdateOfferDetail" style="padding-right: 15px; padding-left: 15px;font-weight: bold"></section>
                    <?php echo $this->SmartForm->select('inv_product_id', 'col-xs-12 col-sm-12 col-md-12 col-lg-12', array('label' => '* Producto:', 'empty' => array('name' => 'Elija un producto', 'value' => '', 'disabled' => TRUE, 'selected' => TRUE),'select2' => 'select2', 'class' => 'col-xs-12 col-sm-12 col-md-12 col-lg-12')); ?>   
                </div>
                <div class="row">
                    <?php echo $this->SmartForm->hidden('price'); ?>
                    <?php echo $this->SmartForm->input('sale_price', 'col-6', array('label' => 'Precio:', 'maxlength' => '20', 'after' => '<div class="note"><strong>Moneda:</strong> <span id="spanCurrency">BOLIVIANOS (BOB)</span></div>')); ?>         
                    <?php echo $this->SmartForm->input('quantity', 'col-6', array('label' => 'Cantidad:', 'maxlength' => '12', 'after' => '<div class="note"><strong>Medida:</strong> <span id="spanMeasure"></span></div>')); ?>   
                </div>
                <div class="row">

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