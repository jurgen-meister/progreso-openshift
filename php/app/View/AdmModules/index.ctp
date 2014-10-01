<?php /* (c)Bittion Admin Module | Created: 14/08/2014 | Developer:reyro | View: AdmModules/index */ ?>
<!-- ------------------ START VIEW JS ------------------ -->
<?php echo $this->Html->script('plugin/datatables/jquery.dataTables.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.colVis.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.tableTools.min', FALSE); ?> 
<?php echo $this->Html->script('plugin/datatables/dataTables.bootstrap.min', FALSE); ?> 
<?php echo $this->Html->script('modules/AdmModules/index', FALSE); ?> 
<!-- ------------------ END VIEW JS -------------------- -->
<!-- ----------------------------------- START WIDGET CONTENT ----------------------------------- -->
<?php echo $this->element('SmartWidgetContentStart', array('icon' => $this->Html->link('<i class="fa fa-plus"></i> Módulos', array('action' => 'create'), array('title' => 'Crear', 'class' => 'btn btn-primary', 'escape' => false)) . ' ')); ?>
<!-- ------------------ START CONTENT ------------------ -->
<table id="AdmModuleIndexDT" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Iniciales</th>
            <th>Descripción</th>
            <th></th> <!-- BUTTONS -->
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- ------------------ END CONTENT ------------------ -->
<?php echo $this->element('SmartWidgetContentEnd'); ?>
<!-- ------------------------------------ END WIDGET CONTENT ------------------------------------ -->

