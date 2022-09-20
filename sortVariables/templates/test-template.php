<?php
/**
 * Created by PhpStorm.
 * User: stoi
 * Date: 18.9.2022 г.
 * Time: 17:20
 */


?>

<div>
    <h5> get_object_vars </h5>
    <p>
    <p> wpdb get_object_vars</p>
    <?php print_r( get_object_vars($new_sort_all_defined->sorted["object"]["wpdb"]) );  ?>
    </p>
    <p>
    <p> wpdb get_class_vars</p>
    <?php print_r( get_class_vars(get_class($new_sort_all_defined->sorted["object"]["wpdb"])) );  ?>
    </p>

</div>

<div>
    <h5> get_class_methods</h5>
    <p>
    <p> wpdb </p>
    <?php var_dump(get_class_methods($new_sort_all_defined->sorted["object"]["wpdb"])); ?>
    </p>

</div>

<div>
    <h5> get_class name - <?php print_r(get_class($new_sort_all_defined->sorted["object"]["wpdb"])); ?></h5>

    <p>
        <?php

        //print_r( get_object_vars( $new_sort->sorted["resource"]["pg"] ) );

        echo get_resource_type($new_sort_all_defined->sorted["resource"]["pg"]) . "\n";

        ?>
    </p>
</div>

