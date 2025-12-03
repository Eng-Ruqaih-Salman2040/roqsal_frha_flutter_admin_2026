                     <input type="hidden" id="id" name="id">                                      
			<div class="form-group">
                                                        <label>اسم المدينة</label>
                                                        <div class="controls">
                                                            <input type="text"  id="name" name="name" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="اسم المدينة">
                                                        </div>
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
										   
										
											
                   <script type="text/javascript">

function dispalyData(elem){
  var id=$(elem).attr('data-id');
  var name=$(elem).attr('data-name');
  var statues=$(elem).attr('data-statues');
if(statues==1){
document.getElementById("statues").checked = true;
}else{
document.getElementById("statues").checked = false;	
}
  	 
     $('#id').val(id)
     $("#name").val(name)
     $("#statues").val(statues)
     $("#modal_edit").modal("show");
}

    
 </script>                