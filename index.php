<?php
/**
  short how to use
 */

require_once "abstractLibrary.php";
require_once "sortVars.php";
require_once "sortReportTemplate.php";
require_once "generateReport.php";


// all globals
// you can access sorted variables ike this
// $new_sort_globals->sorted["array"]["pages"]

$new_sort_globals = new sortVars($GLOBALS);

$report_globals = new generateReport($new_sort_globals->sorted,$new_sort_globals->status);

$impl = $new_sort_globals->sorted["array"]["pages"];

// all defined
$new_sort_all_defined = new sortVars(get_defined_vars());
$report_defined = new generateReport($new_sort_all_defined->sorted,$new_sort_all_defined->status);

// you can access sorted variables ike this
// $new_sort_globals->sorted["array"]["pages"]

echo " <div> <p> the variable pages - ". implode(" ; ",$impl)." </p> </div>";

?>
<!-- display the reports -->
<div class="conteiner" >

    <table>
        <tr>
            <th>GLOBALS</th>
            <th>DEFINED</th>
        </tr>
        <tr>
            <td>
                <?php $report_globals->displayShortHtml(); ?>
            </td>
            <td>
                <?php $report_defined->displayShortHtml(); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php $report_globals->displayFullHtml(); ?>
            </td>
            <td>
                <?php $report_defined->displayFullHtml(); ?>
            </td>
        </tr>

    </table>

</div>

