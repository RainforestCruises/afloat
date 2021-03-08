<?php 


//Console Log Utility--------------
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
//--------------------------------


function afloat_responsive_image($image_id,$image_size, $sizes_array){

	// check the image ID is not blank
	if($image_id != '') {
        
		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );
        
        $image_srcset = '';
        foreach($sizes_array as $s){
            $image_attributes = wp_get_attachment_image_src($image_id, $s);
            $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';
        }

		// generate the markup for the responsive image
		 echo ' loading="lazy" src="'.$image_src.'" srcset="'.$image_srcset.'"';
        //sizes="(max-width: ----px) 100vw, ----px"
	}
}

?>