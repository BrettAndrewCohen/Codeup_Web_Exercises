<?php 

class AddressDataStore {

    // public $filename = 'address_book.csv';
    public $filename = '';

    function __construct($nameOfFile)
    {
        $this->filename = $nameOfFile;
    }

    function readcsv(){
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

    function savefile($addresses_array) {
        $handle = fopen($this->filename, 'w');
        foreach ($addresses_array as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle); 
    }

}