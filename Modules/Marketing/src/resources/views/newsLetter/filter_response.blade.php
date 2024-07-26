 <table id="example1" class="table table_wrapper">
     <thead>
         <tr>
             <th class="wd-10p">{{ __('common.sl_no') }}</th>
             <th class="wd-20p">Date</th>
             <th class="wd-25p">Email</th>
             <th class="wd-25p">Name</th>
             <th class="wd-15p">{{ __('common.status') }}</th>

         </tr>
     </thead>
     <tbody>
         {{-- @dd($content) --}}
         @if (!empty($content->data))
             @foreach ($content->data as $key => $list)
                 <tr>
                     <td>{{ $key + 1 }}</td>
                     <td>{{ \Carbon\Carbon::parse($list->created_at)->format('d-M-Y') }}
                     </td>
                     <td>{{ $list->customer_email }}</td>
                     <td>{{ $list->customer_name }}</td>
                     <td>
                         @switch($list->status)
                             @case(0)
                                 <p>NotSubscribed</p>
                             @break

                             @case(1)
                                 <p>Subscribed</p>
                             @break

                             @case(2)
                                 <p>UnSubscribed</p>
                             @break

                             @case(3)
                                 <p>Blocked</p>
                             @break

                             @default
                                 <p>-</p>
                         @endswitch
                     </td>

                 </tr>
             @endforeach
         @else
             <tr>
                 <td colspan="8">
                     <h5 class="text-center mb-0 py-1">{{ __('common.no_record') }}</h5>
                 </td>
             </tr>

         @endif
     </tbody>
 </table>

 <!--Pagination Start-->
 {!! \App\Helper\Helper::make_pagination(
     $content->total_records,
     $content->per_page,
     $content->current_page,
     $content->total_page,
     'marketing.subscription.index',
 ) !!}
 <!--Pagination End-->
