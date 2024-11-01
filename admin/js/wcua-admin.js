jQuery(document).ready(function() {
	// datatable js
	jQuery("#wcua_table_list").DataTable(
        {
            "paging":   true,
            "bInfo" : false,
            "ordering": true,
            "autoWidth": false,
            "oLanguage": {
                sLengthMenu: '_MENU_',
                sInfoEmpty: "Showing 0 to 0 of 0 entries",
				
            },
			 "language": {
      
        searchPlaceholder: "Search...",
    },
            responsive: true,
            "search" : {
                return: true,
				
            }
        }
    );
	
	jQuery(".wcua_product_image").click(function(event){
		debugger;
		var $tempElement = jQuery("<input>");
		jQuery("body").append($tempElement);
		$tempElement.val(jQuery(this).text()).select();
		document.execCommand("Copy");
		$tempElement.remove();
	});
});

jQuery(document).on('click','.wcua_mail',function(){
	var thisdata = jQuery(this); 
	jQuery('#wcua_user_id').val(thisdata.data('user'));
	jQuery('#wcua_product_id').val(thisdata.data('product'));
	jQuery('.wcua_user_name').html(thisdata.data('name'));
	jQuery('.wcua_popup').show();
});
jQuery(document).on('click','.close_popup',function(){
	jQuery('#wcua_user_id').val('');
	jQuery('#wcua_product_id').val('');
	jQuery('.wcua_popup').hide();
	jQuery('.wcua_delete_coupon').html('Create Coupon');
	jQuery('.create_coupon_inner').remove();
	jQuery('.wcua_delete_coupon').addClass('wcua_create_coupon');
	jQuery('.wcua_create_coupon').removeClass('wcua_delete_coupon');
	
});


jQuery(document).on('click','.wcua_create_coupon',function(){
	debugger;
	var wcua_coupon_html   = wcua_coupon_field();
	jQuery(this).after(wcua_coupon_html);
	jQuery(this).html('Delete Coupon');
	jQuery(this).removeClass('wcua_create_coupon');
	jQuery(this).addClass('wcua_delete_coupon');
});

jQuery(document).on('click','.wcua_delete_coupon',function(){
	debugger;
	jQuery('.create_coupon_inner').remove();
	jQuery(this).html('Create Coupon');
	jQuery(this).removeClass('wcua_delete_coupon');
	jQuery(this).addClass('wcua_create_coupon');
});

function wcua_coupon_field(){
	let create_coupon_div = document.createElement( "div" );
	create_coupon_div.setAttribute( "class", "create_coupon_inner" );

	let wcua_coupon_name_div = document.createElement( "div" );
	wcua_coupon_name_div.setAttribute( "class", "wcua_coupon_name_box" );
	let wcua_coupon_name = document.createElement( "input" );
    wcua_coupon_name.setAttribute( "name", "wcua_coupon_name" );
	wcua_coupon_name.setAttribute( "id", "wcua_coupon_name" );
    wcua_coupon_name.setAttribute( "type", "text" );
    wcua_coupon_name.setAttribute( "required", true );
    wcua_coupon_name.setAttribute( "placeholder", "Enter Coupon Name" );
	wcua_coupon_name.setAttribute( "error-msg", "Please Enter Coupon Name" );
	wcua_coupon_name_div.append( wcua_coupon_name )
	create_coupon_div.append( wcua_coupon_name_div );


	let wcua_percentage_div = document.createElement( "div" );
	wcua_percentage_div.setAttribute( "class", "wcua_percentage_box" );
	let wcua_percentage_discount = document.createElement( "input" );
    wcua_percentage_discount.setAttribute( "name", "wcua_percentage_discount" );
	wcua_percentage_discount.setAttribute( "id", "wcua_percentage_discount" );
    wcua_percentage_discount.setAttribute( "type", "number" );
    wcua_percentage_discount.setAttribute( "required", true );
    wcua_percentage_discount.setAttribute( "min", 1 );
	wcua_percentage_discount.setAttribute( "max", 100 );
    wcua_percentage_discount.setAttribute( "placeholder", "Enter Percentage Discount" );
	wcua_coupon_name.setAttribute( "error-msg", "Please Enter Percentage Discount" );
	wcua_percentage_div.append( wcua_percentage_discount )
	create_coupon_div.append( wcua_percentage_div );


	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth() + 1; 
	var yyyy = today.getFullYear();
	if (dd < 10) {
	dd = '0' + dd;
	}
	if (mm < 10) {
	mm = '0' + mm;
	} 	
	today = yyyy + '-' + mm + '-' + dd;
	let wcua_expiry_div = document.createElement( "div" );
	wcua_expiry_div.setAttribute( "class", "wcua_expiry_box" );
	let wcua_expiry_date = document.createElement( "input" );
    wcua_expiry_date.setAttribute( "name", "wcua_expiry_date" );
	wcua_expiry_date.setAttribute( "id", "wcua_expiry_date" );
    wcua_expiry_date.setAttribute( "type", "date" );
    wcua_expiry_date.setAttribute( "required", true );
    wcua_expiry_date.setAttribute("min", today);
    wcua_expiry_date.setAttribute( "placeholder", "Enter Expiry date" );
	wcua_coupon_name.setAttribute( "error-msg", "Please Enter Expiry date" );
	wcua_expiry_div.append( wcua_expiry_date )
	create_coupon_div.append( wcua_expiry_div );
	return create_coupon_div;


}
jQuery(document).on('keyup','#wcua_coupon_name',function(){
	var reg_name_lastname = /^[a-zA-Z\s]*$/;
		var wcua_coupon_name =  jQuery('#wcua_coupon_name').val();
		if(!reg_name_lastname.test(wcua_coupon_name)){ 
			if(jQuery('.error_msg').length == 0 ){
				jQuery('#wcua_coupon_name').after("<span class='error_msg' style='color:red'>Correct your First Name: only letters and spaces.</span>");
			}	
		}else{
			jQuery('.error_msg').remove();
		}
});
jQuery(document).on('submit','#wcua_mail_send_form',function(e){
	e.preventDefault();
	var wcua_data = jQuery(this).serialize();
	jQuery(this).find('input').each(function(){
		if(jQuery(this).val() == '' ){
			alert(jQuery(this).attr('error-msg')) ;
			return false;
		}
	});
	jQuery(this).find('wcua_mail_message').each(function(){
		if(jQuery(this).val() == '' ){
			alert(jQuery(this).attr('error-msg')) ;
			return false;
		}
	});
	var reg_name_lastname = /^[a-zA-Z\s]*$/;
	var wcua_coupon_name =  jQuery('#wcua_coupon_name').val();
	if(!reg_name_lastname.test(wcua_coupon_name)){ 
		if(jQuery('.error_msg').length == 0 ){
			jQuery('#wcua_coupon_name').after("<span class='error_msg' style='color:red'>Correct your First Name: only letters and spaces.</span>");
		}
		return false;
	}else{
		jQuery('.error_msg').remove();
	}

	jQuery.ajax({
			url: wcau_ajax_object.ajaxurl,
			type: 'POST',
			data:wcua_data,
			success: function( response ) {
				if(response.status){
					if(response.set_status == 'yes'){
						jQuery('[data-product='+response.product_id+']').closest('tr').find('.status').html(response.set_status);
					}else{
						jQuery('[data-product='+response.product_id+']').closest('tr').find('.status').html(response.set_status);
					}
					jQuery('#wcua_user_id').val('');
					jQuery('#wcua_product_id').val('');
					jQuery('.wcua_popup').hide();
				}else{
					alert(response.message)
				}
			},
		})
});

jQuery(document).on('submit','#wcua_mail_send_product',function(e){

	e.preventDefault();
	var wcua_data = jQuery(this).serialize();
	jQuery(this).find('input').each(function(){
		if(jQuery(this).val() == '' ){
			alert(jQuery(this).attr('error-msg')) ;
			return false;
		}
	});
	jQuery(this).find('select').each(function(){
		if(jQuery(this).val() == '' ){
			alert(jQuery(this).attr('error-msg')) ;
			return false;
		}
	});
	jQuery(this).find('wcua_mail_message').each(function(){
		if(jQuery(this).val() == '' ){
			alert(jQuery(this).attr('error-msg')) ;
			return false;
		}
	});
	jQuery.ajax({
			url: wcau_ajax_object.ajaxurl,
			type: 'POST',
			data:wcua_data,
			beforeSend: function() {
				jQuery("#loading-image").show();
			 },
			success: function( response ) {
				debugger;
				jQuery("#loading-image").hide();
				if(response.status){
					jQuery('.wcua_mail_send_product_msg').show();
					jQuery('.wcua_mail_send_product_msg').html('Mail sent successfully to all selected customers');
					setTimeout(function() {
						jQuery('.wcua_mail_send_product_msg').html('');
						jQuery('.wcua_mail_send_product_msg').hide();
						location.reload();
					}, 5000);
				}else{
					alert(response.message)
				}
			},
		})
});

jQuery(document).on('click','.wcua_reset',function(e){
	e.preventDefault();
		jQuery.ajax({
		url: wcau_ajax_object.ajaxurl,
		type: 'POST',
		data:{
		'action':'wcua_table_delete'
		},
		success: function( response ) {
			if(response.status){
				window.location.reload();
			}else{
				alert('Something is worng Please try again' );
			}
		},
	})
});
jQuery(document).ready(function(){

	jQuery("#wcua_user_select").select2({
		allowClear: true,
		placeholder: "Select User",
	});

});

