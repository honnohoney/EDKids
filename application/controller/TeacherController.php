<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
/**
 * Created by Bekaku Php Back End System.
 * Date: 2023-03-14 08:07:34
 */

namespace application\controller;

use application\core\AppController;
use application\util\FilterUtils;
use application\util\i18next;
use application\util\SystemConstant;
use application\util\SecurityUtil;

use application\model\Teacher;
use application\service\TeacherService ;
class TeacherController extends  AppController
{
    /**
    * @var TeacherService
    */
    private $teacherService;
    public function __construct($databaseConnection)
    {
        $this->setDbConn($databaseConnection);
        $this->teacherService = new TeacherService($this->getDbConn());

    }
    public function __destruct()
    {
        $this->setDbConn(null);
        unset($this->teacherService);
    }
    public function crudList()
    {
        $perPage = FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) > 0 ? FilterUtils::filterGetInt(SystemConstant::PER_PAGE_ATT) : 0;
        $this->setRowPerPage($perPage);
        $q_parameter = $this->initSearchParam(new Teacher());

        $this->pushDataToView = $this->getDefaultResponse();
        $this->pushDataToView[SystemConstant::DATA_LIST_ATT] = $this->teacherService->findAll($this->getRowPerPage(), $q_parameter);
        $this->pushDataToView[SystemConstant::APP_PAGINATION_ATT] = $this->teacherService->getTotalPaging();
        jsonResponse($this->pushDataToView);
    }
    public function crudAdd()
    {
        $uid = SecurityUtil::getAppuserIdFromJwtPayload();
        $jsonData = $this->getJsonData(false);
        $this->pushDataToView = $this->getDefaultResponse(false);

        if(!empty($jsonData) && !empty($uid)) {
           $entity = new Teacher($jsonData, $uid, false);
               $lastInsertId = $this->teacherService->createByObject($entity);
               if ($lastInsertId) {
                    $this->pushDataToView = $this->setResponseStatus([SystemConstant::ENTITY_ATT => $this->teacherService->findById($lastInsertId)], true, i18next::getTranslation(('success.insert_succesfull')));
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
            $item = $this->teacherService->findById($id);
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
           $teacher = new Teacher($jsonData, $uid, true);
                if (isset($teacher->id)) {
                   $effectRow = $this->teacherService->updateByObject($teacher, array('id' => $teacher->id));
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
                $entity = $this->teacherService->findById($id);
                if ($entity) {
                    $effectRow = $this->teacherService->deleteById($id);
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