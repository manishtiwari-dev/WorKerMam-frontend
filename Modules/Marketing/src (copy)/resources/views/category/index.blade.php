<x-app-layout>
 
    

@push('scripts')

    
<script type="text/javascript">
  
  $('.toggle-class').change(function () {
      let status = $(this).prop('checked') === true ? 1 : 0;
      let categories_id = $(this).data('categories_id');
      console.log(status)
      console.log(categories_id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{ url('changeStatus') }}",
          data: { 'status': status, 'categories_id': categories_id },
          success: function (response) {
             Toaster(response.success);
          }
      });
  });
</script>

<script>
        $(document).ready(function() {

         // category sort order update
            $(".inputPassword2").on("blur",function(e){ 
                e.preventDefault();
                var categories_id = $(this).data('categories_id');
                var sort_order = $(this).val();
                console.log(categories_id);
                console.log(sort_order);
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    type:"POST",
                    url: "{{route('pcCategrySortOrder')}}",
                    data:{categories_id:categories_id,sort_order:sort_order},
                    dataType:"json",
                    success:function(data){
                        Toaster(data.success);
                    }
                }); 
            }); 

        });
        
    </script>

@endpush
</x-app-layout>
