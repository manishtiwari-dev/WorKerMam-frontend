<?php
return [
  
    //recruit Jobs
  'recruit-index' => '/jobs',
  'recruit-create' => '/jobs/create',
  'recruit-store'=>'/jobs/store',
  'recruit-edit'=>'/jobs/edit',
  'recruit-update'=>'/jobs/update',
  'recruit-destroy'=>'/jobs/destroy',
  'recruit-data'=>'/jobs/data',
  'recruit-send-email'=>'/jobs/send-email',
  'recruit-filterJobApplications'=>'/jobs/filter-job-applications',
  'recruit-sendEmails' => '/jobs/sendEmails',
  'recruit-changeSortOrder' => '/jobs/changeSortOrder',

  
  


  //Recruit job location
  'location-index' => '/joblocation',
  'recruite-job-location-create' => '/joblocation/create',
  'recruite-job-location-store'=>'/joblocation/store',
  'recruite-job-location-edit'=>'/joblocation/edit',
  'recruite-job-location-update'=>'/joblocation/update',
  'recruite-job-location-destroy'=>'/joblocation/destroy',


  //Recruite skills
  'recruit-skills' => '/skills',
  'recruite-skills-create' => '/skills/create',
  'recruite-skills-store'=>'/skills/store',
  'recruite-skills-edit'=>'/skills/edit',
  'recruite-skills-update'=>'/skills/update',
  'recruite-skills-destroy'=>'/skills/destroy',
 

  //rcruit job category
  'recruit-job-category' => '/job-categories',
  'recruite-job-category-create' => '/job-categories/create',
  'recruite-job-category-store'=>'/job-categories/store',
  'recruite-job-category-edit'=>'/job-categories/edit',
  'recruite-job-category-update'=>'/job-categories/update',
  'recruite-job-category-destroy'=>'/job-categories/destroy',
  'recruite-job-category-getSkills'=>'/job-categories/getSkills',



  //rcruit job onboard
  'recruit-job-onboard' => '/job-onboard',
  'recruite-job-onboard-create' => '/job-onboard/create',
  'recruite-job-onboard-store'=>'/job-onboard/store',
  'recruite-job-onboard-show'=>'/job-onboard/show',
  'recruite-job-onboard-edit'=>'/job-onboard/edit',
  'recruite-job-onboard-update'=>'/job-onboard/update',
  'recruite-job-onboard-destroy'=>'/job-onboard/destroy',
  'recruite-job-onboard-data'=>'/job-onboard/data',
  'recruite-job-onboard-send-offer'=>'/job-onboard/send-offer',
  'recruite-job-onboard-update-status' => '/job-onboard/update-status',


  //recruit job type
  'job-type-create' => '/job-type/create',
  'job-type-store' => '/job-type/store',
  'job-type-update' => '/job-type/update',
  'job-type-destroy' => '/job-type/destroy',

   //recruit work-experience
  'work-experience-create' => '/work-experience/create',
  'work-experience-store' => '/work-experience/store',
  'work-experience-update' => '/work-experience/update',
  'work-experience-destroy' => '/work-experience/destroy',


  //recruit question
  'questions-index' => '/questions',
  'questions-create' => '/questions/create',
  'questions-edit'=>'/questions/edit',
  'questions-store' => '/questions/store',
  'questions-update' => '/questions/update',
  'questions-destroy' => '/questions/destroy',


    //recruit job interview shdules
  'interview-schedule-index' => '/interview-schedule',
  'interview-schedule-create' => '/interview-schedule/create',
  'interview-schedule-edit'=>'/interview-schedule/edit',
  'interview-schedule-store' => '/interview-schedule/store',
  'interview-schedule-update' => '/interview-schedule/update',
  'interview-schedule-destroy' => '/interview-schedule/destroy', 
  'interview-schedule-table' => '/interview-schedule/table',
  'interview-schedule-show' => '/interview-schedule/show',
  'interview-schedule-data' => '/interview-schedule/data',
  'interview-changeStatus' => '/interview-schedule/changeStatus',
  'interview-changeStatusMultiple' => '/interview-schedule/changeStatusMultiple',
  'interview-notify' => '/interview-schedule/notify',


  //recruite job application
   'job-application-index' => '/job-application',
   'job-application-create' => '/job-application/create',
   'job-application-edit'=>'/job-application/edit',
   'job-application-store' => '/job-application/store',
   'job-application-update' => '/job-application/update',
   'job-application-destroy' => '/job-application/destroy',
   'job-application-table' => '/job-application/table',
   'job-application-data' => '/job-application/data',
   'job-application-export' => '/job-application/export',
   'job-application-show' => '/job-application/show',
   'job-application-updateIndex' => '/job-application/updateIndex',
   'job-application-archive-job-application' => '/job-application/archive-job-application',
   'job-application-createSchedule' => '/job-application/createSchedule',
   'job-application-jobQuestion' => '/job-application/jobQuestion',
   'job-application-unarchiveJob' => '/job-application/unarchiveJob',
   'job-application-addskill' => '/job-application/addskill',
   'job-application-ratingSave' => '/job-application/ratingSave',
   'schedule-store' => '/job-application/scheduleStore',
   'job-application-import-store' => '/job-application/import-store',
   'job-application-import' => '/job-application/import',
   'job-application-load_more' => '/job-application/load-more',

   //recruit job candidate database
   'candidate-database-index' => '/candidate-database',
   'candidate-database-create' => '/candidate-database/create',
   'candidate-database-edit'=>'/candidate-database/edit',
   'candidate-database-store' => '/candidate-database/store',
   'candidate-database-update' => '/candidate-database/update',
   'candidate-database-show' => '/candidate-database/show',
   'candidate-database-destroy' => '/candidate-database/destroy',
   'candidate-database-data' => '/candidate-database/data',
   'candidate-database-export' => '/candidate-database/export',
   'candidate-database-delete-record'=>'/candidate-database/delete-record',

   //recruit documents
   'documents-index' => '/documents',
  'documents-create' => '/documents/create',
  'documents-edit'=>'/documents/edit',
  'documents-store' => '/documents/store',
  'documents-update' => '/documents/update',
  'documents-destroy' => '/documents/destroy',
  'documents-data' => '/documents/data',
  'documents-downloadDoc' => '/documents/downloadDoc',
   

  //recruit documents
  'application-setting-index' => '/application-setting',
  'application-setting-create' => '/application-setting/create',
  'application-setting-edit'=>'/application-setting/edit',
  'application-setting-store' => '/application-setting/store',
  'application-setting-update' => '/application-setting/update',
  'application-setting-destroy' => '/application-setting/destroy',


  //application status
  'application-status' => '/application-status',
  'application-status-create' => '/application-status/create',
  'application-status-edit'=>'/application-status/edit',
  'application-status-store' => '/application-status/store',
  'application-status-update' => '/application-status/update',
  'application-status-destroy' => '/application-status/destroy',

  
   //recruit setting
   'setting-index' => '/setting', 
   'setting-update' => '/setting/update', 


   //recruit frontjob application
   'front-job-jobDetail' => '/front-job/jobDetail',

   //recruit reports
   'reports-index' => '/reports',

   //recruite-note
   'recruite-note-store' => '/application-note/store',
   'recruite-note-update' => '/application-note/update',
   'recruite-note-destroy' => '/application-note/destroy',

   //recruit job onboard question
   'onboard-offer-index' => '/offer-question/index',
   'onboard-offer-create' => '/offer-question/create',
   'onboard-offer-update' => '/offer-question/update',
   'onboard-offer-store' => '/offer-question/store',
   'onboard-offer-edit' => '/offer-question/edit',
   'onboard-offer-data' => '/offer-question/data',
   'onboard-offer-destroy' => '/offer-question/destroy',
 ];