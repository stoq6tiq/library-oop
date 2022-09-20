<?php

/**
 *  Generate template for short or full HTML status report
 *  or
 *  Generate text file whit the full report
 *
 *  generated html and file report look like
 *      variable_type : count ( variables )
 *          variable_name
 *
 */
class generateReport
{
    private $sort_template;

    /**
     * generateReport constructor.
     * @param array $sorted variable from class sortVars -> $sorted
     * @param array $status variable from class sortVars -> $status

     */
    public function __construct( $sorted, $status)
    {
        $this->sort_template = new sortReportTemplate($status,$sorted);

    }


    public function displayFullHtml(){

        $this->display($this->sort_template->getFullHtmlTemplate());

    }

    public function displayShortHtml(){

        $this->display($this->sort_template->getShortHtmlTemplate());

    }

    public function displayReportByType($type){

        $this->display($this->sort_template->getReportByType($type));

    }

    public function createFileReport(){

        $template = $this->sort_template->getTxtTemplate();

        $content = implode("",$template);

        $new_file_name = "report".date("d-m-y-H-i-s");
        $file_name = abstractLibrary::convertDirectorySeparator(__DIR__."/reports/".$new_file_name.".txt");

        if( file_put_contents($file_name,$content)  ){
            echo "created : {$file_name}";
        }else{  echo "OpppsssS"; }


    }

    private function display($display){
        foreach($display as  $templ_line){
            echo $templ_line;
        }

    }


}