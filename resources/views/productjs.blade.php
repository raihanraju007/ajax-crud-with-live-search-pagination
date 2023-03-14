
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


                    //      $.ajax('{{ route('add.product') }}', {
                    //     type: 'POST',  // http method
                    //     data: { name: name, price:price },  // data to submit
                    //     success: function (res) {
                            
                    //     },
                    //     error: function (err) {
                    //         let error = err.responseJSON;
                    //         $.each(error.errors,function(index, value){
                    //             // alert(value);
                    //             $('.errMessaageContainer').append('<span class="text-danger">' + value + '</span>' + '<br>');
                    //         });
                    //     }
                    // });



                })
            });
        </script>