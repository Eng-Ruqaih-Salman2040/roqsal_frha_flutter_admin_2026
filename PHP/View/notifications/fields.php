                     <input type="hidden" id="id" name="id">                                      
			 <div class="form-group">
                                            <label>الاشعار</label>
                                            <textarea class="form-control"  id="note" name="note" placeholder=" الاشعار" rows="5" required></textarea>
                                        </div>  
				
                   <script type="text/javascript">

				   
function dispalyData(elem){
 var id=$(elem).attr('data-id');
  var note=$(elem).attr('data-note');
 
     $('#id').val(id)
     $("#note").val(note)
    
 $('#modal_edit').modal('show'); 
 }

    
 </script>                