@php

      $sheetElements = $sheetlist['excelElementList'];  
@endphp

<table class="table table-center bg-white  mb-0">
      <thead>
                  <th class="wd-15p">Row</th>
            @php
                  $alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z" ];
            @endphp

            @foreach($alphabet as $date => $value) 
                  <th>{{ $value }}</th>
            @endforeach

      </thead>

            @for($i = 1; $i<= 100; $i++)
                  <tr> <td>{{ $i }}</td>
                  @foreach($sheetElements as $key => $values) 
                  @foreach($values as $k=>$val)
                         @if($key == $i)
                         <td> {{$val}} </td>
                         @endif
                  @endforeach
                        
                  @endforeach
                  </tr>
            @endfor
</table> 