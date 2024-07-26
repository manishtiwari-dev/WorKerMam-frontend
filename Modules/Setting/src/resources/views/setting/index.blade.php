<x-app-layout>     
    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                @if (!empty($setting_key_list) && sizeof($setting_key_list) > 0)
                    @foreach ($setting_key_list as $key => $setting)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="ex1-tab-{{ $setting->group_id }}"
                                data-bs-toggle="tab" data-bs-target="#ex1-tabs-{{ $setting->group_id }}" role="tab"
                                aria-controls="ex1-tabs-{{ $setting->group_id }}" type="button"
                                aria-selected="@if ($key == 0) true @else false @endif">{{ $setting->group_name }}</button>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content" id="ex1-content">
                @if (!empty($setting_key_list))
                    @foreach ($setting_key_list as $key => $setting_data)
                        <div class="tab-pane fade @if ($key == 0) show active @endif"
                            id="ex1-tabs-{{ $setting_data->group_id }}" role="tabpanel"
                            aria-labelledby="ex1-tab-{{ $setting_data->group_id }}">
                            <div class="col-lg-12 mt-4">
                                <div class="card border-0 rounded shadow ">
                                    <div class="card-header bg-transparent px-4 py-2">
                                        <h5 class="text-md-start text-center mb-0">{{ $setting_data->group_name }}</h5>
                                    </div>
                                    <div class="row px-4 pb-4">
                                        @if (!empty($setting_data->setting_grp_key))
                                            @foreach ($setting_data->setting_grp_key as $setting_group_key_data)
                                                <div class="col-lg-4 col-sm-12">
                                                    <label for="contact_name"
                                                        class="form-label">{{ $setting_group_key_data->setting_key }}</label>
                                                    <input type="text" class="form-control"
                                                        id="{{ $setting_group_key_data->setting_key }}"
                                                        name="{{ $setting_group_key_data->setting_key }}"
                                                        placeholder="{{ $setting_group_key_data->setting_key }}"
                                                        value="{{ $setting_group_key_data->setting_key }}"
                                                        required="">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div><!--end row-->                        
                                </div>
                            </div><!--end col-->                          
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div> <!--end container-->  
</x-app-layout>
