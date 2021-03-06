<?php
require dirname(__FILE__).'/../vendor/autoload.php';
include_once("endsAndStartsWith.php");

use PhpOffice\PhpSpreadsheet\IOFactory;

function readSheetFile($inputFileName){

    $inputFileType = IOFactory::identify($inputFileName);

    $reader = IOFactory::createReader($inputFileType);
    /**  Advise the Reader that we only want to load cell data  **/
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($inputFileName);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    return $sheetData;
}

function mapSheetData($mapping_variables, $sheet_data, $filename_format){
    $mapped_data = array();
    foreach ($sheet_data as $index => $sheet_row){
        $filtered_data = array_filter($sheet_row);
        if (count($filtered_data) == 0){
            $sheet_row = $filtered_data;
        }
        if (!empty($sheet_row)){
        
            $mapped_row = array();
            foreach ($mapping_variables as $key => $value){
                
                if (is_array($value)){
                    
                    $data_to_join = array();
                    foreach($value as $mapped_key){
                        if(!is_null($mapped_key)){
                            $mapping = $sheet_row[$mapped_key];
                            $data_to_join[] = $mapping;
                        }
                        else{
                            $data_to_join[] = '';
                        }
                    }
                    $mapped_element = implode(' ',$data_to_join);
                }
                else{
                    $mapped_element = $sheet_row[$value];
                }
                $mapped_row[$key] = preg_replace('/\s\s+/', ' ', trim($mapped_element));
            }
            
            //Mapping filename here also
            $mapped_filename = array();
            foreach($filename_format as $key => $value){
                if (startsWith($key,'fijo')){
                    $mapped_filename[] = $value; 
                }
                elseif (startsWith($key,'variable')){
                    if(array_key_exists($value,$mapped_row)){
                        $mapped_filename[] = str_replace(' ','_',trim($mapped_row[$value]));
                    }
                }
                elseif ($key == 'index'){
                    $mapped_filename[] = $index;
                }
            }
            $mapped_filename = preg_replace('/\s\s+/', '_', trim(implode('_',$mapped_filename)));
            
            $mapped_filename = preg_replace("/[^A-Za-z0-9ñÑ_-áÁéÉíÍóÓúÚüÜ]/", '', $mapped_filename);
            $mapped_row['$filename'] = $mapped_filename;
            
            $mapped_data[]=$mapped_row;
        }
    }
    return $mapped_data;
}