<x-app-layout>
    @section('title', 'Contact')

<div class="contact-content">
    <div class="layout-specing">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb bg-transparent px-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Import</li>
            </ol>
        </nav>
        <form action="{{route('marketing.import')}}" enctype="multipart/form-data" method="POST" class="needs-validation" novalidate>
            @csrf
            <div class="card contact-content-body">
                <div class="card-header">
                    <h6 class="tx-15 mg-b-0">{{__('newsletter.bulk_import')}}</h6>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-lg-6 col-sm-12 ">
                            <label class="form-label">{{__('newsletter.contact_group')}}</label>
                            <select class="form-select form-control" name="group_id"
                                aria-label="Default select example" required>
                                <option selected disabled value="">
                                    {{__('newsletter.select_group')}}
                                </option>
                                @if(!empty($showGroupName))
                                @foreach($showGroupName as $group)
                                <option value="{{$group->id}}" {{session()->get('contactgroup') == $group->id ?
                                    "selected" :
                                    '' }}>{{$group->group_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12 ">
                            <label class="form-label">{{__('newsletter.country_name')}}</label>
                            <select class="form-select form-control" name="contact_group"
                                aria-label="Default select example" required>
                                <option selected disabled value="">
                                    {{__('newsletter.select_country_name')}}
                                </option>
                                @if(!empty($country_name))
                                @foreach($country_name as $country)
                                <option value="{{$country->countries_iso_code_3}}">{{$country->countries_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-6 col-sm-12 ">
                            <label class="form-label">Select CSV File<span
                            class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                <input type="file" name="file" required>
                                
                            </div>
                            <span class="text-danger">
                                    @error('file')
                                    {{$message}}
                                    @enderror
                                </span>
                                <div class="invalid-feedback">
                                    {{__('newsletter.file_error')}}
                                </div>
                        </div>
                        <div class="form-group col-lg-6 col-sm-12  p-2">
                            <label for="file">Simple Contact File</label>
                            <a href="{{route('marketing.simple-download-file')}}">Download Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <div class="col-lg-2 p-0">
                     <input type="submit" class="btn btn-primary"/>
                </div>
            </div>
        </form>
    </div>
</div>

  {{--   <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0 d-inline">{{__('newsletter.bulk_import')}}
                                </h5>
                            </div>
                            <div class="px-4 py-4">
                                <form action="{{route('import')}}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">{{__('newsletter.contact_group')}}</label>
                                            <div class="form-icon position-relative">
                                                <select class="form-select form-control" name="group_id"
                                                    id="group_id" aria-label="Default select example" required>
                                                    <option selected disabled value="">
                                                        {{__('newsletter.select_group')}}
                                                    </option>
                                                    @if(!empty($showGroupName))
                                                    @foreach($showGroupName as $group)
                                                    <option value="{{$group->id}}" {{session()->get('contactgroup') == $group->id ?
                                                        "selected" :
                                                        '' }}>{{$group->group_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span style="color:red;">
                                                    @error('country')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('newsletter.contact_group_error')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label class="form-label">{{__('newsletter.country_name')}}</label>
                                            <div class="form-icon position-relative">
                                                <select class="form-select form-control" name="contact_group"
                                                    id="contact_group" aria-label="Default select example" required>
                                                    <option selected disabled value="">
                                                        {{__('newsletter.select_country_name')}}
                                                    </option>
                                                    @if(!empty($country_name))
                                                    @foreach($country_name as $country)
                                                    <option value="{{$country->countries_iso_code_3}}">{{$country->countries_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                <span style="color:red;">
                                                    @error('country')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('newsletter.country_error')}}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label class="form-label">Select CSV File<span
                                                class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input type="file" name="file"  required/><br>
                                                
                                                <span style="color:red;">
                                                    @error('country')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('newsletter.file_error')}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <input type="submit" class="btn btn-danger" />
                                        </div>
                                        <div class="mt-3">
                                            <label for="file">Simple Contact File</label>

                                            <a href="{{route('simple-download-file')}}">Download Now</a>
                                        </div>
                                    </div>
                                </form>

                            </div>



                        </div>

                    </div>

                </div>
            </div>
            <!--end col-->
        </div>
    </div> --}}
    <!--end row-->
</x-app-layout>