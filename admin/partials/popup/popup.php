<div class="wcua_popup">
    <div class="wcua_popup_ovly close_popup"></div>
        <div class="wcua_popup_inner">
            <a class="close_btn close_popup" href="javascript:void(0)">X</a>
            <form id="wcua_mail_send_form" method="POST" action="">
                <h4><?php printf('%s',_e('Send Mail To')); ?> <span class="wcua_user_name"></span></h4>
                <input type="hidden" name="action" value="wcua_mail_function" >
                <input type="hidden" name="wcua_user_id" id ="wcua_user_id"value="" >
                <input type="hidden" name="wcua_product_id" id="wcua_product_id" value="" >
                <label for="wcua_mail_subject"><?php printf('%s',_e('Mail Subject')); ?>   </label>
                <input type="text" error-msg="<?php echo esc_attr( 'Please Enter Mail Subject' ); ?>" name="wcua_mail_subject" id="wcua_mail_subject" value="<?php printf(' %s - %s',get_bloginfo("name"), 'Seems you are interested to buy this product!')?>">
                <label for="wcua_mail_message"> <?php printf('%s',_e('Shortcode to help you create mail template')); ?> </label>
                <div class=" wcua_short_cut_btn">
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_image"  > <?php printf('%s',_e('{{Product image}}')); ?> </a>
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_buy"  > <?php printf('%s',_e('{{Product buy button}}')); ?> </a>
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_description"  > <?php printf('%s',_e('{{Product description}}')); ?> </a>
                </div>
                <label  class="coupon" for="wcua_create_coupon_note"><?php printf('%s',_e('Special offer Create Coupon for this Product')); ?>  </label>
                <a href="javascript:void(0)" class="wcua_create_coupon wcua_create_coupon_btn"><?php printf('%s',_e('Create Coupon')); ?> </a>
                <label  class="wcua_if_coupon" for="wcua_create_coupon_note"><b><?php printf('%s',_e('Note:')); ?></b> <?php printf('%s',_e('IF you create Coupon you will added the email template')); ?>  </label>
               <?php
                $mail_template = new Wcua_db();
                wp_editor( $mail_template->wcua_mail_template(), "wcua_mail_message", array("textarea_rows" => 20, 'tinymce' => true,) ); ?>
                <?php wp_nonce_field(); ?>
                <div class="submit_btn">
                <input type="submit" value="Send Mail">
                </div>
               
            </form>
    </div>
</div>