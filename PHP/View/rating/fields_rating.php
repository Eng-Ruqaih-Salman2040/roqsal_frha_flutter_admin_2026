                     <input type="hidden" id="id" name="id">                                      
		

                                                        
							 							
										   
										
											
                   <script type="text/javascript">

function dispalyData(elem){
  var id=$(elem).attr('data-id');
  var reported=$(elem).attr('data-status');
if(reported==1){
document.getElementById("reported").checked = true;
}else{
document.getElementById("reported").checked = false;	
}
  	 
     $('#id').val(id)
     $("#reported").val(reported)
    //  $("#modal_edit").modal("show");
}

    
 </script>                