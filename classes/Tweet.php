<?php
class Tweet
{

    private static $conn;

    public static function getConnection()
    {
        if(empty(self::$conn))
        {
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
        $ini = parse_ini_file('config/twitter.ini');
        $host = $ini['host'];
        $name = $ini['name'];
        $user = $ini['user'];
        $pass = $ini['pass'];
        $port = $ini['port'];
        self::$conn = new PDO("mysql:host={$host};port={$port};dbname={$name}",$user,$pass, $options);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function find_user_hashtag($user_id = null, $hashtag_id = null)
    {
    
        $where = "";
        if(!empty($user_id) && !empty($hashtag_id)) $where = " where t.user_id = $user_id and th.hashtag_id = $hashtag_id ";
        else if(!empty($user_id)) $where = " where t.user_id = $user_id ";
        else if(!empty($hashtag_id)) $where = " where th.hashtag_id = $hashtag_id ";

        try
        {
            $conn = self::getConnection();
            
            
            $result = $conn->query("SELECT 
            t.id AS tweet_id,
            t.description AS description,
            t.user_id AS user_id,
            u.login AS login,
            GROUP_CONCAT(IFNULL(h.description, '')) AS hashtags
          FROM
            tweet t
            INNER JOIN user u ON (t.user_id = u.id)
            LEFT JOIN tweet_hashtag th ON (t.id = th.tweet_id)
            LEFT JOIN hashtag h ON (th.hashtag_id = h.id)

            $where
            
           GROUP BY t.id DESC");
            return $result->fetchAll();

            
            

        $conn = null;
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }

    
}