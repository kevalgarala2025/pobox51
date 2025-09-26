<?php
define('PREFIX_USER','user');
define('ALIAS_USER','user.');
define('GUARD_USER','user');
define('NAMESPACE_USER',"App\Http\Controllers\User");
define('VIEW_FOLDER_USER','user');
define('NAMESPACE_USER_AUTH',"Auth");
define('ALIAS_USER_AUTH','auth.');
define('PREFIX_USER_AUTH','auth');
define('VIEW_FOLDER_USER_AUTH','.auth');


define('FRONTEND_CSS_FOLDER_PATH','assets/css/frontend/');
define('FRONTEND_JS_FOLDER_PATH','assets/js/frontend/');
define('FRONTEND_IMAGE_FOLDER_PATH','assets/images/frontend/');


//MSG CONSTANT
define('MSG_FOR_EVENT_SHARING_START', "Event Contact Start Sharing");
define('MSG_FOR_EVENT_NAME_NOT_EXISTS', "Event Name You Can Take It Not Exits In System");

define('MSG_FOR_EVENT_CANCEL_SUCCESSFULLY_BY_USER', "Event Successfully Cancelled.");

define('MSG_FOR_EVENT_COMPLETED_SUCCESSFULLY_BY_USER', "Event Successfully Completed.");

define('MSG_FOR_SOME_ERROR', "Something is wrong. Please try again.");
define('MSG_FOR_EVENT_ALREADY_REGIATER_WITH_SAME_NAME', "Event already registred in system with same name.");
define('MSG_FOR_SOME_PROCESS_RUNNING_WITH_EVENT', "Sorry you have currently one event data sharing and delete process running.");
define('MSG_FOR_EVENT_STATUS_UPDATE', "Event Status updated");
define('MSG_FOR_EVENT_NOT_FOUND', "Event not found.");
define('MSG_FOR_INVALID_EVENT_ID', "Please pass valid event id.");
define('MSG_FOR_NOT_PASS_USER_EVENT_ID', "Please pass user event id");
define('MSG_FOR_USER_EVENT_SHARE_TIME_UPDATE', "User event contact share time updated");
define('MSG_FOR_USER_EVENT_CONTACT_DELETE_SUCCESS', "User event contact deleted successfully");
define('MSG_FOR_USER_EVENT_DELETE_CONTECT_PROCESS_IN_RUNNING_STATE', "User event contact delete process in running state");

define('MSG_FOR_SUCCESSFULLY_ADD_TIME_IN_RUNNIG_EVENT', "Time added successfully in running event");
define('MSG_FOR_FILL_EMAIL_BEFORE_START_EVENT', "Please enter event name to start");

define('MSG_FOR_FILL_VALID_EMAIL_PREFIX_BEFORE_START_EVENT','Please enter valid event email prefix');

define('MSG_EVENT_NAME_SPACE_NOT_ALLOWED','Space is not allowed in event.');

define('MSG_FOR_EVENT_ALREADY_RUNNING_THEN_LIMIT_NOT_ALLOW','You are not allow to create event due to running event limit reached,Total running event allow #TOTAL_RUNNING_EVENT_AT_TIME#.');


//GEOLOCATION CONSTANT START
define('MSG_GEOLOCATION_NOT_SUPPORT_BY_BROWSER','Geolocation is not supported by this browser.');
define('MSG_GEOLOCATION_DENIED_BY_USER_TO_CREATE_EVENT','User denied the request for Geolocation, Allow location to move forward.');
//GEOLOCATION CONSTANT END


define('MSG_FOR_MOBILE_DEVICE_USER_EXPERIENCE', "For the best experience, please switch to Portrait mode.");


?>
