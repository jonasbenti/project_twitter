<?php
class Tweet
{

    private static $conn;

    public static function getConnection()
    {
        if(empty(self::$conn))
        {
        $ini = parse_ini_file('config/twitter.ini');
        $host = $ini['host'];
        $name = $ini['name'];
        $user = $ini['user'];
        $pass = $ini['pass'];
        $port = $ini['port'];
        self::$conn = new PDO("mysql:host={$host};port={$port};dbname={$name}",$user,$pass);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function find($id)
    {
        try
        {
            $conn = self::getConnection();
            
            $result = $conn->prepare("select * from hashtag WHERE id= :id");
            $result->execute([':id' => $id]);
            return $result->fetch();
            

        $conn = null;
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }



    public static function all()
    {
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
            INNER JOIN USER u ON (t.user_id = u.id)
            LEFT JOIN tweet_hashtag th ON (t.id = th.tweet_id)
            LEFT JOIN hashtag h ON (th.hashtag_id = h.id)
            
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