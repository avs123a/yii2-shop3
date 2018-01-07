Yii2 based simple shop example

View demo:
backend:
http://shopdemo2.epizy.com/demoshop3/backend/web/index.php/accounts

email: admin@gmail.com
password: avs03021998

website:
http://shopdemo2.epizy.com/demoshop3/frontend/web/


installing:
 - clone github repository;
 - execute command : composer install;
 - go to cd C:\ ... repository and execute command : php init;
 - in file : common\config\main-params.php change database configuration;
 - execute command: yii migrate;
 - in common\config\bootstrap.php add frontendWebroot and backendWebroot aliases (similar to samdark ecommerce project);
    if you upload project on hosting:
       in backend\views\layouts\main.php   change link for website(frontend) : /main_folder/frontend/web
	   (for example:  http://shopdemo2.epizy.com/demoshop3/frontend/web/   link: 'Website' => '/demoshop3/frontend/web' )
 
 Requirements:
 php >= 5.6.0
 mysql >= 5.5
 
 Notes:
  In user (not guest ) mode cart may be not working!