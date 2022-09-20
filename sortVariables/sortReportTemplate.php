<?php


/**
 * Class sortReportTemplate
 *
 * prepare template for generating a report in html or text file
 */
class sortReportTemplate
{


    /**
     * @var array result from sortVars->status
     */
    private $status;

    /**
     * @var array sorted result from sortVars->sorted
     */
    private $sorted;

    /**
     * sortReportTemplate constructor.
     * @param array $status - sortVars->status
     * @param array $sorted - sortVars->sorted
     */
    public function __construct(array $status, array $sorted)
    {
        $this->status = $status;
        $this->sorted = $sorted;
    }

    /**
     * @return array whit prepared template
     */
    public function getFullHtmlTemplate()
    {
        return $this->txtContentTemplate();
    }

    /**
     * @return array whit prepared template
     */
    public function getShortHtmlTemplate()
    {
        return $this->constructShortHtmlTemplate();
    }

    public function getReportByType($type){
        return $this->constructTypeTemplate($type);
    }

    /**
     * @return array whit prepared file template
     */
    public function getTxtTemplate()
    {
        return $this->txtContentTemplate("file");
    }

    private function tagsByType($content_for){
        $wraper = array(
            "open" => array(),
            "close" => array()
        );
        switch($content_for){
            case "file":
                $wraper["open"]["head"] = "\t";
                $wraper["close"]["head"] = "\r\n";
                $wraper["open"]["lvl-1"] = "\t";
                $wraper["close"]["lvl-1"] = "\r\n";
                $wraper["open"]["lvl-2"] = "\t \t";
                $wraper["close"]["lvl-2"] = "\r\n";
                break;
            default:
                $wraper["open"]["head"] = "<h5>";
                $wraper["close"]["head"] = "</h5>";
                $wraper["open"]["lvl-1"] = "<ul>";
                $wraper["close"]["lvl-1"] = "</ul>";
                $wraper["open"]["lvl-2"] = "<li>";
                $wraper["close"]["lvl-2"] = "</li>";
        }
        return $wraper;
    }

    /**
     * @var string $content_for default is "html" or can be set to "file" for inserting in file
     *
     * @return array whit text for the report
     */
    private function txtContentTemplate($content_for = "html"){

        $tags = $this->tagsByType($content_for);

        $return = array(
            $tags["open"]["head"]."All detected variables : ".$this->status["all"]. $tags["close"]["head"],
        );

        foreach($this->sorted as $key => $vars){

            $return[] =   $tags["open"]["lvl-1"];

            $return[] = $tags["open"]["head"].ucfirst($key)." : ".$this->status[$key].$tags["close"]["head"];

            foreach($vars as $sub_key => $sub_data ){
                $return[] = $tags["open"]["lvl-2"].$sub_key.$tags["close"]["lvl-2"];
            }

            $return[] = $tags["close"]["lvl-1"];

        }

        return $return;
    }

    /**
     * construct the template
     */
    private function constructTypeTemplate($type){

        $report = array();

        $report[] = "<h5> All found {$type}s  : ".count($this->sorted[$type])."</h5>";
        $report[] = "<ul>";
            $report[] = "<ul>";
                foreach($this->sorted[$type] as $key => $data){
                    $report[] = "<li> {$key} </li>";
                }
            $report[] = "</ul>";
        $report[] = "</div>";

        return $report;

    }

    /**
     * construct the template
     */
    private function constructShortHtmlTemplate(){

        $report = array();

        $report[] = "<div>";
        $report[] = "<ul>";
        foreach($this->status as $key => $data){
            $report[] = "<li> {$key} : ".htmlspecialchars($data)."</li>";
        }
        $report[] = "</ul>";
        $report[] = "</div>";

        return $report;

    }




}