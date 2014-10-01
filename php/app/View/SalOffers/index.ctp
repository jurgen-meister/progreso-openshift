<?php /* (c)Bittion | Created: 23/09/2014 | Developer:reyro | View: SalOffers/index */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/datatables/jquery.dataTables.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.colVis.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.tableTools.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.bootstrap.min', FALSE); ?> 
<?php echo $this->Html->script('modules/SalOffers/index', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('icon' => $this->Html->link('<i class="fa fa-plus"></i> Cotizaciones', array('action' => 'save'), array('title' => 'Crear', 'class' => 'btn btn-primary', 'escape' => false)) . ' ')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<table id="SalOfferIndexDT" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th>Codigo de Sistema</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Persona solicitante</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th></th> <!-- BUTTONS -->
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

