<?php
class User
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

    public static function find($id)
    {
        try
        {
            $conn = self::getConnection();
            
            $result = $conn->prepare("select * from user WHERE id= :id");
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
            
            $result = $conn->prepare("DELETE from user WHERE id= :id");
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
            
            $result = $conn->query("select * from user ORDER BY id desc");
            return $result->fetchAll();
            

        $conn = null;
        }
        catch (PDOException $e)
        {
            print $e->getMessage();
        }
    }

    public static function save($user)
    {
        try
        {
            $conn = self::getConnection();
            $id = addslashes($user['id']);
            $name = addslashes($user['name']);
            $login = addslashes($user['login']);
            $email = addslashes($user['email']);
           
           
            if (empty($id)) ///Insere o registro
            {
                $sql = "INSERT INTO user (name, login, email) 
                VALUES ('$name', '$login', '$email')";
            }
            else // Atualiza o registro
            {
                $sql = "UPDATE user SET name = '$name', login = '$login', email = '$email'            
                WHERE id = '$id'";
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