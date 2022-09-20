<?php
/**
  short how to use
 */


require_once "sortVars.php";
// sort all globals
$new_sort_globals = new sortVars($GLOBALS);
// all defined
$new_sort_all_defined = new sortVars(get_defined_vars());

// you can access sorted variables like this
// $new_sort_globals->sorted["array"]["pages"] give the value of $pages

// reports for them
require_once "sortReportTemplate.php";
require_once "generateReport.php";

$report_globals = new generateReport($new_sort_globals->sorted,$new_sort_globals->status);
$report_defined = new generateReport($new_sort_all_defined->sorted,$new_sort_all_defined->status);


?>
<!-- display the reports -->
<div class="conteiner" >



    <div>
        <h4>Search for connection class connectionObjectFinder</h4>
        <p>
            <?php
                require_once "connectionObjectFinder.php";
                $test_connection_finder = new connectionObjectFinder($new_sort_all_defined->sorted["object"]);
                $test_connection_finder->searchForConnection();

                foreach($test_connection_finder->getFound() as $key => $line){
                    echo "{$key}</br>";
                }

            ?>
        </p>
    </div>

    <div>
        <?php // include "templates/test-template.php"; ?>
    </div>

    <?php  include "templates/all-vars-template.php"; ?>

</div>



