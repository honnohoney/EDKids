<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
/**
 * Created by Bekaku Php Back End System.
 * Date: 2023-03-16 10:41:20
 */

namespace application\controller;

use application\core\AppController;
use application\util\FilterUtils;
use application\util\i18next;
use application\util\SystemConstant;
use application\util\SecurityUtil;

use application\model\StudentPj;
use application\service\StudentPjService ;
class StudentPjController extends  AppController
{
    /**
    * @var StudentPjService
    */
    private $studentPjService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->studentPjService = new StudentPjService($this->getDbConn());

    }
    public function __destruct()
    {
        $this->setDbConn(null);
        unset($this->studentPjService);
    }
    public function crudList()
    {
        $perPage = FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) > 0 ? FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) : 0;
        $this->setRowPerPage($perPage);
        $q_parameter = $this->initSearchParam(new StudentPj());

        $this->pushDataToView = $this->getDefaultResponse();
        $this->pushDataToView[SystemConstant::DATA_LIST_ATT] = $this->studentPjService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView[SystemConstant::APP_PAGINATION_ATT] = $this->studentPjService->getTotalPaging();
        jsonResponse($this->pushDataToView);
    }
    public function crudAdd()
    {
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);

        if(!empty($jsonData) && !empty($uid)) {
           $entity = new StudentPj($jsonData, $uid, false);
               $lastInsertId = $this->studentPjService->createByObject($entity);
               if ($lastInsertId) {
                    $this->pushDataToView = $this->setResponseStatus([SystemConstant::ENTITY_ATT => $this->studentPjService->findById($lastInsertId)], true, i18next::getTranslation(('success.insert_succesfull')));
                }
        }
        jsonResponse($this->pushDataToView);

    }

    public function crudAddV2()
    {
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $jsonData = $this->getJsonData(false);

        $this->pushDataToView = $this->getDefaultResponse(false);
        $this->validateData($jsonData);

        if (!empty($jsonData) && !empty($uid)) {
            $entity = new StudentPj($jsonData, $uid, false);
            $lastInsetId = $this->studentPjService->createByObject($entity);
            if ($lastInsetId) {
                $this->pushDataToView = $this->setResponseStatus([]);
            }jsonResponse($this->pushDataToView);

            //ทำไมถึงเลือกใช้ create by object แทน create by array
            // ที่เดาไว้ create by array ต้องกำหนดตารางกับค่าให้ แต่ create by object จะไปดึงมาอัตโนมัติ
            $special = $jsonData->special;
            if($this->studentPjService->findByCode($special)){

            // $lastInsertId = $this->studentPjService->createByArray([
            //     // 'std_code' => $jsonData->std_code,
            //     // 'name' => $jsonData->name,
            //     // 'surname' => $jsonData->surname,
            //     // 'birth_date' => $jsonData->birth_date,
            //     // 'major_id' => $jsonData->major_id

                
            //     "special"=> $jsonData->special,
            //     "first_name"=> $jsonData->first_name,
            //     "last_name"=> $jsonData->last_name,
            //     "nick_name"=> $jsonData->nick_name,
            //     "birth" => $jsonData->birth,
            //     "img_name" => $jsonData->img_name,
            //     "img_file"=> $jsonData->img_file,
            //     "status"=> $jsonData->status,
            //     "techer_id"=> $jsonData->techer_id
            // ]);
            // jsonResponse([
            //     'insertId' => $lastInsertId
            // ]);

        } else {
            jsonResponse([
                'error' => "Action fail!!"
            ]);
        }
    }


    }
    private function validateData($jsonData) {
        if(empty($jsonData->special)) {
            jsonResponse([
                'error' => i18next::getTranslation('error.duplicateEmpty', ['username' => 'student code'])
            ]);
        }
        $stdExist = $this->studentPjService->findByCode($jsonData->special);
        if(!empty($stdExist)) {
            jsonResponse([
                'error' => i18next::getTranslation('error.EmptyError', ['data' => 'student code'])
            ]);}
        if($stdExist) {
            jsonResponse([
                'error' => i18next::getTranslation('error.EmptyError', ['username' => 'student code'])
            ]);}
        
    }
    public function crudReadSingle()
    {
        $id = FilterUtils::filterGetInt(SystemConstant::ID_PARAM);
        $this->pushDataToView = $this->getDefaultResponse(false);
        $item = null;
        if ($id > 0) {
            $item = $this->studentPjService->findById($id);
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
           $studentPj = new StudentPj($jsonData, $uid, true);
                if (isset($studentPj->id)) {
                   $effectRow = $this->studentPjService->updateByObject($studentPj, array('id' => $studentPj->id));
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
                $entity = $this->studentPjService->findById($id);
                if ($entity) {
                    $effectRow = $this->studentPjService->deleteById($id);
                    if (!$effectRow) {
                        $this->pushDataToView = $this->setResponseStatus($this->pushDataToView, false, i18next::getTranslation('error.error_something_wrong'));
                        break;
                    }
                }
            }
        }
        jsonResponse($this->pushDataToView);
    }

}