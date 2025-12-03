
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">التقييمات </h2>
                            <div class="breadcrumb-wrapper col-12">
                     
           <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?page1=Dashboard">لوحة التحكم</a>
                                    </li>
                                    <li class="breadcrumb-item active">فرحة
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
            <div class="content-body">

                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">   

									</h4>
                                </div>
                                <div class="card-content">
								                 

    
                                     <div  class="card-body card-dashboard">
                                        <p class="card-text"></p>
                                        <div class="table-responsive">
                                          
                       <table class="table zero-configuration 
											 table-striped table-bordered complex-headers">
				
                                                <thead>
                                                    <tr>		   
			    <th>الرقم</th>
                <th>اسم العميل</th>
                <th> التقييم</th>
			    <th> تاريخ التقييم </th>
			    <th> ملاحظة التقييم </th>
			    
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($ratings)): ?>
    <?php foreach($ratings as $rate): ?>
        <tr>
            <td><?= htmlspecialchars($rate['rating_id']) ?></td>
            <td><?= htmlspecialchars($rate['customer_name']) ?></td>
            <td><?= htmlspecialchars($rate['rating_value']) ?>⭐⭐⭐⭐</td>
            <td><?= htmlspecialchars($rate['created_time']) ?></td>
            <td><?= htmlspecialchars($rate['review_comment']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4" style="text-align:center;">لا توجد تقييمات حالياً</td>
    </tr>
<?php endif; ?>


											   </tbody>
                                                <tfoot>

                                                </tfoot>
                                            </table>
											</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
              
               
            
            
            </div>
        </div>
    </div>