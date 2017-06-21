<?php
class View 
{
    private $title;
    private $content;
    private $style;
    private $directory = "Elements/";
    private $templateExtension= ".html";
    private $templateBase = "template/template.php";
    private $styleExtension = ".css";
    
    
    
    

    public function loadHtml($fileName)
    {
        $html = "";
        $html .= "<div id='" . str_replace($this->templateExtension,"", $fileName) . "'>";
        $html .= file_get_contents($this->directory . $fileName);        
        $html .= "</div>";
        
        return $html;
     
    }
    
    
    public function loadCss($fileName){
        $css = "<link rel='stylesheet' href='" . $this->directory . $fileName ."'>";
        return $css;
    }


     // methode qui charge tout le html

     public function renderPage($title)
     {
         $template = file_get_contents($this->directory . $this->templateBase);
         $css = "";
         $html = "";
         $directoryList = scandir($this->directory);
         foreach($directoryList as $key => $value){
          
            if(strpos($value, $this->templateExtension) !== False){
                $html .= $this->loadHtml($value);

             }

             if(strpos($value, $this->styleExtension) !== False){
                $css .= $this->loadCss($value);

             }
         }
         $template = str_replace('%%TITLE%%', $title, $template);         
         $template = str_replace('%%CONTENT%%', $html, $template);
         $template = str_replace('%%STYLE%%', $css, $template);
         $template = str_replace('%%MENU%%', file_get_contents($this->directory . "template/menu.php"), $template);
         
        echo $template;
     }
   
}