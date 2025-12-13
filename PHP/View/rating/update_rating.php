      <!-- Modal -->
      <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel18">الإبلاغ عن تقييم</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
														      <form method="POST" action="index.php?page1=rating" enctype="multipart/form-data" role="form" novalidate>
							  <div class="data-items pb-3">
                                <div class="data-fields px-2 mt-3">
                                    <div class="row">
                                        <div class="col-sm-12 data-field-col">
										<div class="form-group">
			                                            <div class="vs-checkbox-con vs-checkbox-success">
                                                        <input type="checkbox"  name="reported" id="reported">
                                                        <span class="vs-checkbox">
                                                            <span class="vs-checkbox--check">
                                                                <i class="vs-icon feather icon-check"></i>
                                                            </span>
                                                        </span>
														 <label>الحالة</label>
                                                        
                                                    </div>
                                                    </div>  
                                   	<?php
       include('fields_rating.php'); 
	  
?>	
								  </div>
                                </div>
                            </div>
      
                        </div>
						         
                                                    
                                                               
                                                            
                                                    </div>
                                                    <div class="modal-footer">
													       <button type="submit" name="Update"  class="btn btn-primary">إبلاغ</button>
                                     </div>
									     </form>
                                                </div>
                                            </div>
                                        </div>





									