<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
/**
 * Created by Bekaku Php Back End System.
 * Date: 2023-03-10 11:03:33
 */

namespace application\controller;

use application\core\AppController;
use application\util\FilterUtils;
use application\util\i18next;
use application\util\SystemConstant;
use application\util\SecurityUtil;

use application\model\Student;
use application\service\StudentimgService;
use application\service\StudentService;
use application\util\UploadUtil;
use application\util\DateUtils;
class StudentController extends  AppController
{
    /**
    * @var StudentService
    */
    private $studentService;
    private $studentImageService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->studentService = new StudentService($this->getDbConn());
        $this->studentImageService = new StudentimgService($this->getDbConn());

    }
    public function __destruct()
    {
        $this->setDbConn(null);
        unset($this->studentService);
        unset($this->studentImageService);
    }
    public function crudList()
    {
        $perPage = FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) > 0 ? FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) : 0;
        $this->setRowPerPage($perPage);
        $q_parameter = $this->initSearchParam(new Student());

        $this->pushDataToView = $this->getDefaultResponse();
        $this->pushDataToView[SystemConstant::DATA_LIST_ATT] = $this->studentService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView[SystemConstant::APP_PAGINATION_ATT] = $this->studentService->getTotalPaging();
        jsonResponse($this->pushDataToView);
    }
    public function crudMajor() {
        $majorId = FilterUtils::filterGetInt('major_id');
        jsonResponse($this->studentService->findAllMajor($majorId));
    }
    public function crudAdd()
    {
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);

        if(!empty($jsonData) && !empty($uid)) {
           $entity = new Student($jsonData, $uid, false);
               $lastInsertId = $this->studentService->createByObject($entity);
               if ($lastInsertId) {
                    $this->pushDataToView = $this->setResponseStatus([SystemConstant::ENTITY_ATT => $this->studentService->findById($lastInsertId)], true, i18next::getTranslation(('success.insert_succesfull')));
                }
        }
        jsonResponse($this->pushDataToView);

    }
    public function crudReadSingle()
    {
        $id = FilterUtils::filterGetInt(SystemConstant::ID_PARAM);
        $this->pushDataToView = $this->getDefaultResponse(false);
        $item = null;
        if ($id > 0) {
            $item = $this->studentService->findById($id);
            if ($item) {
                $this->pushDataToView = $this->getDefaultResponse(true);
            }
        }
        $this->pushDataToView[SystemConstant::ENTITY_ATT] = $item;
        jsonResponse($this->pushDataToView);
    }
    public function crudEdit()
    {
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);
		
        if(!empty($jsonData) && !empty($uid)) {
           $student = new Student($jsonData, $uid, true);
                if (isset($student->id)) {
                   $effectRow = $this->studentService->updateByObject($student, array('id' => $student->id));
                   if ($effectRow) {
                       $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, true, i18next::getTranslation(('success.update_succesfull')));
                   }
               }
       }
        jsonResponse($this->pushDataToView);
    }
    public function crudDelete()
    {
        $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, true, i18next::getTranslation('success.delete_succesfull'));
        $idParams = FilterUtils::filterGetString(SystemConstant::ID_PARAMS);//paramiter format : idOfNo1_idOfNo2_idOfNo3_idOfNo4 ...
        $idArray = explode(SystemConstant::UNDER_SCORE, $idParams);
        if (count($idArray) > 0) {
            foreach ($idArray AS $id) {
                $entity = $this->studentService->findById($id);
                if ($entity) {
                    $effectRow = $this->studentService->deleteById($id);
                    if (!$effectRow) {
                        $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, false, i18next::getTranslation('error.error_something_wrong'));
                        break;
                    }
                }
            }
        }
        jsonResponse($this->pushDataToView);
    }
    public function studentUploadImage()
{
    //get studentId
    $studentId = $_POST["studentId"];
    // get user's id from JWT Token who change student's image.
    $uid = SecurityUtil::getAppuserIdFromJwtPayload();
    //check is user upload file or not
    if(isset($_FILES['filename']) && is_uploaded_file($_FILES['filename']['tmp_name'])) {
        //get student data by id
        $student = $this->studentService->findById($studentId);
        if(!empty($student)) {
            // delete old student's image before upload new one
            if (!empty($student->image_name)) {
                UploadUtil::delImgfileFromYearMonthFolder($student->image_name, null);
            }
        }
        // generate random unique name for this image
        $newName = UploadUtil::getUploadFileName($uid);
        // upload process if not upload success it will return image name
        $imageName = UploadUtil::uploadImgFiles($_FILES['filename'], null, 0, $newName);
        if ($imageName) {
            // upload this student's image_name in db by id
            $this->studentService->update([
                'image_name' => $imageName
            ], ['id' => $studentId]);
            // return image name to frontend
            jsonResponse ([
                'imageName' => $imageName,
            ]);
        
        }
        jsonResponse([
            'error' => 'Upload fail',
        ]);
    }

}


public function studentMultiUploadImage()
    {
        $studentId = $_POST['studentId'];
        $totalFile = $_POST['totalFile'];
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $imageList = array();
        if (!empty($uid) && !empty($studentId) && $totalFile > 0) {
            for ($i = 0; $i < $totalFile; $i++) {
                $fileUploadName = 'fileName_'.$i;
                if (is_uploaded_file($_FILES[$fileUploadName]['tmp_name'])) {
                    $newName = UploadUtil::getUploadFileName($studentId . '_' . $uid);
                    $imageName = UploadUtil::uploadImgFiles($_FILES[$fileUploadName], null, 0, $newName);
                    if ($imageName) {
                        $this->studentImageService->createByArray(
                            ["student_id"=>$studentId,
                            "image_name"=>$imageName,
                            "upload_user"=>$uid,
                            "upload_data"=>DateUtils::getDateNow()
                            ]
                        );
                        array_push($imageList, $imageName);
                    }
                }
            }
            jsonResponse([
                "images" => $imageList
            ]);
        }
        jsonResponse([
            "error" => i18next::getTranslation('error.oops'),
        ]);

    }

    private function validateData($jsonData)
    {
        if (empty($jsonData->std_code)) {
            jsonResponse([
                'error' => i18next::getTranslation('error.duplicateEmpty', ['username' => 'student code'])
            ]);
        }
        $stdExitst = $this->studentService->findbyCode($jsonData->std_code);
        if (!empty($stdExitst)) {
            jsonResponse([
                'error' => i18next::getTranslation('error.emptyError', ['data' => 'student code'])
            ]);
        }
    }





}



