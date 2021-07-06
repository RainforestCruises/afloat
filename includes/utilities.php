<?php


//Console Log Utility--------------
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}
//--------------------------------


function afloat_responsive_image($image_id, $image_size, $sizes_array)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);

        $image_srcset = '';
        $max_width = 0;
        foreach ($sizes_array as $s) {
            $image_attributes = wp_get_attachment_image_src($image_id, $s);
            $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

            if ($image_attributes[1] > $max_width) {
                $max_width = $image_attributes[1];
            }
        }

        // generate the markup for the responsive image
        echo ' loading="lazy" src="' . $image_src . '" srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px"';
    }
}

function afloat_responsive_image_lazy($image_id, $image_size, $sizes_array)
{

    // check the image ID is not blank
    if ($image_id != '') {

        // set the default src image size
        $image_src = wp_get_attachment_image_url($image_id, $image_size);

        $image_srcset = '';
        $max_width = 0;
        foreach ($sizes_array as $s) {
            $image_attributes = wp_get_attachment_image_src($image_id, $s);
            $image_srcset = $image_srcset . $image_attributes[0] . ' ' . $image_attributes[1] . 'w,';

            if ($image_attributes[1] > $max_width) {
                $max_width = $image_attributes[1];
            }
        }

        // generate the markup for the responsive image
        echo ' data-flickity-lazyload-src="' . $image_src . '" data-flickity-lazyload-srcset="' . $image_srcset . '" sizes="(max-width: ' . $max_width . 'px) 100vw, ' . $max_width . 'px"';
    } else {
        //add pending image
    }
}

function comma_separate_list($arr)
{
    $count = 0;
    $display = "";
    foreach ($arr as $a) :

        $fieldText = get_field('navigation_title', $a);
        if ($count != 0) {
            $display .= ", " . $fieldText;
        } else {
            $display .= $fieldText;
        }
        $count++;
    endforeach;
    return $display;
}

function priceFormat($price) {

    $display = "";
    if($price > 0) {
       $display = "$" .  number_format($price, 0);
    } else {
        $display = "N/A";
    }

    return $display;
    
}
