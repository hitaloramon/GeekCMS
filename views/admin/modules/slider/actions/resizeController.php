<?php

require_once __DIR__ . '/baseControllerClass.php';

class resizeController extends baseControllerClass{

    public function run(){

        $path = isset($_POST['path']) && !is_array($_POST['path']) ? $_POST['path'] : '';
        $opt_width = isset($_POST['width']) && is_numeric($_POST['width']) ? intval($_POST['width']) : 150;
        $opt_height = isset($_POST['height']) && is_numeric($_POST['height']) ? intval($_POST['height']) : 150;

        if (!$path || !file_exists(BASE_UPLOADS_PATH.'/modules/slider/' . $path)) {
            $this->setError('File not exists.');
            return;
        }

        $file_path = BASE_UPLOADS_PATH.'/modules/slider/' . $path;
        list($width, $height, $type) = getimagesize($file_path);
        $mime = image_type_to_mime_type($type);

        ob_start();

        $this->imageResize($file_path, '', $opt_width, $opt_height);

        $contents = ob_get_contents();
        ob_end_clean();

        $this->output['result']['path'] = str_replace(BASE_UPLOADS_PATH.'/modules/slider/', '', $file_path);
        $this->output['width'] = $opt_width;
        $this->output['height'] = $opt_height;
    }

}
