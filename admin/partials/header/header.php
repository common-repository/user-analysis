<div class="wcua-header">
   <h4> <?php  printf('%s',__('WC User Analysis')); ?> </h4> 
   <?php if( $_REQUEST['page'] &&   ( $_REQUEST["page"] == "wcua_analysis" )  ) { ?>
   <a class="wcua_reset" href="javascript:void(0)"><?php echo esc_html('Flush Data')?></a>
   <?php  } ?>
</div>