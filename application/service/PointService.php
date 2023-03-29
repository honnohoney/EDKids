<?php
/** ### Generated File. If you need to change this file manually, you must remove or change or move position this message, otherwise the file will be overwritten. ### **/
namespace application\service;

use application\core\BaseDatabaseSupport;
use application\serviceInterface\PointServiceInterface;
use application\model\Point;
class PointService extends BaseDatabaseSupport implements PointServiceInterface
{
    protected $tableName = 'point';

    public function __construct($dbConn){
        $this->setDbh($dbConn);
    }
    public function findAll($perpage=0, $q_parameter=array())
    {
        //if have param
        $data_bind_where = null;

        $query = "SELECT *  ";

        $query .="FROM point AS point ";

		//default where query
        $query .=" WHERE point.`id` IS NOT NULL ";
		//custom where query
       //$query .= "WHERE point.custom_field =:customParam ";

        //gen additional query and sort order
       $additionalParam = $this->genAdditionalParamAndWhereForListPageV2($q_parameter, new Point());
       if(!empty($additionalParam)){
           if(!empty($additionalParam['additional_query'])){
               $query .= $additionalParam['additional_query'];
           }
           if(!empty($additionalParam['where_bind'])){
               $data_bind_where = $additionalParam['where_bind'];
           }
       }

        //custom where paramiter
       // $data_bind_where['custom_field']=$paramValue;
       //end
        //paging buider
        if($perpage>0){
            $query .= $this->pagingHelper($query, $perpage, $data_bind_where);
        }
        //regular query
        $this->query($query);

        //START BIND VALUE FOR REGULAR QUERY
        //$this->bind(":q_name", "%".$q_parameter['q_name']."%");//bind param for 'LIKE'
	     //$this->bind(":q_name", $q_parameter['q_name']);//bind param for '='
        //END BIND VALUE FOR REGULAR QUERY

        //bind param for search param
        $this->genBindParamAndWhereForListPage($data_bind_where);

        return  $this->list();
    }

    public function findById($id)
    {
        $query = "SELECT *  ";

        $query .="FROM point AS point ";
        $query .="WHERE point.`id`=:id ";

        $this->query($query);
        $this->bind(":id", (int)$id);
        return  $this->single();
    }
    public function findByStdId($id)
    {
        $query = "SELECT * ";
        $query .= "FROM point AS point ";
        $query .= "WHERE point.student_id=:id";

        $this->query($query);
        $this->bind(":id", $id);
        return $this->list();
    }
    public function pointSum($id)
    {
        $query = "SELECT SUM(IF(level = 'very_good', 1,0)) ";
        $query .="AS VERY_GOOD, SUM(IF(level = 'good', 1,0)) AS GOOD, ";
        $query .="SUM(IF(level = 'bad', 1,0)) AS BAD ";
        $query .="FROM point WHERE student_id =:id";

        $this->query($query);
        $this->bind(":id", $id);
        return $this->list();
    }
    public function deleteById($id)
    {
        $query = "DELETE FROM ".$this->tableName." WHERE id=:id";
        $this->query($query);
        $this->bind(":id", (int)$id);
        return $this->execute();
    }
    public function createByArray($data_array)
    {
        return $this->insertHelper($this->tableName, $data_array);
    }
    public function createByObject($oject)
    {
        return $this->insertObjectHelper($oject);
    }
    public function update($data_array, $where_array, $whereType = 'AND')
    {
        return $this->updateHelper($this->tableName, $data_array, $where_array, $whereType);
    }
    public function updateByObject($object, $where_array, $whereType = 'AND')
    {
        return $this->updateObjectHelper($object, $where_array, $whereType);
    }

}