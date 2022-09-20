<?php

?>
<div>
    <table>
        <th> report by type </th>
        <tr>
            <td>
                <?php $report_globals->displayReportByType("object"); ?>
            </td>
        </tr>
    </table>
</div>
<div>
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
