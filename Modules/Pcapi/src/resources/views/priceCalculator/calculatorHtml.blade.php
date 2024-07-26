
@if (!empty($content->data))

<div class="table-responsive text-nowrap table-hover">

    <table class="table">
        <tr>
        <td style="width: 30%">Product Cost:</td>
        <td colspan="2">{{ $content->data->product_cost }}</td>
        </tr>
        <tr>
        <td style="width: 30%">Total Weight:</td>
        <td colspan="2">{{$content->data->air_weight}}</td>
        </tr>
        <tr>
        <td style="width: 30%">Cubic Metres (CBM):</td>
        <td colspan="2">{{$content->data->cbm}}</td>
        </tr>
    </table>

    @if (!empty($content->data->air_cargo))

        <table class="table">
            <thead>
            <tr>
            <th style="width: 30%">Shipping Method </th>
            <th style="width: 30%">Air Shipping</th>
            <th style="width: 40%">Poduct Cost + Air Shipping</th>
            </tr>
            </thead>
            <tbody>

            @foreach($content->data->air_cargo as $key =>$val)
            <tr>
                <td style="width: 30%">{{$val->airport_name}}</td>
                <td style="width: 30%">{{$val->shipping_cost}}</td>
                <td style="width: 40%">{{$val->products_air_cargo}}</td>
            </tr>
            @endforeach

            </tbody>
        </table>

    @endif


    @if (!empty($content->data->air_shipping))

        <table class="table">
            <thead>
            <tr>
            <th style="width: 30%">Shipping Method </th>
            <th style="width: 30%">Air Shipping</th>
            <th style="width: 40%">Poduct Cost + Air Shipping</th>
            </tr>
            </thead>
            <tbody>

            @foreach($content->data->air_shipping as $key =>$val)
            <tr>
                <td style="width: 30%">{{$val->method_name}}</td>
                <td style="width: 30%">{{$val->shipping_cost}}</td>
                <td style="width: 40%">{{$val->products_air_shipping}}</td>
            </tr>
            @endforeach

            </tbody>
        </table>

   @endif

   @if (!empty($content->data->sea_shipping))

        <table class="table">
            <thead>
            <tr>
            <th style="width: 30%">Sea Port</th>
            <th style="width: 30%">Sea Shipping</th>
            <th style="width: 40%">Product Cost + Sea Shipping</th>
            </tr>
            </thead>
            <tbody>

            @foreach($content->data->sea_shipping as $key =>$val)
            <tr>
                <td style="width: 30%">{{$val->seaport_name}}</td>
                <td style="width: 30%">{{$val->shipping_cost}}</td>
                <td style="width: 40%">{{$val->products_sea_shipping}}</td>
            </tr>
            @endforeach

            </tbody>
        </table>

   @endif



@else
    <div class="card mg-b-20 mg-lg-b-25">
        <div class="card-body ">
            <div class="col-md-8">
                <p>No Records</p>
            </div>
        </div>
    </div>
@endif
