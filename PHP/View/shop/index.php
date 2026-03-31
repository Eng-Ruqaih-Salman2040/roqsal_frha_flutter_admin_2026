<?php
include('update.php'); 
include('add.php'); 
?>	

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">بيانات المتاجر</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="?page1=Dashboard">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">المتاجر</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-body">
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#defaultSize">
                                        اضافة متجر جديد
                                    </button>
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration table-striped table-bordered complex-headers">
                                            <thead>
                                                <tr>
                                                    <th>الرقم</th>
                                                    <th>اسم المستخدم</th>
                                                    <th>الشعار</th>
                                                    <th>الاسم</th>
                                                    <th>القسم</th>
                                                    <th>تقييم مبدائي</th>
                                                    <th>رقم الجوال</th>
                                                    <th>البريد</th>
                                                    <th>السعر</th>
                                                    <th>مبلغ العربون</th>
                                                    <th>احداثيات الموقع</th>
                                                    <th>الترخيص</th>
                                                    <th>الحالة</th>
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php          
                                                if (isset($Display) && is_array($Display) && count($Display) > 0) {
                                                    for ($i = 0; $i < count($Display); $i++) {
                                                        // تحديد حالة المتجر
                                                        if($Display[$i]['statues'] == "0"){
                                                            $statues = "<button type='button' class='btn btn-danger mr-1 mb-1'>موقف</button>";
                                                        } elseif($Display[$i]['statues'] == "1") {
                                                            $statues = "<button type='button' class='btn btn-success mr-1 mb-1'>مفعل</button>";
                                                        } elseif($Display[$i]['statues'] == "2") {
                                                            $statues = "<button type='button' class='btn btn-warning mr-1 mb-1'>قيد الإنتظار</button>";
                                                        } else {
                                                            $statues = "<button type='button' class='btn btn-secondary mr-1 mb-1'>غير محدد</button>";
                                                        }
                                                        
                                                        $row_id = $i + 1;
                                                        echo "<tr>
                                                            <td>{$row_id}</td>
                                                            <td>{$Display[$i]['user_name']}</td>
                                                            <td><img style='height:35px; width:35px;' class='img_doc_display' src='../../image/shop/{$Display[$i]['image']}'></td>
                                                            <td>{$Display[$i]['name']}</td>
                                                            <td>{$Display[$i]['section_name']}</td>
                                                            <td>{$Display[$i]['rating_Admin']}⭐</td>
                                                            <td>{$Display[$i]['phone']}</td>
                                                            <td>{$Display[$i]['email']}</td>
                                                            <td>{$Display[$i]['price']}</td>
                                                            <td>{$Display[$i]['cut']}</td>
                                                            <td>{$Display[$i]['latlng']}</td>
                                                            <td><a href='https://localhost:81/C:/xampp/htdocs/roqsal_frha_flutter_admin_2026/pdf/profession_license/{$Display[$i]['profession_license']}' target='_blank'><button type='button' class='btn btn-outline-success mr-1 mb-1'>عرض</button></a></td>
                                                            <td>{$statues}</td>
                                                            <td>
                                                                <div class='btn-group btn-group-sm'>
                                                                    <!-- ✅ زر التعديل مع جميع البيانات -->
                                                                    <button data-toggle='modal' data-target='#modal_edit'
                                                                        data-placement='bottom' title='تعديل' class='btn btn-link'  
                                                                        onclick='dispalyData(this)' 
                                                                        data-id='{$Display[$i]['id']}'
                                                                        data-user_name='{$Display[$i]['user_name']}'
                                                                        data-password='{$Display[$i]['password']}'
                                                                        data-section_id='{$Display[$i]['section_id']}'
                                                                        data-rating_Admin='{$Display[$i]['rating_Admin']}'
                                                                        data-city_id='{$Display[$i]['city_id']}'
                                                                        data-address='{$Display[$i]['address']}'
                                                                        data-name='{$Display[$i]['name']}'
                                                                        data-phone='{$Display[$i]['phone']}'
                                                                        data-email='{$Display[$i]['email']}'
                                                                        data-price='{$Display[$i]['price']}'
                                                                        data-cut='{$Display[$i]['cut']}'
                                                                        data-latlng='{$Display[$i]['latlng']}'
                                                                        data-description='{$Display[$i]['description']}'
                                                                        data-statues='{$Display[$i]['statues']}'>
                                                                        <i class='fa fa-edit'></i>
                                                                    </button>
                                                                    <form class='form_delete' method='POST' action='' style='display: inline;'>
                                                                        <input type='hidden' name='id' value='{$Display[$i]['id']}'>
                                                                        <button type='submit' name='Delete' class='btn btn-link text-danger' onclick='return confirm(\"هل أنت متأكد من الحذف؟\");'>
                                                                            <i class='fa fa-trash'></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='11' class='text-center'>لا توجد بيانات</td></tr>";
                                                }
                                                ?>			
                                            </tbody>
                                            <thead>
                                                <tr>
                                                    <th>الرقم</th>
                                                    <th>اسم المستخدم</th>
                                                    <th>الشعار</th>
                                                    <th>الاسم</th>
                                                    <th>القسم</th>
                                                    <th>تقييم مبدائي</th>
                                                    <th>رقم الجوال</th>
                                                    <th>البريد</th>
                                                    <th>السعر</th>
                                                    <th>مبلغ العربون</th>
                                                    <th>احداثيات الموقع</th>
                                                    <th>الترخيص</th>
                                                    <th>الحالة</th>
                                                    <th>العمليات</th>
                                                </tr>
                                            </thead>
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

<!-- ✅ دالة JavaScript المحدثة -->
<script type="text/javascript">
function dispalyData(elem) {
    // قراءة البيانات من الزر
    var id = $(elem).data('id');
    var user_name = $(elem).data('user_name');
    var password = $(elem).data('password');
    var city_id = $(elem).data('city_id');
    var section_id = $(elem).data('section_id');
    var name = $(elem).data('name');
    var phone = $(elem).data('phone');
    var email = $(elem).data('email');
    var price = $(elem).data('price');
    var description = $(elem).data('description');
    var address = $(elem).data('address');
    var statues = $(elem).data('statues');
    var rating_Admin = $(elem).data('rating_admin');  
    var cut = $(elem).data('cut');  
    var latlng = $(elem).data('latlng');  
    
    // للتأكد من البيانات
    console.log("البيانات المستلمة:", {
        id: id,
        section_id: section_id,
        city_id: city_id,
        name: name
    });
    
    // تعبئة الحقول
    $('#edit_id').val(id);
    $("#edit_user_name").val(user_name);
    $("#edit_password").val(password);
    $("#edit_name").val(name);
    $("#edit_phone").val(phone); 	 
    $("#edit_email").val(email);
    $("#edit_price").val(price);	 
    $("#edit_description").val(description);	  
    $("#edit_address").val(address);
    $("#edit_rating_Admin").val(rating_Admin);	 
    $("#edit_cut").val(cut);	 
    $("#edit_latlng").val(latlng);	 
   	 

    // تعبئة المدينة
    if ($('#edit_city_id').length > 0) {
        $('#edit_city_id').val(city_id);
    }

    // ✅ تعبئة القسم - هذا هو الجزء المهم
    if ($('#edit_section_id').length > 0) {
        $('#edit_section_id').val(section_id);
    }

    // تعبئة checkbox
    if(statues == 1) {
        $("#edit_statues").prop('checked', true);
    } else {
        $("#edit_statues").prop('checked', false);	
    }

    $("#modal_edit").modal("show");
}
</script>

<!-- مودال التعديل -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel18">تعديل بيانات المتجر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="index.php?page1=shop" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include('fields.php'); ?>	
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" name="Update" class="btn btn-primary">تحديث البيانات</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- مودال الإضافة -->
<div class="modal fade" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel18">اضافة متجر جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="index.php?page1=shop" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <?php include('fields.php'); ?>	
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" name="Add" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// للتأكد من تحميل الصفحة بشكل صحيح
$(document).ready(function() {
    console.log("صفحة المتاجر تم تحميلها بنجاح");
});
</script>
