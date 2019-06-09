(function() {
    /* delete item*/
    $(document.body).on('click', '.deleteForm', function(e) {
        e.preventDefault();
        if (window.confirm("Are you sure to remove this item ?"))
        {
            var self = $(this);
            $(this).button({loadingText: 'deleting...'});
            $(this).button('loading');

            $.ajax({
                url: self.closest('form').attr('action') ,
                type: "POST",
                data: self.serialize(),
                error: function(){
                    self.button('reset');
                },
                success: function(res){
                    self.button('reset');
                    if(oTable != undefined)
                        swal({
                          title: "تم المسح بنجاح",
                          type: "success",
                          closeOnConfirm: false,
                          confirmButtonText: "موافق !",
                          confirmButtonColor: "#ec6c62",
                          allowOutsideClick: true
                        });
                        oTable.draw();
                }
            });
        }

  });


}).call(this);
