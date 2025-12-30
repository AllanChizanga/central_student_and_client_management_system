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
    public function execute($directory,$document) 

    { 
        #posssible directories ndas, contracts, syllabuses, brds, etc
              #check if file is not null 
              if(!$document)
              {
                return null;
              }
              #save to documents directory 
              try {
                  $path = $document->store($directory, 'local'); # store in this directory in the local driver

              } catch (Throwable $e) {
                  logger()->error('Failed to save Document: ' . $e->getMessage(), [
                      'exception' => $e,
                  ]);
                  return null;
              }
              #return file path 
              return $path; 
    }
}//end of class


