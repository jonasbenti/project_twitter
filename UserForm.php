    <?php
    require_once 'classes/User.php';

    class Userform
    {
    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/form_user.html');
        $this->data = [
        'id' => null,
        'name' => null,
        'login' => null,
        'email' => null
        ];

        }

        public function edit($param)
        {
            try 
            {
                $id = (int) $param['id'];
                $this->data = User::find($id);
            } 
            catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function save($param)
        {
            try 
            {
                User::save($param);
                $this->data = $param;
                header("Location: UserList.php");

            } 
            catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function show()
        {
            $this->html  = file_get_contents('html/form_user.html');
            $this->html  = str_replace('{id}', $this->data['id'], $this->html );
            $this->html  = str_replace('{name}', $this->data['name'], $this->html );
            $this->html  = str_replace('{login}', $this->data['login'], $this->html );
            $this->html  = str_replace('{email}', $this->data['email'], $this->html );
     
            echo $this->html;
        }



    }


