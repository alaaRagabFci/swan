  

$(document).ready(function() {

    $("#changePasswordModal form").validator().on('submit', function(e){
        if (!e.isDefaultPrevented())
        {
            var self = $(this);
            $.ajax({
                url: self.closest('form').attr('action')+ '/' + self.data('id') ,
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    $('#changePasswordModal').modal('hide');
                    swal({
                        title: "تم تغير كلمة السر",
                        type: "success",
                        closeOnConfirm: false,
                        confirmButtonText: "موافق !",
                        confirmButtonColor: "#ec6c62",
                        allowOutsideClick: true
                    });
                    oTable.draw();
                },
                error: function(){
                    swal({
                        title: "حدث خطأ",
                        type: "error",
                        closeOnConfirm: false,
                        confirmButtonText: "موافق !",
                        confirmButtonColor: "#ff0000",
                        allowOutsideClick: true
                    });
                }
            });
            e.preventDefault();
        }
    });

       //add siteoption
       $("#addModal form").on('submit', function(e){
        if (!e.isDefaultPrevented())
        {
          var self = $(this);
            var data = convert(self.serialize());
          $.ajax({
            url: self.closest('form').attr('action'),
            type: "POST",
            data: self.serialize(),
            beforeSend: function(){
                var values = Object.values(data);
                for (i = 0; i < values.length; i++) {
                    if (values[i] == "")
                        return false;
                }
            },
            success: function(res){
              $('.addForm')[0].reset();
                $('#addModal').modal('hide');
              swal({
                title: "تم التسجيل بنجاح",
                type: "success",
                closeOnConfirm: false,
                confirmButtonText: "موافق !",
                confirmButtonColor: "#ec6c62",
                allowOutsideClick: true
              });
              oTable.draw();
            },
            error: function(error){
              swal({
                title: error['responseJSON']['msg'],
                type: "error",
                closeOnConfirm: false,
                confirmButtonText: "موافق !",
                confirmButtonColor: "#ff0000",
                allowOutsideClick: true
              });
            }
          });
          e.preventDefault();
        }
      });

      //Update
      $("#editModal form").validator().on('submit', function(e){
       if (!e.isDefaultPrevented())
       {
         var self = $(this);
           var data = convert(self.serialize());
         $.ajax({
           url: self.closest('form').attr('action') + "/" +  self.attr("data-id"),
           type: "POST",
           data: "_method=PUT&" + self.serialize(),
             beforeSend: function(){
                 var values = Object.values(data);
                 for (i = 0; i < values.length; i++) {
                     if (values[i] == "")
                         return false;
                 }
             },
           success: function(res){
             $('#editModal').modal('hide');
             swal({
              title: "تم التحديث بنجاح",
              type: "success",
              closeOnConfirm: false,
              confirmButtonText: "موافق !",
              confirmButtonColor: "#ec6c62",
              allowOutsideClick: true
            });
             oTable.draw();
           },
           error: function(error){
             swal({
              title: error['responseJSON']['msg'],
              type: "error",
              closeOnConfirm: false,
              confirmButtonText: "موافق !",
              confirmButtonColor: "#ff0000",
              allowOutsideClick: true
            });
           }
         });
         e.preventDefault();
       }
     });

    function convert(str){
        str = str.replace(/\(|\)/g,'');
        var arr = str.split('&');
        var obj = {};
        for (var i = 0; i < arr.length; i++) {
            var singleArr = arr[i].trim().split('=');
            var name = singleArr[0];
            var value = singleArr[1];
            if (obj[name] == undefined) {
                obj[name] = value;
            }
        }
        return obj;
    }
    });