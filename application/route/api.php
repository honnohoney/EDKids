<?php
/**
 * Created by PhpStorm.
 * User: Bekaku
 * Date: 24/12/2015
 * Time: 3:21 PM
 */

use application\core\Route as Route;

/*
 * param => middleware, url,Controller name, action in controller, permission if require
 */
/*
|--------------------------------------------------------------------------
| IndexController
|--------------------------------------------------------------------------
*/
Route::get([], "index", "IndexController", "index");
/*
|--------------------------------------------------------------------------
| AppTableController
|--------------------------------------------------------------------------
*/
Route::get([], "generateStarter", "AppTableController", "crudAdd");
Route::get([], "generateStarter", "AppTableController", "crudAdd");
Route::post([], "generateStarter", "AppTableController", "crudAddProcess");
Route::post([], "generateStarterApi", "AppTableController", "addApi");
/*
|--------------------------------------------------------------------------
| PermissionController
|--------------------------------------------------------------------------
*/
Route::get(['AuthApi', 'PermissionGrant'], "permission", "PermissionController", "crudList", "permission_list");
Route::get(['AuthApi'], "findAllPermissionByPaging", "PermissionController", "findAllByPaging");

Route::post(['AuthApi', 'PermissionGrant'], "permission", "PermissionController", "crudAdd", "permission_add");
Route::get(['AuthApi', 'PermissionGrant'], "permissionReadSingle", "PermissionController", "crudReadSingle", "permission_view");
Route::put(['AuthApi', 'PermissionGrant'], "permission", "PermissionController", "crudEdit", "permission_edit");
Route::delete(['AuthApi', 'PermissionGrant'], "permission", "PermissionController", "crudDelete", "permission_delete");
Route::get([], "permissionsCrudtbl", "PermissionController", "permissionsCrudtbl");
/*
|--------------------------------------------------------------------------
| RoleController
|--------------------------------------------------------------------------
*/
Route::get(['AuthApi', 'PermissionGrant'], "role", "RoleController", "crudList", "role_list");
Route::post(['AuthApi', 'PermissionGrant'], "role", "RoleController", "crudAdd", "role_add");
Route::get(['AuthApi', 'PermissionGrant'], "roleReadSingle", "RoleController", "crudReadSingle", "role_view");
Route::put(['AuthApi', 'PermissionGrant'], "role", "RoleController", "crudEdit", "role_edit");
Route::delete(['AuthApi', 'PermissionGrant'], "role", "RoleController", "crudDelete", "role_delete");
/*
|--------------------------------------------------------------------------
| ApiClientController
|--------------------------------------------------------------------------
*/
Route::get(['AuthApi', 'PermissionGrant'], "apiClient", "ApiClientController", "crudList", "api_client_list");
Route::post(['AuthApi', 'PermissionGrant'], "apiClient", "ApiClientController", "crudAdd", "api_client_add");
Route::get(['AuthApi', 'PermissionGrant'], "apiClientReadSingle", "ApiClientController", "crudReadSingle", "api_client_view");
Route::put(['AuthApi', 'PermissionGrant'], "apiClient", "ApiClientController", "crudEdit", "api_client_edit");
Route::put(['AuthApi', 'PermissionGrant'], "apiClientRefreshToken", "ApiClientController", "refreshToken", "api_client_edit");
Route::delete(['AuthApi', 'PermissionGrant'], "apiClient", "ApiClientController", "crudDelete", "api_client_delete");
/*
|--------------------------------------------------------------------------
| ApiClientIpController
|--------------------------------------------------------------------------
*/
Route::get(['AuthApi', 'PermissionGrant'], "apiClientIp", "ApiClientIpController", "crudList", "api_client_ip_list");
Route::post(['AuthApi', 'PermissionGrant'], "apiClientIp", "ApiClientIpController", "crudAdd", "api_client_ip_add");
Route::get(['AuthApi', 'PermissionGrant'], "apiClientIpReadSingle", "ApiClientIpController", "crudReadSingle", "api_client_ip_view");
Route::put(['AuthApi', 'PermissionGrant'], "apiClientIp", "ApiClientIpController", "crudEdit", "api_client_ip_edit");
Route::delete(['AuthApi', 'PermissionGrant'], "apiClientIp", "ApiClientIpController", "crudDelete", "api_client_ip_delete");
/*
|--------------------------------------------------------------------------
| UserController
|--------------------------------------------------------------------------
*/
Route::get(['AuthApi'], "user", "UserController", "crudList");
Route::post(['AuthApi'], "user", "UserController", "crudAdd");
Route::get(['AuthApi'], "userReadSingle", "UserController", "crudReadSingle");
Route::put(['AuthApi'], "user", "UserController", "crudEdit", "user_edit");
Route::put(['AuthApi'], "resetUserPassword", "UserController", "resetPassword");
Route::delete(['AuthApi'], "user", "UserController", "crudDelete");
Route::post(['AuthApi'], "changeAvatar", "UserController", "changeAvatar");
/*
|--------------------------------------------------------------------------
| AuthController
|--------------------------------------------------------------------------
*/
Route::post([], "signin", "AuthController", "signin");
Route::post(['AuthApi'], "userLogout", "AuthController", "userLogout");
Route::get(['AuthApi'], "userCheckAuth", "AuthController", "userCheckAuth");
Route::post(['AuthApi'], "userChangePwd", "AuthController", "changePwd");
Route::post(['AuthApi'], "userCheckAuth", "AuthController", "userCheckAuth");


//Application

/*
|--------------------------------------------------------------------------
| UtilController
|--------------------------------------------------------------------------
*/
Route::get([], "jsonGetServerDateAndTime", "UtilController", "jsonGetServerDateAndTime");
Route::get([], "jsongetuniqetoken", "UtilController", "jsonGetUniqeToken");
Route::get([], "getSiteMetadata", "UtilController", "getSiteMetadata");

/* TestContronller*/
Route::get([], "test", "TestController", "index");
Route::get(['AuthApi'], "test-uri", "TestController", "index");
Route::post(['AuthApi'], "test", "TestController", "index");

Route::get([], "demo", "DemoController", "index"); //ไม่มีค่าใน [] คือ middle ware, array เปล่า
// เมื่อมี get demo เข้ามา ให้ไปที่ไฟล์ DemoController แล้วไปที่ function ที่ชื่อ index
Route::post([], "testUploadImage", "DemoController", "testUploadImage");
Route::post([], "UploadImageStudent", "StudentController", "studentUploadImage");
Route::post([], "UploadMultiImageStudent", "StudentController", "studentMultiUploadImage");

Route::get(['AuthApi'], 'student', 'StudentController', 'crudList', null);
Route::post(['AuthApi'], 'student', 'StudentController', 'crudAdd', null);
Route::get(['AuthApi'], 'studentReadSingle', 'StudentController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'student', 'StudentController', 'crudEdit', null);
Route::delete(['AuthApi'], 'student', 'StudentController', 'crudDelete', null);

Route::get(['AuthApi'], 'studentV2', 'StudentController', 'crudList', null);
Route::post(['AuthApi'], 'studentV2', 'StudentController', 'crudAdd', null);
Route::get(['AuthApi'], 'studentReadSingleV2', 'StudentController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'studentV2', 'StudentController', 'crudEdit', null);
Route::delete(['AuthApi'], 'studentV2', 'StudentController', 'crudDelete', null);

Route::get(['AuthApi'], 'major', 'MajorController', 'crudList', null);
Route::get(['AuthApi'], 'majorReadBy', 'studentController', 'crudMajor', null);
Route::post(['AuthApi'], 'major', 'MajorController', 'crudAdd', null);
Route::get(['AuthApi'], 'majorReadSingle', 'MajorController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'major', 'MajorController', 'crudEdit', null);
Route::delete(['AuthApi'], 'major', 'MajorController', 'crudDelete', null);

Route::get(['AuthApi'], 'teacher', 'TeacherController', 'crudList', null);
Route::post(['AuthApi'], 'teacher', 'TeacherController', 'crudAdd', null);
Route::get(['AuthApi'], 'teacherReadSingle', 'TeacherController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'teacher', 'TeacherController', 'crudEdit', null);
Route::delete(['AuthApi'], 'teacher', 'TeacherController', 'crudDelete', null);

Route::get(['AuthApi'], 'studentPj', 'StudentPjController', 'crudList', null);
Route::post(['AuthApi'], 'studentPj', 'StudentPjController', 'crudAddV2', null);
Route::get(['AuthApi'], 'studentPjReadSingle', 'StudentPjController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'studentPj', 'StudentPjController', 'crudEdit', null);
Route::delete(['AuthApi'], 'studentPj', 'StudentPjController', 'crudDelete', null);

Route::get(['AuthApi'], 'image', 'ImageController', 'crudList', null);
Route::post(['AuthApi'], 'image', 'ImageController', 'crudAdd', null);
Route::get(['AuthApi'], 'imageReadSingle', 'ImageController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'image', 'ImageController', 'crudEdit', null);
Route::delete(['AuthApi'], 'image', 'ImageController', 'crudDelete', null);

Route::get(['AuthApi'], 'studentimg', 'StudentimgController', 'crudList', null);
Route::post(['AuthApi'], 'studentimg', 'StudentimgController', 'crudAdd', null);
Route::get(['AuthApi'], 'studentimgReadSingle', 'StudentimgController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'studentimg', 'StudentimgController', 'crudEdit', null);
Route::delete(['AuthApi'], 'studentimg', 'StudentimgController', 'crudDelete', null);

Route::get(['AuthApi'], 'point', 'PointController', 'crudList', null);
Route::get(['AuthApi'], 'pointSearch', 'PointController', 'crudPoint', null);
Route::get(['AuthApi'], 'pointSum', 'PointController', 'crudPointSum', null);
Route::post(['AuthApi'], 'point', 'PointController', 'crudAdd', null);
Route::get(['AuthApi'], 'pointReadSingle', 'PointController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'point', 'PointController', 'crudEdit', null);
Route::delete(['AuthApi'], 'point', 'PointController', 'crudDelete', null);

Route::get(['AuthApi'], 'social', 'SocialController', 'crudList', null);
Route::get(['AuthApi'], 'socialSearch', 'SocialController', 'crudPost', null);
Route::post(['AuthApi'], 'social', 'SocialController', 'crudAdd', null);
Route::get(['AuthApi'], 'socialReadSingle', 'SocialController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'social', 'SocialController', 'crudEdit', null);
Route::delete(['AuthApi'], 'social', 'SocialController', 'crudDelete', null);

Route::get(['AuthApi'], 'hanahahaha', 'HanahahahaController', 'crudList', null);
Route::post(['AuthApi'], 'hanahahaha', 'HanahahahaController', 'crudAdd', null);
Route::get(['AuthApi'], 'hanahahahaReadSingle', 'HanahahahaController', 'crudReadSingle', null);
Route::put(['AuthApi'], 'hanahahaha', 'HanahahahaController', 'crudEdit', null);
Route::delete(['AuthApi'], 'hanahahaha', 'HanahahahaController', 'crudDelete', null);

Route::get(['AuthApi'], 'parents', 'ParentsController', 'crudList',null);
Route::get(['AuthApi'], 'parentsSearch', 'ParentsController', 'crudStdCode',null);
Route::post(['AuthApi'], 'parents', 'ParentsController', 'crudAdd',null);
Route::get(['AuthApi'], 'parentsReadSingle', 'ParentsController', 'crudReadSingle',null);
Route::put(['AuthApi'], 'parents', 'ParentsController', 'crudEdit',null);
Route::delete(['AuthApi'], 'parents', 'ParentsController', 'crudDelete',null);