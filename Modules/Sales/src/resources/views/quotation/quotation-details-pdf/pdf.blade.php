<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<ol class="breadcrumb bg-transparent px-0 pb-0 fw-500">
        <li class="breadcrumb-item"><a href="#" class="text-dark tx-15">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('quotation.index') }}" class="text-dark tx-15">Quotation</a></li>

    </ol>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mg-b-5">Quotation Number {{ $quotation['response']->quotation_no }}</h4>
                    <p class="mg-b-0 tx-color-03">{{ \Carbon\Carbon::parse($quotation['response']->created_at)->format('Y/m/d')}}</p>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                    <button class="btn btn-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer mg-r-5">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg> Print</button>

                        <button class="btn btn-white"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-share mg-r-5">
                            <polyline points="6 9 6 2 18 2 18 9"></polyline>
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                            <rect x="6" y="14" width="12" height="8"></rect>
                        </svg>Share</button>

                    <button class="btn btn-primary mg-l-5"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-download mg-r-5">
                            <rect x="1" y="4" width="22" height="16" rx="2"
                                ry="2"></rect>
                            <line x1="1" y1="10" x2="23" y2="10"></line>
                        </svg> Download</button>
                </div>
            </div>
        </div><!-- container -->
    </div>
    <div class="content tx-13">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="row">
                <div class="col-sm-6">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed To</label>
                    <h6 class="tx-15 mg-b-10"></h6>
                    <p class="mg-b-0">201 Something St., Something Town, YT 242, Country 6546</p>
                    <p class="mg-b-0">Tel No: </p>
                    <p class="mg-b-0">Email:</p>
                </div><!-- col -->
                <div class="col-sm-6 tx-right d-none d-md-block">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Number</label>
                    <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">{{ $quotation['response']->quotation_no }}</h1>
                </div><!-- col -->
                <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Billed From</label>
                    <h6 class="tx-15 mg-b-10">Juan Dela Cruz</h6>
                    <p class="mg-b-0">4033 Patterson Road, Staten Island, NY 10301</p>
                    <p class="mg-b-0">Tel No: 324 445-4544</p>
                    <p class="mg-b-0">Email: youremail@companyname.com</p>
                </div><!-- col -->
                <div class="col-sm-6 col-lg-4 mg-t-40">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Invoice Information</label>
                    <ul class="list-unstyled lh-7">
                        <li class="d-flex justify-content-between">
                            <span>Invoice Number</span>
                            <span>{{ $quotation['response']->quotation_no }}</span>
                        </li>
                       
                        <li class="d-flex justify-content-between">
                            <span>Issue Date</span>
                            <span>{{ \Carbon\Carbon::parse($quotation['response']->created_at)->format('Y/m/d')}}</span>
                        </li>
                       
                    </ul>
                </div><!-- col -->
            </div><!-- row -->

            <div class="table-responsive mg-t-40">
                <table class="table table-invoice bd-b">
                    <thead>
                        <tr>
                            <th class="wd-20p"></th>
                            <th class="wd-40p d-none d-sm-table-cell"></th>
                            <th class="tx-center"></th>
                            <th class="tx-right"></th>
                            <th class="tx-right"></th>
                        </tr>
                    </thead>
                    @if (!empty($quotation['response']->crm_quotation_item))
                            @foreach ($quotation['response']->crm_quotation_item as $key => $item)
                                <tr>
                                <td class="tx-nowrap">{{ $key + 1 }}</td>
                                    <td class="d-none d-sm-table-cell tx-color-03"> {{ $item->item_name }}</td>
                                    <td class="tx-center">{{ $item->quantity }}</td>
                                    <td class="tx-right">${{ $item->unit_price }}</td>
                                    <td class="tx-right">${{ $item->item_cost }}</td>
                                </tr>
                            @endforeach
                        @endif
                </table>
            </div>

            <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Notes</label>
            <p>{{ $quotation['response']->note}} </p>
          </div>

        </div><!-- container -->
    </div>
</body>

</html>
