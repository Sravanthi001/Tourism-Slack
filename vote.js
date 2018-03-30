function f1(objButton){  
				var a = (objButton.value);
			//	var b = (objButton.id);
			
				 var msg_id = $(objButton).attr('id');
			//	alert (b);
				//var name = $("input:image").val();
				//alert (name);
				//return a;
				var d= {'vote':a, 'msg_id':msg_id}
				$.ajax({
                    type: "POST",
                    url: '',
                     data:{'d1':d},
					dataType: 'text',
                    success: function(data)
                    {
                        alert(d.msg_id);
                    }
                });
			}