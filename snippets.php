<?php if ($cruise_lengths) : ?>
            <?php foreach ($cruise_lengths as $length) :
                $link = $length['search_link'];
                if($length['min_days'] == $length['max_days']){
                    $range = $length['min_days'];              
                }else{
                    $range = $length['min_days'] . '-' . $length['max_days'];
                }  
            ?>
                <button class="btn-outline" onclick="location.href='<?php echo $link ?>'"><?php echo $range ?> Days</button>
        <?php endforeach;
        endif; ?>