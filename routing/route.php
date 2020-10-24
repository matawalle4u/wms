<?php
class Route
{
    private $_uri = array();
    public function add($uri)
    {
        $this->_uri[] = '/'. trim($uri,'/');
    }
    public function submit()
    {
        $uri_param = isset($_GET['uri']) ? $_GET['uri']:'/';

        foreach($this->_uri as $key => $value)
        {
            if(preg_match("#^$value$#", $uri_param))
            {

            }
        }
    }
}
?>
