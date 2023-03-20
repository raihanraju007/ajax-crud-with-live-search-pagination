
       <script>
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        </script>

        <script>
            $(document).ready(function(){
                $(document).on('click','.add_product',function(e){
                    e.preventDefault();
                    let name = $('#name').val();
                    let price = $('#price').val();
                    // console.log(name+price);
                    // alert(name + price);

                    $.ajax({
                        url:"{{ route('add.product') }}",
                        method:'POST',
                        data: {name:name, price:price},
                        success:function(res){
                            if(res.status == 'success'){
                                $('#addModal').modal('hide');
                                $('#addProductForm')[0].reset();
                                $('.table').load(location.href + ' .table');
                            }
                        },
                        error:function(err){
                            let error = err.responseJSON;
                            $.each(error.errors,function(index, value){
                                $('.errMessaageContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                            });
                        }
                    });

                })
                // Update form

                $(document).on('click','.update_product_form',function(){
                    let id      = $(this).data('id');
                    let name    = $(this).data('name');
                    let price   = $(this).data('price');

                    $('#up_id').val(id);
                    $('#up_name').val(name);
                    $('#up_price').val(price);
                });
            });
        </script>