<form id="wcua_mail_send_product" method="POST" action="">
                <h5 class="wcua_mail_send_product_msg"></h5>
                <label for="wcua_user_select"><?php printf('%s',_e('Select User for mail send ')); ?>   </label>
                <div class="wcua_select-2">
                <select error-msg="<?php echo esc_attr( 'please select user name ' ); ?>" name="wcua_user_select[]" id="wcua_user_select" multiple>
                <?php  
                $blogusers = get_users();
                foreach ( $blogusers as $user ) {
                    if( $user->roles[0] != 'administrator'){
                        echo '<option value="'. esc_html( $user->user_email ) .'">' . esc_html( $user->display_name ) . '</option>';
                    }
                }
                ?>
                </select>
            </div>
            <label for="wcua_product_id"><?php printf('%s',_e('Select Product ')); ?>   </label>
                <select  error-msg="<?php echo esc_attr( 'please select product ' ); ?>" name="wcua_product_id" id="wcua_product_id">
                <?php
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    echo '<option value="'. get_the_ID() .'">' . get_the_title() . '</option>';
                endwhile;
                ?>
                </select>
      
                <input type="hidden" name="action" value="wcua_product_mail_function" >
                <label for="wcua_mail_subject"><?php printf('%s',_e('Mail Subject')); ?>   </label>
                <input type="text" error-msg="<?php echo esc_attr( 'please Enter Mail Subject' ); ?>" name="wcua_mail_subject" id="wcua_mail_subject" value="<?php printf(' %s - %s',get_bloginfo("name"), 'Seems you are interested to buy this product!')?>">
                <label for="wcua_mail_message"> <?php printf('%s',_e('Shortcode to help you create mail template')); ?> </label>
                <div class=" wcua_short_cut_btn">
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_image"  > <?php printf('%s',_e('{{Product image}}')); ?> </a>
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_buy"  > <?php printf('%s',_e('{{Product buy button}}')); ?> </a>
                <a href="javascript:void(0)" class="wcua_product_image" id = "wcua_product_description"  > <?php printf('%s',_e('{{Product description}}')); ?> </a>
                </div>
               <?php
                $mail_template = new Wcua_db();
                wp_editor( $mail_template->wcua_mail_template(), "wcua_mail_message", array("textarea_rows" => 20, 'tinymce' => true,) ); ?>
                <?php wp_nonce_field(); ?>
                <div class="submit_btn">
                <input type="submit" value="Send Mail">
                </div>
                <img id="loading-image" src="<?php echo WCUA_IMAGE_PATH ?>loading-buffering.gif" style="display:none;"/>
</form>
