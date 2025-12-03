                     <input type="hidden" id="id" name="id">     
                                                    <div class="form-label-group">
                                                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="اسم المستخدم" required>
                                                        <label for="user_name">اسم المستخدم</label>
                                                    </div> 
													<div class="form-label-group">
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
                                                        <label for="password">كلمة المرور</label>
                                                    </div>
												    <div class="form-group">
			                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                        <input type="checkbox"  name="statues" id="statues">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
														 <label>الحالة</label>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="form-label-group">
                                                        <input type="text" id="name" name="name" class="form-control" placeholder="اسم الصنف" required>
                                                        <label for="name">اسم الصنف</label>
                                                    </div>
											        <div class="custom-file">
                                                         <input type="file" name="imge" class="custom-file-input" id="imge">
                                                         <label class="custom-file-label" accept="image/*" for="chooseFile">الشعار</label>
                                                    </div>
	  <br/>
	  <br/>
	  
                                                    <div class="form-label-group">
                                                        <input type="number" id="price"  name="price" class="form-control" placeholder="سعر الحجز" required>
                                                        <label for="price">سعر الحجز</label>
                                                    </div>
												    <div class="custom-file">
                                                        <input type="file" name="url_profession_license" accept="pdf/*" class="custom-file-input" data-validation-required-message="الحقل مطلوب" id="url_profession_license">
                                                        <label class="custom-file-label" for="chooseFile">ترخيص مزاولة المهنة</label>
                                                    </div>
												    <div class="form-group">		  
                                                        <label> المدينة </label>
                                                        <div class="controls">
												        <select name="city_id" id="city_id"  class="form-control">
														    <?php
											 if (isset($Display_city))
                                          for ($i = 0; $i < count($Display_city); $i++) {
                                            $city_name=$Display_city[$i]['name'];
                                            $city_id=$Display_city[$i]['id'];
                                            echo "<option value='$city_id'>$city_name </option>";
                                                }
                                         ?>
		                                                </select>
                                                        </div>
													</div>

                                                    <div class="form-group">		  
                                                        <label> القسم </label>
                                                        <div class="controls">
												        <select name="section_id" id="section_id"  class="form-control">
														    <?php
											 if (isset($Display_section))
                                          for ($i = 0; $i < count($Display_section); $i++) {
                                            $city_name=$Display_section[$i]['name'];
                                            $city_id=$Display_section[$i]['id'];
                                            echo "<option value='$city_id'>$city_name </option>";
                                                }
                                         ?>
		                                                </select>
                                                        </div>
													</div>
                                                 


                                                    <div class="form-label-group">
                                                        <input type="number" id="phone"  name="phone" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder=" رقم الجوال">
                                                        <label for="phone">رقم الجوال</label>
                                                    </div>
													<div class="form-label-group">
                                                        <input type="email" id="email"  name="email" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="الايميل">
                                                        <label for="email">الايميل</label>
                                                    </div>
													   <div class="form-label-group">
                                                        <input type="text" id="address" name="address" class="form-control" placeholder="العنوان" required>
                                                        <label for="address">العنوان</label>
                                                    </div> 
											
			 
													<div class="form-label-group">
                                                        <textarea class="form-control"  id="description" name="description" placeholder=" ملاحظة" rows="3"></textarea>
                                                        <label for="description">ملاحظة</label>
                                                    </div>
												
			       <script type="text/javascript">

function dispalyData(elem){

  var id=$(elem).attr('data-id');
  var user_name=$(elem).attr('data-user_name');
  var password=$(elem).attr('data-password');
  var city_id=$(elem).attr('data-city_id');
  var section_id=$(elem).attr('data-section_id');
  var name=$(elem).attr('data-name');
  var phone=$(elem).attr('data-phone');
  var email=$(elem).attr('data-email');
  var price=$(elem).attr('data-price');
  var description=$(elem).attr('data-description');
  var address=$(elem).attr('data-address');
 var statues=$(elem).attr('data-statues');
	
 var mySelect = document.getElementById('city_id');
for(var i, j = 0; i = mySelect.options[j]; j++) {
    if(i.value == city_id) {
        mySelect.selectedIndex = j;
        break;
    }
}

var mySelect = document.getElementById('section_id');
for(var i, j = 0; i = mySelect.options[j]; j++) {
    if(i.value == section_id) {
        mySelect.selectedIndex = j;
        break;
    }
}




	
  //var check = document.getElementById("statues");  
if(statues==1){
document.getElementById("statues").checked = true;
}else{
document.getElementById("statues").checked = false;	
}
  //  document.getElementById("statues").value=false; 
     $('#id').val(id);
     $("#user_name").val(user_name);
     $("#password").val(password);
     $("#name").val(name);
     $("#phone").val(phone); 	 
     $("#email").val(email);
     $("#price").val(price);	 
     $("#description").val(description);	  
 $("#address").val(address);	 


    $("#modal_edit").modal("show");
}

    
 </script>                