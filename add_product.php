<?php

error_reporting(0);
include('../../wp-config.php');
$response = array();
global $wpdb;
global $product;
// print_r($_POST);die;
var_dump(headers_list());die;
if(isset($_POST['user_id']) && isset($_POST['product_title']) && isset($_POST['product_category']) && isset($_POST['product_price']) && isset($_POST['product_desc']) && isset($_FILES['product_image'])){
 
	$user_id=$_POST['user_id'];	
	$product_title=$_POST['product_title'];	
	$product_category=$_POST['product_category'];	
	$product_price=$_POST['product_price'];	
	$product_desc=$_POST['product_desc'];	
	$product_image=$_FILES['product_image'];	
	$sku=$_POST['sku'];	
	$sale_price=$_POST['sale_price'];	
	$weight=$_POST['weight'];	
	$length=$_POST['length'];	
	$width=$_POST['width'];	
	$height=$_POST['height'];	
	$stock=$_POST['stock'];	
	$stock_status=$_POST['stock_status'];	
	$onsale=$_POST['onsale'];	
	$product_color=$_POST['product_color'];	
	$product_size	=$_POST['product_size'];	
	$sale_price_dates_to	=$_POST['sale_price_dates_to'];	
	$sale_price_dates_from	=$_POST['sale_price_dates_from'];	
	$product_tags	=$_POST['product_tags'];	
	// print_r($_POST);die;
	if(!empty($product_title) && !empty($product_category) && !empty($product_price) && !empty($product_desc)){
		
		$start = strtotime($sale_price_dates_from);
		$end = strtotime($sale_price_dates_to);
		$post_id = wp_insert_post(array(
				    'post_author' => $user_id,
				    'post_title' => $product_title,
				    'post_content' => $product_desc,
				    'post_excerpt' => '',
				    'post_status' => 'publish',
				    'post_type' => 'product'      
    
					));
		if($product_tags)
		{
			$tags = explode(',', $product_tags);

			wp_set_object_terms($post_id, $tags, 'product_tag');
		}

		$col = explode(',', $product_color);
		$siz = explode(',', $product_size);
		$product_attributes = array('color'   =>  $col,'size'   =>  $siz);
		if ($product_attributes ) {
		        $thedata = array();
		        foreach ($product_attributes as $key => $terms) {
		        	$taxonomy = wc_attribute_taxonomy_name($key); // The taxonomy slug
			        $attr_label = ucfirst($key); // attribute label name
			        $attr_name = ( wc_sanitize_taxonomy_name($key));

			        if( ! taxonomy_exists( $taxonomy ) )
		            save_product_attribute_from_name( $attr_name, $attr_label );

		            // $attr = 'pa_'.$attr;
		            $thedata[sanitize_title($taxonomy)] = Array(
		                    'name' => wc_clean($taxonomy),
		                    'value' => '',
		                    'postion' => '0',
		                    'is_visible' => '1',
		                    'is_variation' => '1',
		                    'is_taxonomy' => '1'
		            );



		            foreach( $terms as $value ){
		            $term_name = ucfirst($value);
		            $term_slug = sanitize_title($value);

		            // Check if the Term name exist and if not we create it.
		            if( ! term_exists( $value, $taxonomy ) )
		                wp_insert_term( $term_name, $taxonomy, array('slug' => $term_slug ) ); // Create the term

		            // Set attribute values
		            wp_set_post_terms( $post_id, $term_name, $taxonomy, true );
		        }
		    }
		    update_post_meta( $post_id, '_product_attributes', $thedata );
        }
       

		$table_name ="wp_wc_product_meta_lookup";

		$wpdb->insert($table_name, array('product_id' => $post_id, 'sku' => $sku, 'min_price' => $product_price, 'max_price' => $product_price, 'onsale' => $onsale, 'stock_quantity' => $stock, 'stock_status' => $stock_status) );
		// set product is simple/variable/grouped
		wp_set_object_terms( $post_id, 'simple', 'product_type' );
		wp_set_object_terms( $post_id, '_product_version', '4.0.0');
		update_post_meta( $post_id, '_wcfm_product_author', $user_id );
		update_post_meta( $post_id, '_wcfm_product_views', '' );
		update_post_meta( $post_id, '_wcfmmp_processing_time', '4' );
		update_post_meta( $post_id, 'disable_price', 'no' );
		update_post_meta( $post_id, 'disable_add_to_cart', 'no' );
		update_post_meta( $post_id, '_catalog', 'yes' );
		update_post_meta( $post_id, '_wcfm_new_product_notified', 'yes' );
		// update_post_meta( $post_id, '_product_image_gallery', array() );
		update_post_meta( $post_id, '_thumbnail_id', '' );
		update_post_meta( $post_id, '_price', $product_price );
		// update_post_meta( $post_id, '_product_attributes', $att_color );
		update_post_meta( $post_id, '_wc_review_count', '0' );
		update_post_meta( $post_id, '_wc_average_rating', '0' );
		update_post_meta( $post_id, '_stock_status', $stock_status );
		update_post_meta( $post_id, '_stock', $stock );
		update_post_meta( $post_id, '_download_expiry', '-1' );
		update_post_meta( $post_id, '_download_limit', '-1' );
		update_post_meta( $post_id, '_downloadable', 'no' );
		update_post_meta( $post_id, '_virtual', 'no' );
		update_post_meta( $post_id, '_weight', $weight );
		update_post_meta( $post_id, '_length', $length );
		update_post_meta( $post_id, '_width', $width );
		update_post_meta( $post_id, '_height', $height );
		update_post_meta( $post_id, '_sold_individually', 'no' );
		update_post_meta( $post_id, '_backorders', 'no' );
		update_post_meta( $post_id, '_manage_stock', 'no' );
		update_post_meta( $post_id, '_tax_class', '' );
		update_post_meta( $post_id, '_tax_status', 'taxable' );
		update_post_meta( $post_id, 'total_sales', '0' );
		update_post_meta( $post_id, '_sale_price_dates_to', $end );
		update_post_meta( $post_id, '_sale_price_dates_from', $start );
		update_post_meta( $post_id, '_sale_price', $sale_price );
		update_post_meta( $post_id, '_regular_price', $product_price );
		update_post_meta( $post_id, '_sku', $sku );
		
		if(!empty($product_image)){
			    //upload image
			$year = date('Y');
			$month = date('m');
			$upload       = wp_upload_bits( $_FILES['product_image']['name'], null, file_get_contents( $_FILES['product_image']['tmp_name'] ) );
			$imgfile = $product_image['name'];
			$upl_base_url = "../../wp-content/uploads/".$year."/".$month."/";
			header('Content-Type: bitmap; charset=utf-8');
	        $image_url= $upl_base_url.'/'. _wp_relative_upload_path( $upload['file'] );
			$flag = 0;
		    $url_array = explode('/',$image_url);
		    $image_name = $url_array[count($url_array)-1];
	    	$unique_file_name = wp_unique_filename( $upl_base_url, $image_name ); //    Generate unique name
	    	$filename = basename( $unique_file_name );
			$wp_filetype = wp_check_filetype( $filename, null );
			$upload_dir1 = get_bloginfo('url').'/wp-content/uploads/'.$year.'/'.$month.'/'.$image_name; 
		 	// print_r($unique_file_name."<br>".$filename."<br>".$image_name."<br>".$upload);
		    // Set attachment data
		    $attachment = array(
		        'post_author' => $user_id,
		        'post_mime_type' => $wp_filetype['type'],
		        'post_title' => sanitize_file_name( $image_name ),
		        'post_content' => '',
		        'guid' => $upload_dir1,
		        'post_status' => 'inherit'
		    );
		    $att_file = $year."/".$month.'/'.$image_name;
		    // Create the attachment
		    $attach_id = wp_insert_attachment( $attachment, $att_file, $post_id );
		    // Include image.php
		    require_once(ABSPATH.'wp-admin/includes/image.php');
		    // Define attachment metadata
		    $attach_data = wp_generate_attachment_metadata( $attach_id, $att_file );
		    // Assign metadata to attachment
		    wp_update_attachment_metadata( $attach_id, $attach_data );
		    // asign to feature image
		    if( $flag == 0){
		        set_post_thumbnail( $post_id, $attach_id );
			}
		}

		$pro_cat = explode(',', $product_category);
		
		//end of image update codes
		//update product category
		foreach($pro_cat as $cat){
			wp_set_object_terms( $post_id, $cat, 'product_cat' );
		}



		if ($_FILES) { 
	        $files = $_FILES["my_file_upload"];  
	        $attID = '';
	        foreach ($files['name'] as $key => $value) {      

	                if ($files['name'][$key]) { 

	                    $file = array( 
	                        'name' => $files['name'][$key],
	                        'type' => $files['type'][$key], 
	                        'tmp_name' => $files['tmp_name'][$key], 
	                        'error' => $files['error'][$key],
	                        'size' => $files['size'][$key]
	                    ); 
	                    $_FILES = array ("my_file_upload" => $file);

	                    $year = date('Y');
						$month = date('m');
						$upload = wp_upload_bits( $files['name'][$key], null, file_get_contents( $files['tmp_name'][$key] ) );
						$imgfile = $files['name'][$key];
						$upl_base_url = "../../wp-content/uploads/".$year."/".$month."/";
						header('Content-Type: bitmap; charset=utf-8');

				        $image_url= $upl_base_url.'/'. _wp_relative_upload_path( $upload['file'] );
						$flag = 0;
					    $url_array = explode('/',$image_url);
					    $image_name = $url_array[count($url_array)-1];
				    	$unique_file_name = wp_unique_filename( $upl_base_url, $image_name ); //    Generate unique name
				    	$filename = basename( $unique_file_name );
						$wp_filetype = wp_check_filetype( $filename, null );
						$upload_dir1 = get_bloginfo('url').'/wp-content/uploads/'.$year.'/'.$month.'/'.$image_name; 
					 
					    // Set attachment data
					    $attachment = array(
					        'post_author' => $user_id,
					        'post_mime_type' => $wp_filetype['type'],
					        'post_title' => sanitize_file_name( $image_name ),
					        'post_content' => '',
					        'guid' => $upload_dir1,
					        'post_status' => 'inherit'
					    );
					    $att_file = $year."/".$month.'/'.$image_name;
					    // Create the attachment
					    $attach_id = wp_insert_attachment( $attachment, $att_file, $post_id );
					    // Include image.php
					    require_once(ABSPATH.'wp-admin/includes/image.php');
					   

					    $attID.=$attach_id.',';

	                } 

	            }
	            $attachment_id = rtrim($attID,',');
	            update_post_meta( $post_id, '_product_image_gallery', $attachment_id );
	    }

		//end of product category updaet code	
		$response['status'] = "1";
		$response['message'] = 'Product Added Successfully.';
    
    
	}else{
		$response['status'] = "0";
		$response['message'] = 'Some fields are missing!';
	}
}else{
		$response['status'] = "0";
		$response['message'] = 'Enter Values!';
}
print_r(json_encode($response));