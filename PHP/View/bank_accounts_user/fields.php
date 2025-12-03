                     <input type="hidden" id="id" name="id">     
					   <div class="form-group">		  
                                                        <label> البنك </label>
                                                        <div class="controls">
												        <select name="bank_accounts_id" id="bank_accounts_id"  class="form-control">
														    <?php
											 if (isset($Display_bank_accounts))
                                          for ($i = 0; $i < count($Display_bank_accounts); $i++) {
                                            $bank_accounts_name=$Display_bank_accounts[$i]['account_name'];
                                            $bank_accounts_id=$Display_bank_accounts[$i]['id'];
                                            echo "<option value='$bank_accounts_id'>$bank_accounts_name </option>";
                                                }
                                         ?>
		                                                </select>
                                                        </div>
													</div>
                                                     <div class="form-label-group">
                                                        <input type="number" id="account_number"  name="account_number" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder="رقم الحساب">
                                                        <label for="account_number">رقم الحساب</label>
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
  var account_number=$(elem).attr('data-account_number');
  var statues=$(elem).attr('data-statues');
	
 var mySelect = document.getElementById('bank_accounts_id');
for(var i, j = 0; i = mySelect.options[j]; j++) {
    if(i.value == bank_accounts_id) {
        mySelect.selectedIndex = j;
        break;
    }
}
if(statues==1){
document.getElementById("statues").checked = true;
}else{
document.getElementById("statues").checked = false;	
}
  $('#id').val(id)
     $("#account_number").val(account_number)
    $("#modal_edit").modal("show");
}

    
 </script>                