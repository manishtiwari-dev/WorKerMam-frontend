<table class="table border table_wrapper">
    <thead>
        <tr>
            <th>{{ __('common.sl_no') }}</th>
            <th>{{ __('sales.txnDate') }}</th>
            <th>{{ __('sales.txn_title') }}</th>
            <th>{{ __('sales.amount') }}</th> 
            <th>{{ __('sales.txn_type') }}</th> 
            <th>Accounts</th>
            <th>{{ __('common.action') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($content->app_transactions as $key => $transaction)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($transaction->txn_date)->format('d-M-Y') }}</td> 
                
                <td>{{ $transaction->txn_title }}</td>                    
                <td>{{ $transaction->amount }} </td> 
                <td>
                    <span class="badge  {{($transaction->dr_cr == 'dr')?'text-bg-danger':'text-bg-success'}}">{{($transaction->dr_cr == 'cr')?'Cr':'Dr'}}</span>
                </td>
                <!-- <td></td> -->
                <td>{{$transaction->accounts->account_title ?? ''}}</td>
                <td class="d-flex align-items-center  gap-2"> 
                    @if (\App\Helper\Helper::CheckPermission($pageAccess, 'update') == 'true')
                        <a href="{{ route('accounts.transaction.edit', $transaction->id) }}"
                            class="btn btn-sm btn-white table_btn py-1 px-2"><i class="fa fa-pencil"></i></a>
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
<!--Pagination Start-->
{!! \App\Helper\Helper::make_pagination(
    $content->total_records,
    $content->per_page,
    $content->current_page,
    $content->total_page,
    'accounts.transaction.index',
    ['start_date' => $content->start_date, 'end_date' => $content->end_date],
) !!}
<!--Pagination End-->
