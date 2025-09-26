<?php

define('DASHBOARD_CREATED_BY_TEXT','Pivotdrive');

define('DASHBOARD_META_DESCRIPTION','Site Description');

define('DASHBOARD_META_AUTHOR','');





define('DASHBOARD_PER_PAGE_RECORDS',10);



define('EMAIL_FOOTER_LINK',env('APP_URL'));

define('EMAIL_FOOTER_LINK_LABEL','Click here to open '.env('APP_NAME'));

define('SITE_FOLDER_NAME','');

define('WWW_ROOT',$_SERVER['DOCUMENT_ROOT'].'/'.SITE_FOLDER_NAME.'/');





//FILES PATH

define('DEFAULT_FILE_PATH','public/files/');

define('USER_PROFILE_PIC_IMG_PATH','public/files/img/users/');

define('ADMIN_PROFILE_PIC_IMG_PATH','public/files/img/admin/');

define('VCF_FILE_PATH','files/vcf/user_event_participants/');

define('NON_MOBILE_NUMBER_VCF_FILE_PATH',VCF_FILE_PATH.'vcf_non_contact_number/');

define('MOBILE_NUMBER_VCF_FILE_PATH',VCF_FILE_PATH.'vcf_contact_number/');

define('CSV_FILE_PATH','files/csv/user_event_participants/');






//NOTIFICATION CONSTATCT START

define("FCM_ANDROID_NOTIFICATION_URL",'https://fcm.googleapis.com/fcm/send');

define("FCM_ANDROID_NOTIFICATION_SERVER_KEY","");



define("IPHONE_CERTIFICATE_TYPE","Development");

define("IPHONE_CERTIFICATE_PASSWORD","");

define("IOS_PUSH_DEVELOPMENT_PEM_PATH","public/files/ios_push_certificate/");

define("IOS_PUSH_PRODUCTION_PEM_PATH","public/files/ios_push_certificate/");

//NOTIFICATION CONSTATCT END


//SOCIAL MEDIA INSTAGRAM CONSTANT START


define("INSTAGRAM_OAUTH_AUTHORIZE_API_URL","https://api.instagram.com/oauth/authorize");

define("INSTAGRAM_OAUTH_ACCESS_TOKEN_API_URL","https://api.instagram.com/oauth/access_token");

define("INSTAGRAM_GRAPH_API_URL","https://graph.instagram.com/me");




//SOCIAL MEDIA INSTAGRAM CONSTANT END



define('SUPPORT_MOBILE','180110-21345345-211599');
define('SUPPORT_EMAIL','support@pobox51.com');


define('FRONTEND_EMAIL_IMAGE_FOLDER_PATH','assets/images/email/');

?>