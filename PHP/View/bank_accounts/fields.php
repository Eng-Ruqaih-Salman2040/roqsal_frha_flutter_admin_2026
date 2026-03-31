                     <input type="hidden" id="id" name="id">     
                                                    <div class="form-label-group">
                                                        <input type="text" id="account_name" name="account_name" class="form-control" placeholder="اسم الحساب" required>
                                                        <label for="account_name">اسم الحساب</label>
                                                    </div> 
                                                    <div class="form-label-group">
                                                        <input type="number" id="number_bank_accounts" name="number_bank_accounts" class="form-control" placeholder="رقم الحساب" required>
                                                        <label for="number_bank_accounts">رقم الحساب</label>
                                                    </div>
	   
													    <div class="custom-file">
                                                         <input type="file" name="imge" class="custom-file-input" id="imge">
                                                         <label class="custom-file-label" accept="image/*" for="chooseFile">الشعار</label>
                                                    </div>
													
												
                                                    <script type="text/javascript">
function dispalyData(elem){
    var id = $(elem).attr('data-id');
    var account_name = $(elem).attr('data-account_name');
    var number_bank_accounts = $(elem).attr('data-number_bank_accounts');
    
    $('#id').val(id);
    $("#account_name").val(account_name);
    $("#number_bank_accounts").val(number_bank_accounts);
    
    $("#modal_edit").modal("show");
}
</script>   
