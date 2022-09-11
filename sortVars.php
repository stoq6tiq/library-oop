<?php


/**
 * Class sortVars
 *
 * class for one-dimensional sorting of arrays of variables by value type ( string, array, object, int, boolian, double .... e.x)
 *
 * public var $sorted - array containing all variables sorted by type
 *  - sorted["array"] - all found arrays
 *  - sorted["object"] - all found objects
 * for access to a variable :  sortVar->sorted[ variable type ][ variable name ]
 *  .....
 *
 * public var $status - array of the count elements of value tupe
 *  - $status["all"] - the count of all variables
 *  - $status["array] - the count of all arrays
 * .....
 *
 *
 */
class sortVars
{

    /**
     * @var array array of mixed variabels for sorting
     */
    private $search_in;

    /**
     * @var array the sorted results
     *
     *  you can use them by sortVar->sorted[ variable type ][ variable name ]
     */
    public  $sorted = array();

    /**
     * @var array
     */
    public  $status = array();


    /**
     * sortVars constructor.
     * @param array $search_in - array of mixed variabels for sorting
     *   if given array for sorting the constructor will call the sorting
     *   or you can set it lather in findAllByType()
     */
    public function __construct( $search_in = "")
    {
        if( !empty($search_in) ){
            $this->search_in = $this->removeEmpty( $search_in );
        }
        if( !empty($this->search_in) ){
            $this->findAllByType($this->search_in);
        }
    }


    /**
     * @param array  $search_in
     *   if not set in constructor or need second sorting
     */
    public function findAllByType( $search_in = ""){

        if(!empty($search_in)){
            $this->search_in = $this->removeEmpty($search_in);
        }

        $this->sortAndValidate();
        $this->generateReport();

    }

    /**
     *
     */
    private function generateReport(){

        $this->status["all"] = count($this->search_in);

        foreach($this->sorted as $key1 => $data1){
            $this->status[$key1] = count($data1);
        }

    }

    /**
     * @param array $search_in
     * @return array
     */
    private function removeEmpty( $search_in ){

        return array_filter($search_in) ;

    }

    /**
     *  sorting is done by calling gettype() on each variable
     *  validation is done by is_"variable type"()
     */
    private function sortAndValidate(){

        foreach( $this->search_in as $key => $value ){

            if(!empty($value)){

                $value_type = gettype($value);
                $func = $this->createValidationFunction($value_type);

                if( $func($value) ){

                    if(!isset($this->sorted[$value_type])){
                        $this->sorted[$value_type] = array();
                    }
                    $this->sorted[$value_type][$key] = $value;

                }

            }
        }

    }

    /**
     * @param string $value_type
     * @return string of corect is_type function
     *
     *  use to handle difrent variable validation functions
     */
    private function createValidationFunction($value_type){

        switch ($value_type) {

            case "boolean":
                $value_type_name = "bool";
                break;
            default:
                $value_type_name = $value_type;

        }

        return "is_".$value_type_name;
    }

}