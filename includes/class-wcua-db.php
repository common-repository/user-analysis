<?php
if( !class_exists( "Wcua_db" ) ){

    class Wcua_db{
        function _construct( ){

        }
        public function wcua_get_all_database(){
            global $wpdb;
            $table_name = WCUA_DB_PREFIX."_user_analyis"; 
            $wcua_data = $wpdb->get_results("SELECT * FROM $table_name");
            return $wcua_data;
        }
        public function wcua_set_status($mail_status,$product_id){
            global $wpdb;
            $table_name = WCUA_DB_PREFIX."_user_analyis"; 
            $wcua_data = $wpdb->get_results("SELECT * FROM $table_name");
            $set_status = array(
                'mail_status' =>$mail_status,
            );
            $set_where = array('productid' => $product_id);
            $wcua_data = $wpdb->update($table_name, $set_status, $set_where);
            return $wpdb->query($wcua_data);

        }

        public function wcua_table_delete(){
            global $wpdb;
            $table_name = WCUA_DB_PREFIX."_user_analyis"; 
            $wcua_data = $wpdb->query("DELETE FROM $table_name");
            return $wcua_data;
        }
        public function wcua_mail_template(){
            ob_start();
            $file = WCUA_TEMPLATE_PATH."/email/default.php";
            if(file_exists( $file )){
                include $file;
            }
            return ob_get_clean();
        }
        public function shop_coupon_post_exists($name){
            $post_exists = post_exists( $name,'','','shop_coupon','' );
            if( $post_exists == 0 ){
                $status = true;
            }else{
               $status = false;
            }
            return $status;
        }
        public function create_shop_coupon_db($name){
            $my_post = array(
                'post_title'    => $name,
                'post_status'   => 'publish',
                'post_type' => 'shop_coupon',
            );
            $form_id = wp_insert_post( $my_post );
            return $form_id;
        }
      
      
          

    }

}

?>
