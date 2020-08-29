<?php
require_once 'classes/User.php';

class UserList
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list_user.html');
    }

    public function delete($param)
    {
        try 
        {
            $id = (int) $param['id'];
            User::delete($id);
        } 
        
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function load()
    {
        try 
        {
            $Users = User::all();

            $items = '';
            foreach ($Users as $User)
            {     
                $item = file_get_contents('html/item_user.html');
                $item = str_replace('{id}', $User['id'], $item);
                $item = str_replace('{name}', $User['name'], $item);
                $item = str_replace('{login}', $User['login'], $item);
                $item = str_replace('{email}', $User['email'], $item);
               
            
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
