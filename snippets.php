function my_acf_admin_head()
{
?>
    <style type="text/css">
        .admin_itinerary_name {
            font-size: 20px;
            position: relative;
        }

        .admin_itinerary_name::after {
            position: absolute;
            content: "";
            height: 2px;
            width: 100%;
            background-color: cornflowerblue;
            top: 0;
            left: 0;
            z-index: 10;
        }
    </style>
<?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');