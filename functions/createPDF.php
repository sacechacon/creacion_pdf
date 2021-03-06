<?php

function createDocxWithZipArchive($temp_full_path, $mapped_data){
    // add class Zip Archive
    $zip_val = new ZipArchive;

    //Docx file is nothing but a zip file. Open this Zip File
    if($zip_val->open($temp_full_path) == true)
    {
        // In the Open XML Wordprocessing format content is stored.
        // In the document.xml file located in the word directory.
        
        $key_file_name = 'word/document.xml';
        $message = $zip_val->getFromName($key_file_name);                
                    
        $timestamp = date('d-M-Y H:i:s');
        
        // this data Replace the placeholders with actual values
        foreach ($mapped_data as $key => $value) {
            //var_dump($key . ' ' . $value);
            $message = str_replace($key, $value,  $message);
            //$message = preg_replace('/\b' . $key . '\b/', $value,  $message);
        }        
        
        //Replace the content with the new content created above.
        $zip_val->addFromString($key_file_name, $message);
        $zip_val->close();
    }
}

function createDocxWithPHPWord($temp_full_path, $mapped_data){
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($temp_full_path);
    foreach ($mapped_data as $key => $value) {
        var_dump($key . ' ' . $value);
        $templateProcessor->setValue($key, $value);
    }      
    
    $templateProcessor->saveAs($temp_full_path);
}

function createPDF($pdf_folder, $template_file_name, $temp_full_path, $mapped_data, $soffice_path = NULL, $phpWord = TRUE){
    try
    {
        //Copy the Template file to the Result Directory
        copy($template_file_name, $temp_full_path);
        
        if($phpWord){
            createDocxWithPHPWord($temp_full_path, $mapped_data);
        }
        else{
            createDocxWithZipArchive($temp_full_path, $mapped_data);
        }
        
        if ($soffice_path) {
            #var_dump('"' . $soffice_path . '" --headless --convert-to pdf '.$temp_full_path.' --outdir '.$pdf_folder);
            shell_exec('"' . $soffice_path . '" --headless --convert-to pdf '.$temp_full_path.' --outdir '.$pdf_folder);
        } else {
            #var_dump('libreoffice --headless --convert-to pdf '.$temp_full_path.' --outdir '.$pdf_folder);
            shell_exec('libreoffice --headless --convert-to pdf '.$temp_full_path.' --outdir '.$pdf_folder);
        }
    }
    catch (Exception $exc) 
    {
        $error_message =  "Error creating the Word Document";
        var_dump($exc);
    }
}