<?php
namespace application\controller;//ตั้งตาม structure ของ file
use application\core\AppController;
use application\util\UploadUtil;
class DemoController extends AppConTroller{ //ต้องเป็นชื่อเดียวกับ file

    public function index() {

        // $list = array("a", "b", "c");
        // jsonResponse([
        //     'test'=>'Hello world',
        //     'test2'=>'Hanuera',
        //     'list' => $list
        // ]);
    } // {object} [array]
    public function testUploadImage ()
    {
        $uid = 'guest';
        if (isset($_FILES['fileName']) && is_uploaded_file($_FILES['fileName']['tmp_name'])) {
            $newName = UploadUtil::getUploadFileName($uid);
            $imageName = UploadUtil::uploadImgFiles($_FILES['fileName'], null, 0, $newName);
            if($imageName) {
                jsonResponse ([
                    'imageName' => $imageName,
                ]);
            }
        }
        jsonResponse([
            'error' => 'Upload fail',
        ]);
    }
    
    
}