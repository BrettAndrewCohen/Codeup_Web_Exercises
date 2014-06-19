<?php

class Filestore {

    public $filename = '';

    function __construct($filename = '') 
    {
        $this->filename = $filename;
    }

    /**
     * Returns array of lines in $this->filename
     */
    function read_lines() {
        $contents = [];
        if (is_readable($this->filename) && filesize($this->filename) > 0){
            $handle = fopen($this->filename, 'r');
            $bytes = filesize($this->filename);
            $contents = trim(fread($handle, $bytes));
            fclose($handle);
            $contents = explode("\n", $contents);
        }
        return $contents;
    }

    /**
     * Writes each element in $array to a new line in $this->filename
     */
    function write_lines($array) {
        if (is_writable($this->filename)) {
            $handle = fopen($this->filename, 'w');
            foreach($array as $items) {
            fwrite($handle, PHP_EOL . $items);
            }
        fclose($handle); 
        }   
    }

    /**
     * Reads contents of csv $this->filename, returns an array
     */
    function read_csv(){
        $contents = [];
        if (is_readable($this->filename) && filesize($this->filename) > 0){
            $handle = fopen($this->filename, 'r');
            while(!feof($handle)) {
                $row = fgetcsv($handle);
                if (is_array($row)) {
                $contents[] = $row;
                }
            }
            fclose($handle);
        }
        return $contents;
    }

    /**
     * Writes contents of $array to csv $this->filename
     */
    function write_csv($addresses_array) {
        $handle = fopen($this->filename, 'w');
        foreach ($addresses_array as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle); 
    }

}