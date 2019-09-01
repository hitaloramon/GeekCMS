<?php

require_once __DIR__ . '/baseControllerClass.php';

class uploadController extends baseControllerClass{

    public function run(){

        if (!empty($_FILES['image']) && !$_FILES['image']["error"]) {

            $opt_width = !empty($_POST['width']) && is_numeric($_POST['width']) ? intval($_POST['width']) : 0;
            $opt_height = !empty($_POST['height']) && is_numeric($_POST['height']) ? intval($_POST['height']) : 0;

            $valid_extensions = array('gif', 'png', 'jpg', 'jpeg');

            $tmp_name = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']["name"];
            $ext_arr = explode('.', $name);
            $extension = $this->getExtension($name);

            if (in_array($extension, $valid_extensions)) {

                if(!is_dir(BASE_UPLOADS_PATH.'/modules/slider/')){
                    mkdir(BASE_UPLOADS_PATH.'/modules/slider/', 0755, true);
                }

                $new_filename = uniqid() . '_' . strtotime("now");
                $file_path = BASE_UPLOADS_PATH.'/modules/slider/'. $new_filename . '.' . $extension;

                if (file_exists($file_path)) {
                    unlink($file_path);
                }

                move_uploaded_file($tmp_name, $file_path);
                chmod($file_path, 0777);

                list($width, $height, $type) = getimagesize($file_path);
                $mime = image_type_to_mime_type($type);

                ob_start();

                if ($width > $opt_width || $height > $opt_height) {
                    $this->imageResize($file_path, '', $opt_width, $opt_height);
                    $width = $opt_width;
                    $height = $opt_height;
                } else {
                    $this->getImage($file_path, true);
                }

                $contents = ob_get_contents();
                ob_end_clean();

                $this->output['result']['path'] = str_replace(BASE_UPLOADS_PATH.'/modules/slider/', '', $file_path);
                $this->output['width'] = $width;
                $this->output['height'] = $height;

            } else {
                $this->setError('The file type is invalid.');
            }

        }

    }

}

return 'uploadController';
