<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       wpwork.com
 * @since      1.0.0
 *
 * @package    Wcua
 * @subpackage Wcua/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php



?>
<div class="wcua_table">


<table id="wcua_table_list" class=" wcua_table_list table table-striped table-bordered" >
    <thead>
        <tr>
            <?php 
                printf( "<th>%s</th>", __("No",'wcua') );
                printf( "<th>%s</th>", __("User Name",'wcua') );
                printf( "<th>%s</th>", __("Product Name",'wcua') );
                printf( "<th>%s</th>", __("Viewed Date & Time",'wcua') );
                printf( "<th>%s</th>", __("Action",'wcua') );
                printf( "<th>%s</th>", __("Status",'wcua') );
            ?>
        </tr>
    </thead>
    <tbody class="wcua_listing_data">
    <?php
        $wcua_all_database = new Wcua_db();
        $wcua_data = $wcua_all_database->wcua_get_all_database();
        if(count($wcua_data) >= 1){ 
                $count = 1;
                foreach($wcua_data as $wcua_data){
                    $user_obj = get_user_by('id', $wcua_data->userid);
                    $wcua_product_url	= get_the_permalink($wcua_data->productid);
                    ?>
                        <tr><td><?php  echo esc_html($count); ?></td>
                        <td><?php  echo esc_html($user_obj->user_nicename); ?></td>
                        <td><a href="<?php  echo esc_url( $wcua_product_url)?>"target="_blank" ><?php  echo esc_html(get_the_title($wcua_data->productid)); ?></a></td>
                        <td><?php  echo esc_html($wcua_data->time); ?></td>
                        <td><a class="wcua_mail btn" data-name="<?php  echo esc_html($user_obj->user_nicename); ?>" data-user="<?php  echo esc_html($wcua_data->userid); ?>" data-product="<?php  echo esc_html($wcua_data->productid); ?>" href="javascript:void(0)"><?php  echo esc_html('Send Mail'); ?></a> </td>
                        <td class="status"><?php  echo esc_html($wcua_data->mail_status); ?></td>
                </tr>
                    <?php
                    $count++;
                }
        }else{
         ?>
          <tr><?php  printf( "<td style='text-align: center;' colspan='6'>%s</td>", __("No Data Found ",'wcua') );  ?> </tr>
         <?php   
        }
    ?>
    </tbody>
</table>
</div>
<?php 
require_once plugin_dir_path( __FILE__ ) . 'popup/popup.php';
?>

