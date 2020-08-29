<?php
require_once 'classes/Hashtag.php';

class HashtagList
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list_hashtag.html');
    }

    public function delete($param)
    {
        try 
        {
            $id = (int) $param['id'];
            Hashtag::delete($id);
        } 
        
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function load()
    {
        try 
        {
            $Hashtags = Hashtag::all();

            $items = '';
            foreach ($Hashtags as $Hashtag)
            {     
                $item = file_get_contents('html/item_hashtag.html');
                $item = str_replace('{id}', $Hashtag['id'], $item);
                $item = str_replace('{description}', $Hashtag['description'], $item);
               
            
                $items .= $item;

            }
            $this->html = str_replace('{items}', $items, $this->html);
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public function show()
    {
        $this->load();
        echo $this->html;
    }


}
