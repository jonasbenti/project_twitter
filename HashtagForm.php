    <?php
    require_once 'classes/Hashtag.php';

    class HashtagForm
    {
    private $html;
    private $data;

    public function __construct() {
        $this->html = file_get_contents('html/form_hashtag.html');
        $this->data = [
        'id' => null,
        'description' => null
        ];

        }

        public function edit($param)
        {
            try 
            {
                $id = (int) $param['id'];
                $this->data = Hashtag::find($id);
            } 
            catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function save($param)
        {
            try 
            {
                Hashtag::save($param);
                $this->data = $param;
                header("Location: index.php");

            } 
            catch (Exception $e) {
                echo $e->getMessage();
            }
        }

        public function show()
        {
            $this->html  = file_get_contents('html/form_hashtag.html');
            $this->html  = str_replace('{id}', $this->data['id'], $this->html );
            $this->html  = str_replace('{description}', $this->data['description'], $this->html );
     
            echo $this->html;
        }



    }


