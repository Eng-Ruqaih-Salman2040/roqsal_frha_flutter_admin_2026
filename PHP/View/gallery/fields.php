                     <input type="hidden" id="id" name="id">                                      
		

                                                        
							 							
										   
										
											
                   <script type="text/javascript">

function dispalyData(elem){
  var id=$(elem).attr('data-id');
  var status=$(elem).attr('data-status');
if(status==1){
document.getElementById("status").checked = true;
}else{
document.getElementById("status").checked = false;	
}
  	 
     $('#id').val(id)
     $("#statues").val(statues)
     $("#modal_edit").modal("show");
}

    
 </script>                