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

    <h4> Testing classes sortVar and generateReport</h4>

    <div>

        <table>
            <thead> Short report </thead>
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
        </table>

        <table>
            <thead> Full report </thead>
            <tr>
                <th>GLOBALS</th>
                <th>DEFINED</th>
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

    <div>
        <table>
            <thead> GLOBALS report by type </thead>
            <tr>
                <td>
                    <?php $report_globals->displayReportByType("object"); ?>
                </td>
            </tr>
        </table>
    </div>

</div>



