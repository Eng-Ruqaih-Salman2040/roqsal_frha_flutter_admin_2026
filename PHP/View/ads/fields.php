                     <input type="hidden" id="id" name="id">     
                                                	<div class="form-label-group">
                                                        <textarea class="form-control"  id="note" name="note" placeholder=" ملاحظة" rows="3" required></textarea>
                                                        <label for="note">ملاحظة</label>
                                                    </div>
												   <div class="custom-file">
                                                         <input type="file" name="imge" class="custom-file-input" id="imge"required>
                                                         <label class="custom-file-label" accept="image/*" for="chooseFile" >صورة</label>
                                                    </div>
			       <script type="text/javascript">

function dispalyData(elem){

  var id=$(elem).attr('data-id');
  var note=$(elem).attr('data-note');
     $('#id').val(id)
     $("#note").val(note)

    $("#modal_edit").modal("show");
}

    
 </script>                