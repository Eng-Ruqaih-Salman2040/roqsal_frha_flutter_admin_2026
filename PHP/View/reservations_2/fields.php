                     <input type="hidden" id="id" name="id"> 
   <div class="form-label-group">
        <input type="text" id="name"  readonly="true" style="border: none; background: transparent;" class="form-control">
        <label for="name">اسم العميل</label>
  </div> 
   <div class="form-label-group">
        <input type="text" id="phone"  readonly="true" style="border: none; background: transparent;" class="form-control">
        <label for="phone">رقم الجوال</label>
  </div> 
   <div class="form-label-group">
        <input type="text" id="booking_date"  readonly="true" style="border: none; background: transparent;" class="form-control">
        <label for="booking_date">تاريخ الحجز</label>
  </div> 
   <div class="form-label-group">
        <input type="text" id="account_name"  readonly="true" style="border: none; background: transparent;" class="form-control">
        <label for="account_name">اسم الحساب</label>
  </div> 
   <div class="form-label-group">
        <input type="text" id="bond_no"  readonly="true" style="border: none; background: transparent;" class="form-control">
        <label for="bond_no">رقم السند</label>
  </div> 
  
			 <div class="form-group">
                                            <label>ملاحظة</label>
                                            <textarea class="form-control"  readonly="true" style="border: none; background: transparent;" id="note" name="note" rows="3"></textarea>
                                        </div>  
				
                   <script type="text/javascript">

				   
function dispalyData(elem){
 var id=$(elem).attr('data-id');
  var name=$(elem).attr('data-name');
  var phone=$(elem).attr('data-phone');
   var booking_date=$(elem).attr('data-booking_date');
   var account_name=$(elem).attr('data-account_name');
   var bond_no=$(elem).attr('data-bond_no');
   var note=$(elem).attr('data-note');
 
     $('#id').val(id)
     $("#name").val(name)
     $("#phone").val(phone)
     $("#booking_date").val(booking_date)
     $("#account_name").val(account_name)
     $("#bond_no").val(bond_no)
     $("#note").val(note)
    
 $('#modal_edit').modal('show'); 
 }

    
 </script>                