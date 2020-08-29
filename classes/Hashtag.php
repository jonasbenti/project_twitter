<?php
class Hashtag
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

    public static function delete($id)
    {
        try
        {
            $conn = self::getConnection();
            
            $result = $conn->prepare("DELETE from hashtag WHERE id= :id");
            $result->execute([':id' => $id]);
            return $result;
            

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
            
            $result = $conn->query("select * from hashtag ORDER BY id desc");
            return $result->fetchAll();
            

        $conn = null;
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }

    public static function save($hashtag)
    {
        try
        {
            $conn = self::getConnection();
            $id = addslashes($hashtag['id']);
            $description = addslashes($hashtag['description']);
           
           
            if (empty($id)) ///Insere o registro
            {
                $sql = "INSERT INTO hashtag (description) VALUES ('$description')";
            }
            else // Atualiza o registro
            {
                $sql = "UPDATE hashtag SET description = '$description' WHERE id = '$id'";
            }

            return $conn->query($sql);
            

        $conn = null;
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }

    
}