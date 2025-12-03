                     <input type="hidden" id="id" name="id">
     <div class="custom-file">
                                                         <input type="file" name="imge" class="custom-file-input" id="imge">
                                                         <label class="custom-file-label" accept="image/*" for="chooseFile">الصورة الرمزية</label>
                                                    </div>					 
			<div class="form-group">
                                                        <label>اسم القسم</label>
                                                        <div class="controls">
                                                            <input type="text"  id="name" name="name" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="اسم القسم">
                                                        </div>
                                                    </div> 

	<div class="form-group">
                                                        <label>الترتيب</label>
                                                        <div class="controls">
                                                            <input type="number"  id="sort" name="sort" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="الترتيب">
                                                        </div>
                                                    </div> 													
													
							 <div class="form-group">
			                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                        <input type="checkbox"  name="status" id="status">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
														 <label>الحالة</label>
                                                        
                                                    </div>
                                                    </div>  							
										   
										
											
                   <script type="text/javascript">

function dispalyData(elem){
  var id=$(elem).attr('data-id');
  var name=$(elem).attr('data-name');
  var sort=$(elem).attr('data-sort');
  var status=$(elem).attr('data-status');
if(status==1){
document.getElementById("status").checked = true;
}else{
document.getElementById("status").checked = false;	
}
  	 
     $('#id').val(id)
     $("#name").val(name)
     $("#sort").val(sort)
     $("#status").val(status)
     $("#modal_edit").modal("show");
}

    
 </script>                