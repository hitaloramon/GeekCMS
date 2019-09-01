<?php

require_once __DIR__ . '/baseControllerClass.php';

class getFilesController extends baseControllerClass{

    public function run(){
        $files = $this->getFilesList('', 'json', array('id', 'title'));

        $this->setOutput(
            array(
                'result' => $files
            )
        );
    }
}