<?php

class View {
 
    public static $capture;
    public static $content;
    public static $section;

    protected function setContent($content){
        self::$content = $content;
    }

    /**
     *
     * Gets the content to be used in the layout.
     *
     * @return string
     *
     */
    public function getContent(){
        return self::$content;
    }

    /**
     *
     * Is a particular named section available?
     *
     * @param string $name The section name.
     *
     * @return bool
     *
     */
    public function hasSection($name){
        return isset(self::$section[$name]);
    }


    protected function setSection($name, $body){
        if(self::hasSection($name)){
            self::$section[$name] = self::getSection($name) . $body;
        }else{
            self::$section[$name] = $body;
        }
    }

    /**
     *
     * Gets the body of a named section.
     *
     * @param string $name The section name.
     *
     * @return string
     *
     */
    public function getSection($name){
        if(self::hasSection($name)){
            return self::$section[$name];
        }
    }

    /**
     *
     * Begins output buffering for a named section.
     *
     * @param string $name The section name.
     *
     * @return null
     *
     */
    public function startSection($name){
        self::$capture[] = $name;
        ob_start();
    }

    /**
     *
     * Ends buffering and retains output for the most-recent section.
     *
     * @return null
     *
     */
    public function endSection(){
        $body = ob_get_clean();
        $name = array_pop(self::$capture);
        self::setSection($name, $body);
    }
}
