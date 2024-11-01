<?php
if( !class_exists( 'Wcua_coupon' ) ){

	class Wcua_coupon extends Wcua_db{
	
      public function __construct( ){

      }
      public function check_exit_shop_coupon( $name ){

      return $this->shop_coupon_post_exists($name);

      }
      public function create_shop_coupon($name){

      return $this->create_shop_coupon_db($name);
      
      }

      public function update_shop_coupon_post_meta($form_id , $coupon_amount , $product_ids , $date_expires , $customer_email ){
            update_post_meta( $form_id, "discount_type", 'percent');
            update_post_meta( $form_id, "coupon_amount",  $coupon_amount );
            update_post_meta( $form_id, "product_ids", $product_ids );
            $email = array($customer_email);
            update_post_meta( $form_id, "customer_email", $email);
            update_post_meta( $form_id, "individual_use", 'no');
            $dt_gmt = $date_expires;
            $dt = get_date_from_gmt($dt_gmt,'Y-m-d ');
            update_post_meta( $form_id, "date_expires", $dt );  
            update_post_meta( $form_id, "usage_limit", 1 );  
            update_post_meta( $form_id, "usage_limit_per_user", 1 );  
      }


      }

}
?>