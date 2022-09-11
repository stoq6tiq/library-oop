<?php

/**
 * Created by PhpStorm.
 * User: stoi
 * Date: 10.9.2022 г.
 * Time: 20:40
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

        $this->sort_template->setFullHtmlTemplate();
        $this->display($this->sort_template->getFullHtmlTemplate());

    }

    public function displayShortHtml(){

        $this->sort_template->setShortHtmlTemplate();
        $this->display($this->sort_template->getShortHtmlTemplate());

    }

    public function createFileReport(){

        $this->sort_template->setTxtTemplate();
        $template = $this->sort_template->getTxtTemplate();

        $content = implode("",$template);

        $new_file_name = "report".date("d-m-y-H-i-s");
        $file_name = abstractLibrary::convertDirectorySeparator(__DIR__."/reports/".$new_file_name.".txt");

        if( file_put_contents($file_name,$content)  ){
            echo "created : {$file_name}";
        }else{  echo "OpppsssS"; }


    }

    private function display($display){

        foreach($display as $templ_line){
            echo $templ_line;
        }

    }


}