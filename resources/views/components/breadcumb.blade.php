{{-- Session Flash Success Message Show Here --}}

  <!--  @if (session('success')) 
  
  <div class="alert alert-success">
       {{ session('success') }}

  </div> 
   @endif  -->
    

{{-- Session Flash Danger Message Show Here --}}

  @if (session('danger'))
  <div class="alert alert-danger">
      {{ session('danger') }}
  </div>
  @endif


 <div class="d-md-flex justify-content-between align-items-center">
    <h5 class="mb-0">{{ $title }}</h5>
    <nav aria-label="breadcrumb" class="d-inline-block mt-2 mt-sm-0">
        <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
            
            @if (!empty($sublist))
            @foreach ($sublist as $key=>$list)
            @if( $key <  sizeof($sublist) )
            <li class="breadcrumb-item text-capitalize @if($key==1) active @endif">
            @if($key==0)
            <a href="{{ $list['link'] }}">{{ $list['name'] }}</a>
            @else
            {{ $list['name'] }}
            @endif
            </li>
            @endif
            @endforeach
            @endif
        </ul>
    </nav>
</div>