<?php
return [
    'order-index' => '/orders',
    'order-detail' => '/orders/detail',
    'order-details-pdf' => '/orders/order-details-pdf',
    'order-updates' => '/orders/order-updates',
    //customer
    'lead-customer' => '/crm_customer',
    'lead-customer-create' => '/crm_customer/create',
    'lead-customer-store' => '/crm_customer/store',
    'lead-customer-edit' => '/crm_customer/edit',
    'lead-customer-update' => '/crm_customer/update',
    'lead-customer-changeStatus' => '/crm_customer/changeStatus',
    'customerDetails' => '/crm_customer/get-customer-details',



    'lead-quotation' => '/crm_quotation',
    'lead-quotation-create' => '/crm_quotation/create',
    'lead-quotation-store' => '/crm_quotation/store',
    'lead-quotation-edit' => '/crm_quotation/edit',
    'lead-quotation-update' => '/crm_quotation/update',
    'lead-quotation-changeStatus' => '/crm_quotation/changeStatus',
    'lead-quotation-searchSuggestion' => '/crm_quotation/SearchSuggestion',
    'lead-quotation-search-details' => '/crm_quotation/search-item-detail',
    'services-search-details' => '/crm_quotation/services-search-details',
    'lead-quotation-pdf' => '/crm_quotation/quotationdetailspdf',
    'invoice-search-services' => '/crm_quotation/invoice-search-services',
    //enquiry

    'enquiry' => '/enquiry',
    'enquiry-details' => '/enquiry/enquiry_details',
    'enquiry-store' => '/enquiry/store',
    'enquiry-edit' => '/enquiry/edit',
    'enquiry-update' => '/enquiry/update',
    'enquiry-changeStatus' => '/enquiry/changeStatus',

    //crm expanse
    'expenses' => '/expenses',
    'expenses-create' => '/expenses/create',
    'expanse-store' => '/expenses/store',
    'expense-edit' => '/expenses/edit',
    'expense-update' => '/expenses/update',
    'expense-destroy' => '/expenses/destroy',


    //cem expanse setting
    'expanse-setting' => '/settings',
    'expanse-setting-store' => '/settings/store',
    'sales-expense-edit'=> '/settings/edit',
    'sales-expense-update'=> '/settings/update',
    'sales-account-destroy'=> '/settings/account-destroy',
    'sales-expense-destroy'=> '/settings/destroy',
    'account-store' => '/settings/account-store',
    'sales-account-edit'=>'/settings/account-edit',
    'sales-account-update'=>'/settings/account-update',
    'cate-changeStatus' => '/settings/changeStatus',
    'account-changeStatus' => '/settings/changeAccStatus',


    'sales-setting-head-store' => '/settings/txn-head-store',
    'txn-head-create' => '/settings/txn-head-create',
    'sales-txt-head-edit' => '/settings/txt-head-edit',
    'txt-head-update' => '/settings/txt-head-update',
    'txt-head-destroy' => '/settings/txt-head-destroy',
    'txt-setting-head-changeStatus' => '/settings/txt-head-changeStatus',
    'txt-setting-head-sort-order' => '/settings/txt-changeSortOrder',
    'category-sort-order' => '/settings/category-sort-order',


    //sales invoice
    'invoice-index' => '/invoices',
    'invoice-create' => '/invoices/create',
    'invoice-store' => '/invoices/store', 
    'invoice-edit' => '/invoices/edit',
    'invoice-dublicate' => '/invoices/dublicate',
    'invoice-update' => '/invoices/update',
    'invoice-destroy' => '/invoices/destroy',
    'invoice-invoice-pdf' => '/invoices/invoicesdetailspdf',
    'Invoice-changeStatus' => '/invoices/changeStatus',
    'changeDate' => '/invoices/changeDate',
    'services-add' => '/invoices/service-add',
    'invoice-comp-download' => '/invoices/download-invoice',


    //sales income
     'income' => '/income',
     'incomes-create' => '/income/create',
     'incomes-store' => '/income/store',
     'incomes-edit' => '/income/edit',
     'incomes-update' => '/income/update',
     'incomes-destroy' => '/income/destroy',

    //Sales transaction
    'transaction' => '/transaction',
    'transaction-create' => '/transaction/create',
    'transaction-edit' => '/transaction/edit',
    'transaction-store' => '/transaction/store',
    'transaction-update' => '/transaction/update',
    'transaction-destroy' => '/transaction/destroy',
    'transaction-calendar' => '/transaction/calendar',
    'transaction-export' => '/transaction/export',



    //Sales Reports
    'reports' => '/reports',
    'download-reports' =>  '/reports/download',
    'download-annual-report' => '/reports/annual-report'
 
];