                     <input type="hidden" id="id" name="id">   
		<div class="form-group">
                                                        <label>اسم المستخدم</label>
                                                        <div class="controls">
                                                            <input type="text"  id="user_name" name="user_name" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="اسم المستخدم">
                                                        </div>
                                                    </div>   
										       <div class="form-group">
                                                        <label>كلمة المرور:</label>
                                                        <div class="controls">
                                                            <input type="password" id="password"  name="password" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="كلمة المرور">
                                                        </div>
                                                    </div>   
													
      <div class="custom-file">
        <input type="file" name="imge" class="custom-file-input" id="imge">
        <label class="custom-file-label" for="chooseFile">صورة المستخدم</label>
      </div>
									           <div class="form-group">
                                                     <label>رقم الجوال </label>
                                                        <div class="controls">
                                                            <input type="number" id="phone"  name="phone" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder=" رقم الجوال" >
                                                        </div>
                                                    </div> 
											   <div class="form-group">
                                                          <label>الايميل </label>
                                        <div class="controls">
                                                       <input class="form-control" type="email" id="email" name="email" data-validation-required-message="الحقل مطلوب" placeholder="الايميل">
                                              </div>
                                                    </div>  
												 <div class="form-group">
                                            <label>ملاحظة</label>
                                            <textarea class="form-control"  id="note" name="note" placeholder=" ملاحظة" rows="2"></textarea>
                                        </div>
										
										

                   <script type="text/javascript">

				   
function dispalyData(elem){
	// alert('Hello');
 //user_name imge phone email note
  var user_name=$(elem).attr('data-user_name');
  var phone=$(elem).attr('data-phone');
  var email=$(elem).attr('data-email');
  var note=$(elem).attr('data-note');
  var password=$(elem).attr('data-password');
  var id=$(elem).attr('data-id');

  
     $('#id').val(id)
     $("#user_name").val(user_name)
     $("#phone").val(phone)
     $("#email").val(email)
     $("#user_name").val(user_name) 
     $("#password").val(password) 	 
    $("#note").val(note) 	 
 
 $('#modal_edit').modal('show'); 
 }

    
 </script>                