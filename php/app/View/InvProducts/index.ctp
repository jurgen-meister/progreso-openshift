<?php /* (c)Bittion | Created: 18/09/2014 | Developer:reyro | View: AdmProducts/index */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/datatables/jquery.dataTables.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.colVis.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.tableTools.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.bootstrap.min', FALSE); ?> 
<?php echo $this->Html->script('modules/InvProducts/index', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('icon' => $this->Html->link('<i class="fa fa-plus"></i> Productos', array('action' => 'create'), array('title' => 'Crear', 'class' => 'btn btn-primary', 'escape' => false)) . ' ')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<table id="InvProductIndexDT" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th>Codigo del Sistema</th>
            <th>Nombre</th>
            <th>Medida</th>
            <th>Categoria</th>
            <th>Tipo</th>
            <th>Marca</th>
            <th>Precio (BOB)</th>
            <th></th> <!-- BUTTONS -->
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

