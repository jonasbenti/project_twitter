<?php
require_once 'classes/Tweet.php';

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
            $Tweets = Tweet::all();

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
