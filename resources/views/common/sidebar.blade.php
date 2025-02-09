@php
    $current_url = url()->current();
    
    $domain = Request::root();
    $indexurl = str_replace($domain, '', $current_url);

    $root_index = Request::segment(1);
    $indexArray = explode('/', $indexurl);
    $role = App\Helper\Helper::role_slug();
    $enabled_module = ['SEO', 'CRM', 'AddOnManager', 'Newsletter'];
    $api_token = App\Helper\Helper::getCurrentuserToken();
    $userdata = Cache::get('userdata-' . $api_token);
    
@endphp


<div class="aside-header">
    <a href="" class="aside-menu-link">
        <i data-feather="menu"></i>
        <i data-feather="x"></i>
    </a>
    <a href="{{ config('app.app-url') }}" class="aside-logo"><img src="{{ asset('assets/images/workerman.png') }}"
            height="32px" class="logo-light-mode" alt="WorkerMan">
    </a>
    
</div>

<div class="aside-body">

    
    <ul class="nav nav-aside">

        @if (!empty($userdata))
            @foreach ($userdata->module_list as $key => $module_name)
                <li
                    class="nav-item with-sub  {{ in_array($root_index, [$module_name->module_slug]) ? 'active show' : '' }} ">
                    <a href="javascript:void(0)" class="nav-link"><i
                            data-feather={{ $module_name->module_icon ? $module_name->module_icon : '' }}></i>
                        <span>{{ App\Helper\Helper::translation($module_name->module_name) }}</span></a>

                    @if (!empty($module_name->menu))
                        <ul>
                            @foreach ($module_name->menu as $key => $menu_name)
                            
                                @if ($menu_name->section_source == 2)
                                    @php
                                        $url = $menu_name->section_url;
                                        
                                        $index = explode('/', $url);
                                        if (in_array($index[1], $indexArray) && in_array($index[2], $indexArray)) {
                                            $active = 'active';
                                        } else {
                                            $active = '';
                                        }
                                    @endphp


                          
                                    @if( \App\Helper\Helper::CheckMenushow($menu_name->section_id) == 'true')
                                        
                                    <li class="nav-item {{ $active }}">
                                            <a href="{{ $domain . $menu_name->section_url }}"
                                                class="bar-link">{{ App\Helper\Helper::translation($menu_name->section_name) }}</a>
                                        </li>

                    
                                    @endif

                                    

                                @else
                                    <li class='nav-item {{ $indexurl == 'user' ? 'active' : '' }}'><a
                                            href="{{ config('app.app-url') }}{{ $menu_name->section_url }}"
                                            class="bar-link">{{ App\Helper\Helper::translation($menu_name->section_name) }}</a>
                                    </li>                                  

                                @endif

                                
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
</div>
