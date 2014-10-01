<?php /* (c)Bittion Admin Module | Created: 30/08/2014 | Developer:reyro */ ?>
<?php
if (isset($title)) {
    $title = '<h2>'.$title.'</h2>';
}else{
    $title = '';
}
if (isset($icon)) {
    $icon = $icon;
}else{
    $icon = '';
}
?>
<!-- START ROW -->
<div class="row">
    <!-- NEW COL START -->
    <article class="col-sm-12 col-md-12 col-lg-12">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-1">
            
            <header>
                <span class="widget-icon"><?php echo $icon;?></span>
                <?php echo $title;?>				
            </header>
            
            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->
                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body no-padding">