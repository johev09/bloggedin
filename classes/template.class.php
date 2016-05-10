<?php

require_once __DIR__.'/../core/functions.php';

class Template {    
    protected $file;
    protected $title;
    protected $values = array();
    protected $folder_template;
    
    public $template;
  
    public function __construct() {
        $this->folder_template = config('folder.template');
        $this->title = config('title');
    }
    
    function render($file , $params = null) {
        
        $extension=".php";
        
        $this->file = $this->folder_template.$file.$extension;
        
        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).";
        }
        //$output = file_get_contents($this->file);
        if (is_array($params) && count($params)) {
            //set default title if param not passed
            if(!isset($params['title']))
                $params['title']=$this->title;
        }
        else {
            $params = ["title"=>$this->title];
        }
        $this->template=$file;
        
        // extract array keys as local variables
        extract($params,EXTR_SKIP);
        
        ob_start();
        include $this->file;
        $output = trim(ob_get_clean());

        /*foreach ($params as $key => $value) {
            $tagToReplace = "{$key}";
            $output = str_replace($tagToReplace, $value, $output);
        }*/

        return $output;
    }
}