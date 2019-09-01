<?php

require_once __DIR__ . '/baseControllerClass.php';

class itemController extends baseControllerClass{

    public function run(){

        $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);

        switch ($requestMethod) {
            case 'get':
                $fileId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

                if (!$fileId) {
                    $this->setError('Empty file ID.');
                    return;
                }else{
                    $ModSlider = new ModSlider();
                    $content = $ModSlider->getSlider($fileId);
                    $config = json_decode($content['config'], true);
                    $config['id'] = $fileId;


                    $this->setOutput(array(
                        'result' => $config
                    ));
                }
            break;
            case 'delete':
                $itemId = isset($_GET['id']) && is_numeric($_GET['id']) ? $_GET['id'] : 0;

                if ($itemId) {
                    $ModSlider = new ModSlider();
                    $ModSlider->delete($itemId);
                }
            break;
        }
    }

}