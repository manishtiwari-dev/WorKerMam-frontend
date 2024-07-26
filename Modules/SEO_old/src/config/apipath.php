<?php
return [
    'seo-setting' => '/seoSetting',

    //website api
    'seo-setting-website-create' => '/seoSetting/website_create',
    'seo-setting-website-store' => '/seoSetting/website_store',
    'seo-setting-website-edit' => '/seoSetting/website_edit',
    'seo-setting-website-update' => '/seoSetting/website_update',
    'seo-setting-website-destroy' => '/seoSetting/website_destroy',
    'seo-setting-website-changeStatus' => '/seoSetting/changeWebsiteStatus',
    'seo-setting-manage-task-list' => '/seoSetting/task_manage',
    'seo-setting-manage-task-update' => '/seoSetting/manage_task_update',
    'seo-setting-manage-task-status' => '/seoSetting/changeTaskManageStatus',
    'seo-setting-manage-task-priority' => '/seoSetting/task_priority',
    'seo-setting-manage-task-submission' => '/seoSetting/task_submission',
    'seo-setting-keyword' => '/seoSetting/keyword_manage',
    'seo-keywords-update' => '/seoSetting/keyword_update',
    'seo-keywords-ranking' => '/seoSetting/web_ranking',
    'seo-keywords-ranking-update' => '/seoSetting/web_ranking_update',
    'seo-setting-task-changeduplicate' => '/seoSetting/changeTaskDuplicate',
    //end website api

    //task setting api
    'seo-setting-task-create' => '/seoSetting/seo_task_create',
    'seo-setting-task-store' => '/seoSetting/seo_task_store',
    'seo-setting-task-edit' => '/seoSetting/seo_task_edit',
    'seo-setting-task-update' => '/seoSetting/seo_task_update',
    'seo-setting-task-destroy' => '/seoSetting/seo_task_destroy',
    'seo-setting-task-changeStatus' => '/seoSetting/changeTaskStatus',
    //end task setting api

    //result title api
    'seo-setting-result-create' => '/seoSetting/seo_result_create',
    'seo-setting-result-store' => '/seoSetting/seo_result_store',
    'seo-setting-result-edit' => '/seoSetting/seo_result_edit',
    'seo-setting-result-update' => '/seoSetting/seo_result_update',
    'seo-setting-result-destroy' => '/seoSetting/seo_result_destroy',
    'seo-setting-result-changeStatus' => '/seoSetting/changeResultStatus',
    'seo-setting-result-changeSortOrder' => '/seoSetting/result_sortOrder',
    //end result title api

    //seo submission api
    'seo-submission' => '/seoSubmission',
    'seo-submission-create' => '/seoSubmission/create',
    'seo-submission-store' => '/seoSubmission/store',
    'seo-submission-update' => '/seoSubmission/update',
    'seo-submission-edit' => '/seoSubmission/edit',
    'seo-submission-destroy' => '/seoSubmission/destroy',
    'seo-submission-changeStatus' => '/seoSubmission/ChangeSubmissionStatus',
    'seo-submission-url' => '/seoSubmission/getSubmissionUrl',
    //end 

    //seo daily work api
    'seo-dailyWork' => '/seoDailyWork',
    'seo-dailyWork-update' => '/seoDailyWork/work_report_update',
    'seo-dailyWork-edit' => '/seoDailyWork/edit',
    'seo-dailyWork-changeStatus' => '/seoDailyWork/dailyWorkStatus',
    'seo-dailyWork-duplicate-checker' => '/seoDailyWork/duplicate_checker',
    'seo-dailyWork-duplicate-checker-update' => '/seoDailyWork/duplicateCheckerUpdate',
    'seo-dailyWork-landingUrl-check' => '/seoDailyWork/landing_url_check',

    
    // Seo Website Redirector Api

    'web-redirector' => '/seo-web-redirector',
    'web-redirector-update' => '/seo-web-redirector/update',
    'web-redirector-edit' => '/seo-web-redirector/edit',
    'web-redirector-changeStatus' => '/seo-web-redirector/change-status',
    'web-redirector-store' => '/seo-web-redirector/store',
    'web-redirector-delete' => '/seo-web-redirector/delete',


    //workReport api
    'seo-workReport' => '/seoWorkReport',
    'seo-workReportUrl' => '/seoWorkReport/work_report',
    'seo-workReport-import-add' => '/seoWorkReport/importAdd',
    'seo-workReport-import-store' => '/seoWorkReport/importStore',
    'seo-workReport-export' => '/seoWorkReport/exportData',
    'postingupdate' => '/seoDailyWork/postingupdate',
    'work-posting-store' => '/seoDailyWork/work-posting-store',


    //monthly result api
    'seo-monthlyResult' => '/seoMonthlyResult',
    'seo-monthlyResult-show' => '/seoMonthlyResult/getMonthlyResult',
    'seo-monthlyResult-store' => '/seoMonthlyResult/store',

    'seo-exportMonthlyResult' => '/seoMonthlyResult/export-monthly-result',
];
