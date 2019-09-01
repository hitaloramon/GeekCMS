<?php

class baseControllerClass {
    public $output;
    public $data;
    public $error;
    public $config;


    public function __construct(){
        $this->config = array(
            'upload_path' => '../userfiles/',
            'placeholderSeparator' => array('[', ']'),
            'image_placeholder_content' => '{value}'
        );

        $this->config['data_dir_path'] = $this->config['upload_path'] . 'data';
        $this->error = false;
        $this->output = array(
            'success' => true,
            'result' => array()
        );
    }

    /**
     * Set error
     * @param $msg
     */
    public function setError($msg){
        $this->error = true;
        $this->output['msg'] = $msg;
    }

    /**
     * Print output
     *
     */
    public function printOutput(){
        if ($this->error) {
            header("HTTP/1.0 400 Bad Request");
            echo '{ "msg": "' . $this->output['msg'] . '" }';
        } else {
            echo json_encode($this->output);
        }
    }

    /**
     * Get image
     * @param $src_path
     * @param bool $print
     * @return bool
     */
    public function getImage($src_path, $print = false, $quality = 100){

        $size = getimagesize($src_path);
        if ($size === false) {
            return false;
        }

        $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
        $icfunc = "imagecreatefrom" . $format;
        $ifunc = "image" . $format;
        if (!function_exists($icfunc) || !function_exists($ifunc)) {
            return false;
        }

        if ($print) {
            $image = $icfunc($src_path);
            if ($format == 'jpeg') {
                $ifunc($image, null, $quality);
            } else {
                if ($format == 'png') {
                    imagealphablending($image, false);
                    imagesavealpha($image, true);
                }
                $ifunc($image);
            }
            return '';
        } else {
            return $icfunc($src_path);
        }
    }

    /**
     * @param $file_name
     * @return string
     */
    public function getExtension($file_name){

        $temp_arr = explode('.', $file_name);
        $ext = end($temp_arr);
        return strtolower($ext);
    }

    /**
     * @param $src_path
     * @param string $dest_path
     * @param $thumb_width
     * @param $thumb_height
     * @param int $quality
     * @return bool
     */
    public function imageResize($src_path, $dest_path = '', $thumb_width, $thumb_height, $quality = 100){
        $isrc = $this->getImage($src_path, false, $quality);
        if ($isrc === false) {
            return false;
        }

        list($src_width, $src_height, $src_type) = getimagesize($src_path);
        $mime = image_type_to_mime_type($src_type);

        $format = strtolower(substr($mime, strpos($mime, '/') + 1));
        $icfunc = 'imagecreatefrom' . $format;
        $ifunc = 'image' . $format;

        $original_aspect = $src_width / $src_height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ($original_aspect >= $thumb_aspect) {
            $new_height = $thumb_height;
            $new_width = $src_width / ($src_height / $thumb_height);
        } else {
            $new_width = $thumb_width;
            $new_height = $src_height / ($src_width / $thumb_width);
        }

        $idest = imagecreatetruecolor($thumb_width, $thumb_height);

        if ($format == 'png') {

            imagealphablending($idest, false);
            imagesavealpha($idest, true);

        }

        // Resize and crop
        imagecopyresampled($idest,
            $isrc,
            0 - ($new_width - $thumb_width) / 2,
            0 - ($new_height - $thumb_height) / 2,
            0, 0,
            $new_width, $new_height,
            $src_width, $src_height);

        imageinterlace($idest, 1);

        if ($dest_path) {
            if ($format == 'jpeg') {
                $ifunc($idest, $dest_path, $quality);
            } else {
                $ifunc($idest, $dest_path);
            }
            imagedestroy($isrc);
            imagedestroy($idest);
            return true;
        } else {
            if ($format == 'jpeg') {
                $ifunc($idest, null, $quality);
            } else {
                $ifunc($idest);
            }
            imagedestroy($isrc);
            imagedestroy($idest);
        }
        return '';
    }

    /**
     * Get files list
     * @param string $dirPath
     * @param string $extension
     * @return array
     */
    public function getFilesList($dirPath = '', $extension = 'json', $keys = array(), $keyId = false){
        
        $ModSlider = new ModSlider();
        $output = $ModSlider->getSlider();

        $slider = array();

        foreach ($output as $key => $value) {
            $config = json_decode($value['config'], true);
            $slider[$key]['id'] = $value['id'];
            $slider[$key]['title'] = $value['title'];
            $slider[$key]['width'] = $config['width'];
            $slider[$key]['height'] = $config['height'];
            $slider[$key]['mtime'] = date("d/m/Y H:i", strtotime($value['date']));
        }

        return $slider;
    }



    /**
     * Format bytes
     * @param $bytes
     * @return string
     */
    public function formatBytes($bytes){
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' B';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' B';
        } else {
            $bytes = '0 B';
        }
        return $bytes;
    }

    /**
     * Validate link URL
     * @param $url
     * @return int
     */
    public function isURL($url){
        return preg_match('/^(http(s)?:\/\/|javascript:)(.+)$/i', $url);
    }

    /**
     * Set output
     * @param $newOutput
     */
    public function setOutput($newOutput){

        $this->output = array_merge($this->output, $newOutput);

    }

}
