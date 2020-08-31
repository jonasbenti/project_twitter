<?php
require_once 'classes/Tweet.php';
require_once 'classes/Hashtag.php';
require_once 'classes/User.php';

class TweetList
{
    private $html;

    public function __construct()
    {
        $this->html = file_get_contents('html/list_tweet.html');
    }

   
    public function load()
    {
        try 
        {
            // Lista os usuarios cadastrados
            $Users = User::all();
            $select_users = "<option selected=1 value='0'> Selecione um usuário </option>";
            foreach ($Users as $User)
            {
                $user_id   = $User['id'];
                $login = $User['login'];
                
                $select_users .= "<option value='{$user_id}'> {$login} </option>";

            }

            //lista as hashtags cadastradas
            $Hashtags = Hashtag::all();
            $select_hashtags = "<option selected=1 value='0'> Selecione uma hashtag </option>";
            foreach ($Hashtags as $Hashtag)
            {
                $hashtag_id   = $Hashtag['id'];
                $description = $Hashtag['description'];
                
                $select_hashtags .= "<option value='{$hashtag_id}'> {$description} </option>";

            }

            $user_id = 0;
            $hashtag_id = 0;
           
            //verifica se existe filtro
            if(isset($_REQUEST['filter']))
            {
                $user_id = $_REQUEST['user_id'];
                $hashtag_id = $_REQUEST['hashtag_id'];
            }
          
            

           $Tweets = Tweet::find_user_hashtag($user_id, $hashtag_id);

            $items = '';
            foreach ($Tweets as $Tweet)
            {     
                $item = file_get_contents('html/item_tweet.html');
                $item = str_replace('{tweet_id}', $Tweet['tweet_id'], $item);
                $item = str_replace('{description}', $Tweet['description'], $item);
                $item = str_replace('{login}', $Tweet['login'], $item);
                $item = str_replace('{hashtags}', $Tweet['hashtags'], $item);
               
            
                $items .= $item;

            }
            $this->html = str_replace('{combo_user}', $select_users, $this->html);
            $this->html = str_replace('{combo_hashtag}', $select_hashtags, $this->html);
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
