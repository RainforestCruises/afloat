$destination = '';
    $postType = 'rfc_cruises';
    if (isset($_POST['destination-select']) && $_POST['destination-select'])
        $destination = $_POST['destination-select'];
        
    $searchParameters = array(
        'post_type' => $postType,
        'destination' => $destination
    );



    get_template_part('template-parts/content', 'main-search-results', $searchParameters);


    onClick="window.open('<?php echo get_permalink(); ?>')"


    $sortOrder = '';
    if (isset($_POST['result-sort']) && $_POST['result-sort'])
        $sortOrder = $_POST['result-sort'];

    $destination = '';
    if (isset($_POST['destination-select']) && $_POST['destination-select'])        $sortOrder = $_POST['result-sort'];
        $destination = $_POST['destination-select'];