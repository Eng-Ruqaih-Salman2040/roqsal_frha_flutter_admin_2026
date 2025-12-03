                     <input type="hidden" id="id" name="id">     
                                                    <div class="form-label-group">
                                                        <input type="text" id="account_name" name="account_name" class="form-control" placeholder="اسم الحساب" required>
                                                        <label for="account_name">اسم الحساب</label>
                                                    </div> 
											    
	   
													    <div class="custom-file">
                                                         <input type="file" name="imge" class="custom-file-input" id="imge">
                                                         <label class="custom-file-label" accept="image/*" for="chooseFile">الشعار</label>
                                                    </div>
													
												
			       <script type="text/javascript">

function dispalyData(elem){

  var id=$(elem).attr('data-id');
  var account_name=$(elem).attr('data-account_name');
 
     $('#id').val(id)
     $("#account_name").val(account_name)
    
    $("#modal_edit").modal("show");
}

    
 </script>                