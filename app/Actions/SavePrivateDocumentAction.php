<?php

namespace App\Actions;

use Throwable;


class SavePrivateDocumentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }//end of constructor

    
    #EXECUTE 
    public function execute($syllabus_pdf) 

    {
              #check if file is not null 
              if(!$syllabus_pdf)
              {
                return null;
              }
              #save to syllabuses directory 
              try {
                  $path = $syllabus_pdf->store('syllabuses', 'local');
              } catch (Throwable $e) {
                  logger()->error('Failed to save syllabus PDF: ' . $e->getMessage(), [
                      'exception' => $e,
                  ]);
                  return null;
              }
              #return file path 
              return $path; 
    }
}//end of class


