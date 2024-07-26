

 <x-app-layout>
    @section('title', $pageTitle)
    
        
    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true') 
        <div class="contact-content">
            <div class="contact-content-header mg-b-20 mg-lg-b-25 mg-xl-b-30">
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item" id="atxnHeadTab">
                        <a href="#txnHead" class="nav-link {{ request()->tab == 'txn-head' || !isset(request()->tab) ? 'active' : '' }} " data-toggle="tab" >{{ __('sales.transaction_head') }}</a>
                        
                    </li>


                    <li class="nav-item" id="TxnTab">
                        <a href="#expanse-catgeory"
                            class="nav-link {{ request()->tab == 'category' ? 'active' : '' }}"
                            data-toggle="tab">{{ __('sales.txn_category') }}</a>
                    </li>

                    <li class="nav-item" id="accountTab">
                        <a href="#account"
                            class="nav-link {{ request()->tab == 'account' ? 'active' : '' }}" data-toggle="tab"
                            >{{ __('sales.account') }}</a>
                    </li>                  

                </ul>

            </div>
            <div class="card contact-content-body">
                <div class="tab-content">

                    <div id="txnHead" class="tab-pane {{ request()->tab == 'txn-head' || !isset(request()->tab) ? 'active' : '' }} ">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Transaction Head</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')

                                <a href="#" data-bs-toggle="modal" data-bs-target="#addTxnHead" id="add_title_btn" class="btn btn-primary">
                                    <i data-feather="plus"></i><span
                                    class="d-none d-sm-inline mg-l-5">Add Head</span>
                                </a>
                                 
                            @endif
                            </div>
                        </div>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table_wrapper">
                                        <thead>
                                            <tr> 
                                                <th>{{ __('sales.title') }}</th> 
                                                <th>{{ __('sales.sub_title') }}</th> 
                                                <th>{{ __('sales.head_type') }}</th>
                                                <th>{{ __('common.status') }}</th>   
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content->AccTxnHad as $key => $AccTxn)
                                            <tr>
                                                <td><input type="number" class="col-xs-1 resultTitle width1 text-center me-2"
                                                    data-id="{{ $AccTxn->id }}" placeholder=""
                                                    value="{{ $AccTxn->sort_order }}" style="width:50px;"> {{ ucwords($AccTxn->head_title) }} <i class="fa fa-arrow-circle-down" aria-hidden="true"></i></td>
                                                <td></td>
                                                <td>
                                                    <span class="badge  {{($AccTxn->dr_cr == 'dr')?'text-bg-danger':'text-bg-primary'}}">{{$AccTxn->dr_cr}}</span>
                                                </td>
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox"
                                                            class="custom-control-input result_toggle_class"
                                                            {{ $AccTxn->status == '1' ? 'checked' : '' }}
                                                            data-id="{{ $AccTxn->id }}"
                                                            id="customSwitch2{{ $AccTxn->id }}">
                                                        <label class="custom-control-label"
                                                            for="customSwitch2{{ $AccTxn->id }}"></label>
                                                    </div>
                                                </td>
                                                
                                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                    <td class="d-flex align-items-center justify-content-center gap-2">
 

                                                        
                                                        <a href="#" data-id="{{ $AccTxn->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#modalEditTxnHead"
                                                            class="btn btn-sm d-flex  align-items-center px-0  head_edit_btn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                            <span class="d-none d-sm-inline mg-l-5"></span>
                                                        </a>



                                                        <a href="#delete_result_modal"
                                                            data-id="{{ $AccTxn->id }}" id="result_delete_btn"
                                                            data-toggle="modal"
                                                            class="btn btn-sm d-flex  align-items-center px-0">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span class="d-none d-sm-inline mg-l-5"></span>
                                                        </a>
                                                    </td>
                                                @endif
                                            </tr>
                                            @foreach ($AccTxn->child as $key => $child)
                                                {{-- @dd($child); --}}
                                                <tr>
                                                    <td></td>
                                                    <td><input type="number" class="col-xs-1 resultTitle width1 text-center me-2"
                                                        data-id="{{ $child->id }}" placeholder=""
                                                        value="{{ $child->sort_order }}" style="width:50px;">{{ ucwords($child->head_title) }}</td>
                                                    <td>
                                                        <span class="badge  {{($child->dr_cr == 'dr')?'text-bg-danger':'text-bg-primary'}}">{{$child->dr_cr}}</span>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input result_toggle_class"
                                                                {{ $child->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $child->id }}"
                                                                id="customSwitch2{{ $child->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitch2{{ $child->id }}"></label>
                                                        </div>
                                                    </td>
                                                    
                                                    {{-- <td>
                                                        
                                                    </td> --}}
                                                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') === 'true')
                                                        <td class="d-flex align-items-center justify-content-center gap-2">
                                                            <a href="#" data-bs-target="#modalEditTxnHead"
                                                                data-id="{{ $child->id }}" data-bs-toggle="modal"
                                                                class="btn btn-sm d-flex  align-items-center px-0 head_edit_btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                <span class="d-none d-sm-inline mg-l-5"></span>
                                                            </a>
                                                            <a href="#delete_result_modal"
                                                                data-id="{{ $child->id }}" id="child_delete"
                                                                data-toggle="modal"
                                                                class="btn btn-sm d-flex  align-items-center px-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                                <span class="d-none d-sm-inline mg-l-5"></span></a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td colspan="5">
                                                    <h5 class="text-center mb-0 py-1">No Record Found !</h4>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div id="expanse-catgeory"
                        class="tab-pane {{ request()->tab == 'category' ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">{{ __('sales.txns_category') }}</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')
                                <a href="#" data-bs-target="#expanse_category_add"  data-bs-toggle="modal"
                                    class="btn btn-primary"><i data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">Add Category </span>
                                </a>

                                 
                                        
                                @endif
                            </div>
                        </div>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table_wrapper">
                                        <thead>
                                            <tr>
                                                <th>{{ __('common.sl_no') }}</th>
                                                <th>{{ __('sales.categName') }}</th>
                                                <th>{{ __('sales.description') }}</th>
                                                <th>{{ __('sales.category_type') }}</th> 
                                                <th>{{ __('sales.sort_order') }}</th>
                                                <th>{{ __('common.status') }}</th>
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content->crmexpansecategory as $key => $category)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->description }}</td>
                                                    
                                                    <td> 
                                                        <span class="badge  {{($category->dr_cr == 'dr')?'text-bg-danger':'text-bg-primary'}}">{{$category->dr_cr}}</span>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="col-xs-1 categorySortOrder width1 text-center gap-2"
                                                        data-id="{{ $category->id }}" placeholder=""
                                                        value="{{ $category->sort_order }}" style="width:50px;">
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input category_toggle_class"
                                                                {{ $category->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $category->id }}"
                                                                id="customSwitches{{ $category->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitches{{ $category->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="d-flex align-items-center justify-content-between">
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                                                        <a href="#" data-id="{{ $category->id }}"
                                                            data-bs-target="#modalEditexpense"  data-bs-toggle="modal"
                                                            class="btn btn-sm d-flex  align-items-center mg-r-5 result_edit_btn"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                                @endif

                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="account" class="tab-pane {{ request()->tab == 'account' ? 'active' : '' }}">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h6 class="tx-15 mg-b-0">Bank Account</h6>
                                @if (\App\Helper\Helper::CheckPermission($pageAccess, 'add') == 'true')

                                <a href="#"   data-bs-target="#expanse_account_add"  data-bs-toggle="modal"
                                    class="btn btn-primary"><i data-feather="plus"></i><span
                                        class="d-none d-sm-inline mg-l-5">Add Account</span></a>
                                        @endif
                            </div>
                        </div>
                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'view') == 'true')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table  table_wrapper">
                                        <thead>
                                            <tr>
                                                <th>{{ __('common.sl_no') }}</th>
                                                <th>{{ __('sales.openingDate') }}</th>
                                                <th>{{ __('sales.accountTitle') }}</th>
                                                <th>{{ __('sales.type') }}</th>
                                                <th>{{ __('sales.accountNumber') }}</th>
                                                <th>{{ __('sales.currencies') }}</th>
                                                <th>{{ __('sales.opening_balence') }}</th>
                                                <th>{{ __('sales.closing_balence') }}</th>

                                                <th>{{ __('common.status') }}</th>
                                                <th class="text-center wd-10p">{{ __('common.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($content->appAccounts as $key => $appAccount)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $appAccount->opening_date }}</td>
                                                    <td>{{ $appAccount->account_title }}</td>
                                                    <td> {{($appAccount->account_type == 1)?'Bank Account':'Credit Card'}} </td>
                                                    <td>{{ $appAccount->account_number }}</td>
                                                    <td>{{ $appAccount->account_currency }}</td>
                                                    <td class="text-center">{{ $appAccount->opening_balance }}</td>
                                                    <td class="text-center">{{ $appAccount->closing_balance }}</td>

                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input account_toggle_class"
                                                                {{ $appAccount->status == '1' ? 'checked' : '' }}
                                                                data-id="{{ $appAccount->id }}"
                                                                id="customSwitches1{{ $appAccount->id }}">
                                                            <label class="custom-control-label"
                                                                for="customSwitches1{{ $appAccount->id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="d-flex align-items-center justify-content-center">
                                                        @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true') 
                                                        <a href="#" data-bs-target="#modalEditAccount"  data-bs-toggle="modal" data-id="{{ $appAccount->id }}" 
                                                            class="btn btn-sm d-flex  align-items-center mg-r-5 expense_edit_btn"><i
                                                                data-feather="edit-2"></i><span
                                                                class="d-none d-sm-inline mg-l-5"></span></a>
                                                                @endif

                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">
                                                        <h5 class="text-center mb-0 py-1">No Record Found !.</h5>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>

                   
                </div>
            </div>
        </div>
    @endif



     <!-------------- Edit expense Modal --------------->
        <div class="modal fade" id="modalEditexpense" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('sales.update_txn_category') }}</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation novalidate" id="edit_expense_title_form" novalidate>
                            <input type="hidden" name="input_field_id" id="edit_input_field">
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('sales.categName') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="expense_name" id="editexpense_name" type="text"
                                        class="form-control" placeholder="{{ __('sales.cate_name_placeholder') }}"
                                        required>
                                    <div class="invalid-feedback">
                                        {{ __('sales.category_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('sales.cateDesc') }}<span
                                            class="text-danger"></span></label>
                                    <input name="expense_category" id="editexpense_description" type="text"
                                        class="form-control" placeholder="{{ __('sales.category_desc_placeholder') }}"
                                        >
                                        
                                </div>
                                <div class="col-sm-12">
                                    <label class="form-label">{{ __('sales.category_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-control" id="update_category_type" name="category_type" required>
                                            <option selected disabled value="">{{ __('sales.select_category_type') }}
                                            </option>
                                            <option value="cr">Credit</option>
                                            <option value="dr">Debit</option>
                                        </select> 
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.category_type_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mt-4" required>
                                    <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
     <!--------------Edit expense Modal end here --------------->



     <!-------------- Edit expense Account Modal --------------->
        <div class="modal fade" id="modalEditAccount" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modalselect2"  role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Update Account</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation novalidate" id="edit_expense_account" novalidate>
                            <input type="hidden" name="input_field_id" id="edit_account_field">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.account_title') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="account_title"
                                        placeholder="{{ __('sales.account_title_placeholder') }}" class="form-control"
                                        id="edit_account_title" required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.account_title_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.account_number') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_number" id="edit_account_number"
                                        class="form-control" placeholder="{{ __('sales.account_number_placeholder') }}"
                                        required />
                                    <div class="invalid-feedback">
                                        {{ __('sales.account_number_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.type') }}<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" name="type" id="edit_type" required>
                                        <option selected value="" disabled>{{__('sales.select_type')}}</option>
                                        <option value="1">Bank Account</option>
                                        <option value="2">Credit Card</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.type_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.account_currency') }}<span
                                            class="text-danger">*</span></label>
                                    <select name="account_currency" id="edit_account_currency"
                                        class="form-control select2" required>
                                        <option value="" selected disabled>{{ __('sales.select') }}</option>
                                        @if (!empty($content->currency))
                                            @foreach ($content->currency as $ls_data)
                                                <option value="{{ $ls_data->currencies_code }}">
                                                    {{ $ls_data->currencies_code }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('sales.account_currency_error') }}
                                    </div>
                                </div>


                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.opening_date') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="opening_date" id="edit_opening_date" type="date"
                                        class="form-control" placeholder="{{ __('sales.opening_date_placeholder') }}"
                                        >

                                </div>
                                

                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.opening_balence') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.0001" name="opening_balence"
                                        id="edit_opening_balence"
                                        placeholder="{{ __('sales.opening_balence_placeholder') }}" class="form-control"
                                         />
                                   
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.closing_balence') }}<span
                                            class="text-danger"></span></label>
                                    <input type="number" step="0.0001" name="closing_balence"
                                        id="edit_closing_balence"
                                        placeholder="{{ __('sales.closing_balence_placeholder') }}"
                                        class="form-control" />

                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="form-label">{{ __('sales.note') }}</label>
                                    <textarea name="note" id="edit_note" class="form-control" placeholder="{{ __('sales.note_placeholder') }}"></textarea>
                                    <div class="invalid-feedback">
                                        {{ __('sales.note_error') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mt-4" required>
                                    <input type="submit" id="update_expense_Account" class="btn btn-primary"
                                        value="Update">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
     <!--------------Edit expense Account Modal end here --------------->

   <!-------------- Edit transaction head Modal --------------->
        <div class="modal fade" id="modalEditTxnHead" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Update Head Title</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation novalidate" id="edit_result_title_form" novalidate>
                            <input type="hidden" name="input_field_id" id="edit_input_head">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">{{ __('seo.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="title" id="update_head_title" type="text" class="form-control"
                                            placeholder="Enter title" required>
                                        <span style="color:red;">
                                            @error('title')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.title_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">{{ __('sales.head_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-control" id="update_head_type" name="head_type" required>
                                            <option selected disabled value="">{{ __('sales.select_head_type') }}
                                            </option>
                                            <option value="cr">Credit</option>
                                            <option value="dr">Debit</option>
                                        </select> 
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.head_type_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-4">

                                    <label for="section_type"
                                        class="form-label">{{ __('sales.section_type') }}</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  section_type is-invalid type parentselectVal" type="radio"
                                            name="section_type" id="update_head_section_type" value="0">
                                        <label class="form-check-label"
                                            for="inlineRadio1">{{ __('seo.parent') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input  section_type1 is-invalid type " type="radio"
                                            name="section_type" id="update_head_section_type1" value="1">
                                        <label class="form-check-label" for="inlineRadio2">{{ __('seo.child') }}</label>
                                    </div>
                                    <div class=" parent mt-3" style="display:none;">
                                        <label for="parent_section"
                                            class="form-label">{{ __('seo.parent_title') }}</label>
                                        <select class="form-control " id="update_head_parent" name="parent_section">
                                            <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.parent_title_error') }}</p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <label for="parent_section" class="form-label">{{ __('seo.status') }}</label>
                                        <select class="form-control " id="status_head" name="status">
                                            <option selected disabled value="">{{ __('seo.select_status') }}
                                            </option>
                                            <option value="1">Active
                                            </option>
                                            <option value="0">Deactive
                                            </option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-4" required>
                                    <input type="submit" id="add_title_submit" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    <!--------------Edit transaction head Modal end here --------------->

    <!--result delete modal-->
        <div class="modal fade effect-scale" id="delete_result_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Delete Txt Head</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="head_hidden_id" name="input_field_id">
                        <p class="mg-b-0">{{ __('common.delete_confirmation') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ __('common.no') }}
                        </button>
                        <button type="button" class="btn btn-primary delete_btn">{{ __('common.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
    <!--End delete modal-->



     <!--start add modal-->
        <div class="modal fade" id="expanse_category_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('sales.add_txn_category') }}</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="expense_add_userForm" class="needs-validation mg-b-0" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('sales.categName') }}<span
                                            class="text-danger">*</span></label>
                                    <input name="expense_name" id="expense_name" type="text" class="form-control"
                                        placeholder="{{ __('sales.cate_name_placeholder') }}" required>

                                    <div class="invalid-feedback">
                                        {{ __('sales.category_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('sales.cateDesc') }}<span
                                            class="text-danger"></span></label>
                                    <input name="expense_category" id="expense_category" type="text" class="form-control"
                                        placeholder="{{ __('sales.category_desc_placeholder') }}">
                                    <div class="invalid-feedback">
                                        {{ __('sales.categ_desc_error') }}
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="form-label">{{ __('sales.category_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-control" id="category_type" name="category_type" required>
                                            <option selected disabled value="">{{ __('sales.select_head_type') }}
                                            </option>
                                            <option value="cr">Credit</option>
                                            <option value="dr">Debit</option>
                                        </select> 
                                        <div class="invalid-feedback">
                                            <p>{{ __('sales.category_type_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" id="Add_expense_Submit" name="send" class="btn btn-primary"
                                value="{{ __('common.submit') }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <!--end add modal-->

    <!--start add modal-->
        <div class="modal fade" id="expanse_account_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modalselect2" role="document">
            <div class="modal-content tx-14">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ __('sales.add_account') }}</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="account_add_userForm" class="needs-validation mg-b-0" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.account_title') }}<span
                                        class="text-danger">*</span></label>
                                <input name="account_title" placeholder="{{ __('sales.account_title_placeholder') }}"
                                    class="form-control" id="account_title" required />
                                <div class="invalid-feedback">
                                    {{ __('sales.account_title_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.account_number') }}<span
                                        class="text-danger">*</span></label>
                                <input type="text" name="account_number" id="account_number" class="form-control"
                                    placeholder="{{ __('sales.account_number_placeholder') }}" required />
                                <div class="invalid-feedback">
                                    {{ __('sales.account_number_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.type') }}<span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="type" required>
                                    <option selected value="" disabled>{{__('sales.select_type')}}</option>
                                    <option value="1">Bank Account</option>
                                    <option value="2">Credit Card</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('sales.type_error') }}
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.account_currency') }}<span
                                        class="text-danger">*</span></label>
                                <select name="account_currency" id="account_currency" class="form-control select2"
                                    required>
                                    <option value="" selected disabled>{{ __('sales.select') }}</option>
                                    @if (!empty($content->currency))
                                        @foreach ($content->currency as $ls_data)
                                            <option value="{{ $ls_data->currencies_code }}">
                                                {{ $ls_data->currencies_code }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    {{ __('sales.account_currency_error') }}
                                </div>
                            </div> 
                            
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.opening_date') }}<span
                                        class="text-danger">*</span></label>
                                <input name="opening_date" id="opening_date" type="date" class="form-control"
                                    placeholder="{{ __('sales.opening_date_placeholder') }}">

                            </div>
                            
 
                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.opening_balence') }}<span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.0001" name="opening_balence" id="opening_balence"
                                    placeholder="{{ __('sales.opening_balence_placeholder') }}" class="form-control"
                                     />
                               
                            </div>

                            <div class="form-group col-lg-6">
                                <label class="form-label">{{ __('sales.note') }}</label>
                                <textarea name="note" id="note" class="form-control" placeholder="{{ __('sales.note_placeholder') }}"></textarea>
                                <div class="invalid-feedback">
                                    {{ __('sales.note_error') }}
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="Add_account" name="send" class="btn btn-primary"
                            value="{{ __('common.submit') }}">
                    </form>
                </div>
            </div>
        </div>
        </div>
    <!--end add modal-->


    <!--start transaction head add modal-->
        <div class="modal fade" id="addTxnHead" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">{{ __('sales.add_head_title') }}</h6>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" id="add_head_title_form" novalidate>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">{{ __('seo.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="title_name" id="title" type="text" class="form-control"
                                            placeholder="Enter title" required>
                                        <span id="title_msg"></span>
                                        <div class="invalid-feedback">
                                            <p>{{ __('seo.title_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label">{{ __('sales.head_type') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-control" id="head_type" name="head_type" required>
                                            <option selected disabled value="">{{ __('sales.select_head_type') }}
                                            </option>
                                            <option value="cr">Credit</option>
                                            <option value="dr">Debit</option>
                                        </select> 
                                        <div class="invalid-feedback">
                                            <p>{{ __('sales.head_type_error') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-4">

                                    <label for="section_type" class="form-label">{{ __('sales.section_type') }}</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input section_type is-invalid" type="radio"
                                            name="section_type" id="section_type" value="0" checked>
                                        <label class="form-check-label" for="inlineRadio1">{{ __('seo.parent') }}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input section_type1 is-invalid" type="radio"
                                            name="section_type" id="section_type1" value="1">
                                        <label class="form-check-label" for="inlineRadio2">{{ __('seo.child') }}</label>
                                    </div>
                                    <div class=" parent mt-3" style="display:none;">
                                        <label for="parent_section"
                                            class="form-label">{{ __('seo.parent_title') }}</label>
                                        <select class="form-control" id="parent_section" name="parent_section">
                                            <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mt-4" required>
                                    <input type="submit" id="add_title_submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    <!--End transaction head add modal-->




     @push('scripts')

         <link rel="stylesheet" href="{{ asset('asset/css/bootstrap-colorpicker.min.css') }}">
         <script src="{{ asset('asset/js/bootstrap-colorpicker.min.js') }}"></script>
         <script>
            $(document).ready(function() {
                $(".section_type").click(function() {
                    $(".parent").hide();
                });
                $(".section_type1").click(function() {
                    $(".parent").show();

                });

                $("#section_type1").click(function() {
                    $("#parent_section").attr("required", true);

                });

                $("#section_type").click(function() {
                    $("#parent_section").attr("required", false);
                });
            });
        </script>
        <script>
            
            // $.fn.modal.Constructor.prototype._enforceFocus = function() {};
            // $('.select2').select2({ dropdownParent: $(".modal-body") });
            $('.select2').each(function() { 
                $(this).select2({ dropdownParent: $(this).parent()});
            })

            
            $(document).ready(function() {
                // add expense ajax open
                $(document).on('click', "#Add_expense_Submit", function(e) {
                    e.preventDefault();
                    $('#expense_add_userForm').addClass('was-validated');
                    if ($('#expense_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            expense_name: $("#expense_name").val(),
                            expense_category: $("#expense_category").val(),
                            category_type: $("#category_type").val(),
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('accounts.setting.store') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) { 
                                console.log(response);
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#add_modal').trigger("reset");
                                    $('#expense_add').modal('hide')
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('accounts.setting.index', ['tab=category']) }}";
                                } else {
                                    Toaster('error', response.success);
                                    $('#expense_add').modal('hide')
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('accounts.setting.index', ['tab=category']) }}";
                                }
                            },
                            error: function(response) {
                                var errors = data.responseJSON;
                                console.log(errors);
                            }
                        });
                    }
                });
            });
            $(document).ready(function() {
                $(document).on("submit", "#edit_expense_title_form", function(e) {
                    e.preventDefault();

                    var data = {
                        id: $("#edit_input_field").val(),
                        expense_name: $("#editexpense_name").val(),
                        editexpense_description: $("#editexpense_description").val(),
                        update_category_type: $("#update_category_type").val(),
                    }
                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('accounts/expese-setting-update') }}",

                        data: data,
                        success: function(response) {
                            if (response.status == 1) {
                                $('#modalEditexpense').removeClass('show');
                                $('#modalEditexpense').css('display', 'none');
                                Toaster('success', response.success);
                                setTimeout(function() {
                                    location.reload(true);
                                }, 3000);

                                window.location.href =
                                    "{{ route('accounts.setting.index', ['tab=category']) }}";
                            } else {
                                Toaster('error', response.success);
                            }

                        }
                    });

                });
            });
            //modal edit source ajax
            $(document).ready(function() {
                $('.result_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var expense_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('accounts/sales-setting-edit') }}/" + expense_id,
                        data: {
                            expense_id: expense_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].expense;

                            $("#edit_input_field").val(sec.id);
                            $("#editexpense_name").val(sec.name);
                            $("#editexpense_description").val(sec.description);
                            $("#update_category_type").val(sec.dr_cr);


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });
            $(document).ready(function() {
                // add expense ajax open
                $(document).on('click', "#Add_account", function(e) {
                    e.preventDefault();
                    $('#account_add_userForm').addClass('was-validated');
                    if ($('#account_add_userForm')[0].checkValidity() === false) {
                        event.stopPropagation();
                    } else {
                        var data = {
                            account_title: $("#account_title").val(),
                            opening_date: $("#opening_date").val(),
                            account_number: $("#account_number").val(),
                            account_currency: $("#account_currency").val(),
                            opening_balence: $("#opening_balence").val(),
                            note: $("#note").val(),
                        };

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('accounts.accountStore') }}",
                            data: data,
                            dataType: "json",

                            success: function(response) {
                                console.log(response);
                                if (response.status == 1) {
                                    Toaster('success', response.success);
                                    $('#expanse_account_add').trigger("reset");
                                    $('#expanse_account_add').modal('hide')
                                    setTimeout(function() {
                                        location.reload(true);
                                    }, 3000);

                                    window.location.href =
                                        "{{ route('accounts.setting.index', ['tab=account']) }}";
                                } else {
                                    Toaster('error', response.success);
                                }

                            },

                        });
                    }
                });

                $('.expense_edit_btn').on('click', function(e) {
                    e.preventDefault();

                    var account_id = $(this).data('id');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('accounts/sales-account-edit') }}/" + account_id,
                        data: {
                            account_id: account_id
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                            var sec = response[0].account;

                            $("#edit_account_field").val(sec.id);
                            $("#edit_account_title").val(sec.account_title); 
                            $("#edit_opening_date").val(sec.opening_date);
                            $("#edit_account_number").val(sec.account_number);
                            $("#edit_account_currency").val(sec.account_currency);
                            $("#edit_opening_balence").val(sec.opening_balance);
                            $("#edit_closing_balence").val(sec.closing_balance);
                            $("#edit_note").val(sec.note);
                            $('#edit_account_currency option[value="' + sec.account_currency + '"]')
                                .attr("selected", "selected");
                            $('#edit_type option[value="' + sec.account_type + '"]')
                                .attr("selected", "selected");


                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });

                $(document).on("submit", "#edit_expense_account", function(e) {
                    e.preventDefault();
                    var data = {
                        id: $("#edit_account_field").val(),
                        edit_account_title: $("#edit_account_title").val(),
                        edit_type: $("#edit_type").val(),
                        edit_opening_date: $("#edit_opening_date").val(),
                        edit_account_number: $("#edit_account_number").val(),
                        edit_account_currency: $("#edit_account_currency").val(),
                        edit_opening_balence: $("#edit_opening_balence").val(),
                        edit_closing_balence: $("#edit_closing_balence").val(),
                        edit_note: $("#edit_note").val(),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('accounts/expese-account-update') }}",
                        data: data,
                        success: function(response) {
                            $('#modalEditexpense').removeClass('show');
                            $('#modalEditexpense').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href =
                                "{{ route('accounts.setting.index', ['tab=account']) }}";


                        }
                    });

                });

            });

            // change category status
            $('.category_toggle_class').change(function() {

                let status = $(this).prop('checked') === true ? 1 : 0;
                let cate_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('accounts/txn-category-status') }}",
                    data: {
                        'status': status,
                        'cate_id': cate_id
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });
            // change status in ajax code end

            // change  transaction account  status
            $('.account_toggle_class').change(function() {

                let status = $(this).prop('checked') === true ? 1 : 0;
                let account_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('accounts/txn-account-status') }}",
                    data: {
                        'status': status,
                        'account_id': account_id
                    },
                    success: function(response) {
                        Toaster('success', response.success);
                    }
                });
            });

            $('#accountTab').click(function() {
            window.location.href =  "{{ route('accounts.setting.index', ['tab=account']) }}";
            });

            $('#TxnTab').click(function() {
            window.location.href =  "{{ route('accounts.setting.index', ['tab=category']) }}";
            });

            $('#atxnHeadTab').click(function() {
            window.location.href =  "{{ route('accounts.setting.index', ['tab=txn-head']) }}";
            });

            
            
        </script>
        <script>
            $(document).on("submit", "#add_head_title_form", function(e) {
                e.preventDefault();

                let section_type = $("#section_type:checked").val();
                var formData = {
                    title: $("#title").val(),
                    parent_section_id: $("#parent_section").val() ?? 0,
                    head_type: $("#head_type").val(),
                    status: $("#status").val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('accounts.txn-head-store') }}",

                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {

                        $('#modal1').removeClass('show');
                        $('#modal1').css('display', 'none');
                        if (response.success) {
                            Toaster('success', response.success);

                        } else { 
                            Toaster('error', response.success);
                        }

                        setTimeout(function() {
                            location.reload(true);
                        }, 3000);

                        window.location.href = "{{ route('accounts.setting.index', ['tab=txn-head']) }}";

                    }, 

                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#add_title_btn').click(function() {
                    // alert('drop');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({

                        url: "{{ route('accounts.txn-head-create') }}",

                        type: "POST",
                        success: function(result) { 
                            $.each(result.headresult.headresult, function(key, value) {
                                let option_html = "<option value='" + value.id + "'>" +
                                    value.head_title + "</option>"
                                $("#parent_section").append(option_html);
                            });
                        }
                    });
                });
            });
        </script>
        <script>
            //modal edit title ajax
            $(document).ready(function() {
                $('.head_edit_btn').on('click', function(e) {
                    e.preventDefault();
                    var txt_head_id = $(this).data('id'); 

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "GET",

                        url: "{{ url('accounts/txn-head-edit') }}/" + txt_head_id,
                        data: {
                            txt_head_id: txt_head_id
                        },
                        dataType: "json",
                        success: function(response) { 
                            
                            var sec = response.section;
                            //  var mod = response.seoresult;

                            $("#edit_input_head").val(sec.id);
                            $("#update_head_title").val(sec.head_title);

                            $('#status_head option[value="' + sec.status + '"]').prop('selected', true);

                            $('#update_head_type option[value="' + sec.dr_cr + '"]').prop('selected', true);
                            
                            if (sec.parent_id == 0) {
                                $('#update_head_section_type').prop('checked', 'true');
                            } else {
                                $('#update_head_section_type1').prop('checked', 'true');

                            }
                            //  console.log("parent",sec.parent_id);
                            if (sec.parent_id != '0') {

                                $("#update_head_title").val(sec.head_title);
                                $('#status_head option[value="' + sec.status + '"]').prop('selected',
                                    true);
                                $("#update_head_parent").html('');


                                $.each(response.seoresult, function(key, value) {
                                    console.log(key);
                                    let option_html = "<option value='" + value.id + "'>" +
                                        value.head_title + "</option>";
                                    $("#update_head_parent").append(option_html);
                                    $("#update_head_parent").val(sec.parent_id);
                                    $('.parent').show();
                                });

                            } else {

                                $('.parent').hide();

                                $.each(response.seoresult, function(key, value) { 
                                    let option_html = "<option value='" + value.id + "'>" +
                                        value.head_title + "</option>";
                                    $("#update_head_parent").append(option_html);
                                    $("#update_head_parent").val(sec.parent_id);
                                   
                                });

                            }
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });

            //   Edit title closed ajax
        </script>

        <!--update result title jquery-->
        <script>
            $(document).ready(function() {
                $(document).on("submit", "#edit_result_title_form", function(e) {
                    e.preventDefault();

                    var parentselectVal = $('.parentselectVal').prop('checked') === true;
                    if(parentselectVal){
                        var parent_id = 0;
                    }else{
                        var parent_id = $("#update_head_parent").val();
                    }

                    var data = {
                        id: $("#edit_input_head").val(),
                        title: $("#update_head_title").val(),
                        head_type: $("#update_head_type").val(),
                        parent_id:parent_id,    
                        section_type: $('.type').prop('checked') === true ? 0 : 1,
                        status: $("#status_head").val(),

                    } 

                    console.log(data);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('accounts/txn-head-update') }}",

                        data: data,
                        success: function(response) {
                            $('#modalEditResult').removeClass('show');
                            $('#modalEditResult').css('display', 'none');
                            console.log(response);
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href = "{{ route('accounts.setting.index', ['tab=txn-head']) }}";


                        }
                    });

                });
            });
        </script>
        <!--end result title update jquery-->


        <script>
             //result parent delete jquery start here
             $(document).on("click", "#result_delete_btn", function() {
                    var result_id = $(this).data('id');

                    $('#head_hidden_id').val(result_id);
                }); 


                 //result child delete jquery start here
                 $(document).on("click", "#child_delete", function() {
                    var delete_child = $(this).data('id');

                    $('#head_hidden_id').val(delete_child);
                });

                
                $(document).on('click', '.delete_btn', function() {
                    var delete_head = $('#head_hidden_id').val();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('accounts/txn-head-delete') }}/" + delete_head,
                        data: {
                            delete_child: delete_head,

                        },
                        dataType: "json",
                        success: function(response) {
                            $('#delete_result_modal').removeClass('show');
                            $('#delete_result_modal').css('display', 'none');
                            Toaster('success', response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);

                            window.location.href = "{{ route('accounts.setting.index', ['tab=txn-head']) }}";


                        }
                    });
                }); 


                //result parent title status change jquery
                $('.result_toggle_class').change(function() {
                    let status = $(this).prop('checked') === true ? 1 : 0;
                    let result_id = $(this).data('id');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{ route('accounts.changeHeadStatus') }}",
                        data: {
                            'status': status,
                            'result_id': result_id
                        },
                        success: function(response) {
                            // console.log(response.success);
                            Toaster('success', response.success);

                        }
                    });
                });

                


                $(".resultTitle").on("blur", function(e) {
                    e.preventDefault();
                    var result_id = $(this).data('id');
                    var sort_order = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('accounts.change_short_order') }}",
                        data: {
                            result_id: result_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });


                $(".categorySortOrder").on("blur", function(e) {
                    e.preventDefault();
                    var category_id = $(this).data('id');
                    var sort_order = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('accounts.change_category_short_order') }}",
                        data: {
                            category_id: category_id,
                            sort_order: sort_order
                        },
                        dataType: "json",
                        success: function(data) {
                            Toaster('success', data.success);
                        }
                    });
                });
        </script>
        
     @endpush
 </x-app-layout>
