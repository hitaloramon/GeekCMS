<?php

require_once __DIR__ . '/baseControllerClass.php';

class saveController extends baseControllerClass{

    public function run(){

        $ModSlider = new ModSlider();
        $input = !empty($_POST['data']) ? $_POST['data'] : '';

        if (empty($input)) {
            $this->setError('Data is empty.');
            return;
        }

        $input = json_decode($input, true);

        if (!$input) {
            $this->setError('Error occurred while reading data.');
            return;
        }

        if ($input['id'] == 0) {
            $ModSlider->insert($input['title'], json_encode($input));
        }else{
            $ModSlider->update($input['id'], $input['title'], json_encode($input));
        }

        $this->setOutput(array(
            'result' => $input
        ));

    }

    public function getImagePlaceholder($source, $width, $height){

        $url = $this->config['placeholderSeparator'][0] . $source . $this->config['placeholderSeparator'][1];

        $url = str_replace(array(
            '{value}',
            '{width}',
            '{height}'
        ), array(
            $url,
            round($width),
            round($height)
        ), $this->config['image_placeholder_content']);

        $output = "url('{$url}') no-repeat transparent";

        return $output;
    }

}