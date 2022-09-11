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
     * @var array whit the text data for making a template
     */
    private $text_content;


    /**
     * @var array whit  html tags and txt data for echoing
     */
    public $full_html_template;
    /**
     * @var array whit html tags and txt data for echoing
     */
    public $short_html_template;
    /**
     * @var array whit formating and txt data for inserting in file
     */
    public $txt_template;

    /**
     * sortReportTemplate constructor.
     * @param array $status - sortVars->status
     * @param array $sorted - sortVars->sorted
     */
    public function __construct(array $status, array $sorted)
    {
        $this->status = $status;
        $this->sorted = $sorted;
        $this->text_content = $this->txtContentTemplate();

    }

    /**
     * set the assemble of txt template
     */
    public function setTxtTemplate()
    {
        $this->constructTxtTemplate();
    }

    /**
     * set the assemble of Full HTML template
     *  display all found types whit the found count and variable names
     */
    public function setFullHtmlTemplate()
    {
        $this->constructFullHtmlTemplate();
    }

    /**
     * set the assemble of Short HTML template
     *  display all found types whit the found count of variables
     */
    public function setShortHtmlTemplate(){
        $this->constructShortHtmlTemplate();
    }

    /**
     * @return array whit prepared template
     */
    public function getFullHtmlTemplate()
    {
        return $this->html_template;
    }

    /**
     * @return array whit prepared template
     */
    public function getShortHtmlTemplate()
    {
        return $this->short_html_template;
    }

    /**
     * @return array whit prepared template
     */
    public function getTxtTemplate()
    {
        return $this->txt_template;
    }

    /**
     * @return array whit text for the report
     */
    private function txtContentTemplate(){

        $return = array(
            "- All detected variables : ".$this->status["all"],
        );
        foreach($this->sorted as $key => $vars){

            $return[$key] = array(
                "- ".ucfirst($key)." : ".$this->status[$key]."- ",
            );
            foreach($vars as $sub_key => $sub_data ){
                $return[$key][] = "- ".$sub_key."-";
            }

        }

        return $return;
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

        $this->short_html_template = $report;

    }

    /**
     * construct the template
     */
    private function constructFullHtmlTemplate(){

        $text_content = $this->text_content;

        $temp_template = array(
            "<div>",
            "<h4> ".preg_replace("/-/","",$text_content[0])."</h4>",
        );
        unset($text_content[0]);

        foreach($text_content as $key => $content_line){

            $content_line = preg_replace("/-/","",$content_line);

            $temp_template[] = "<ul>";
            $temp_template[] = " <h5>{$content_line[0]}</h5> ";
            unset($content_line[0]);

            foreach( $content_line as $content ){
                $content = preg_replace("/-/","",$content);
                $temp_template[] = "<li> {$content} </li>" ;
            }

            $temp_template[] = "</ul>";
        }
        $temp_template[] = "</div>";

        $this->html_template = $temp_template;
    }

    /**
     * construct the template
     */
    private function constructTxtTemplate(){

        $text_content = $this->text_content;

        $new_content = array(
            preg_replace("/-/","\t",$text_content[0])."\r\n",
        );
        unset($text_content[0]);

        foreach($text_content as $key => $content_line){

            $content_line = preg_replace("/-/","",$content_line);

            $new_content[] = "\r\n";
            $new_content[] = "\t {$content_line[0]} \r\n";
            unset($content_line[0]);

            foreach( $content_line as $sub_content ){
                $content = preg_replace("/-/","",$sub_content);
                $new_content[] = "\t \t {$content} \r\n" ;
            }
            $new_content[] = "\r\n";
        }

        $this->txt_template = $new_content;;

    }


}