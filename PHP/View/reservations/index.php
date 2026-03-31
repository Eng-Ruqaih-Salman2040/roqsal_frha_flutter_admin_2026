<?php include('update.php'); ?>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">حجوزات منتظرة</h2>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="?page1=Dashboard">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">فرحة</li>
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
                                <h4 class="card-title"></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <p class="card-text"></p>
                                    <div class="table-responsive">
                                        <table class="table zero-configuration table-striped table-bordered complex-headers">
                                            <thead>
                                                <tr>
                                                    <th>الرقم</th>
                                                    <th>اسم العميل</th>
                                                    <th>رقم الجوال</th>
                                                    <th>تاريخ الحجز</th>
                                                    <th>اسم الحساب</th>
                                                    <th>رقم السند</th>
                                                    <th>التفاصيل</th>
                                                    <?php
                                                    // تحديد عنوان العمود حسب نوع المستخدم
                                                    if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
                                                        echo "<th>عمليات المسؤول</th>";
                                                    } else {
                                                        echo "<th>عمليات مقدم الخدمة</th>";
                                                    }
                                                    ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php          
                                                if (isset($Display) && count($Display) > 0) {
                                                    for ($i = 0; $i < count($Display); $i++) {
                                                        $isAdmin = (isset($_SESSION['validity']) && $_SESSION['validity'] === "1");
                                                        
                                                        echo "<tr>
                                                            <td>{$Display[$i]['id']}</td>
                                                            <td>{$Display[$i]['name']}</td>
                                                            <td>{$Display[$i]['phone']}</td>
                                                            <td>{$Display[$i]['booking_date']}</td>
                                                            <td>{$Display[$i]['account_name']}</td>
                                                            <td>{$Display[$i]['bond_no']}</td>
                                                            <td>
                                                                <button data-toggle='modal' data-target='#modal_edit'
                                                                    data-placement='bottom' title='تعديل' class='btn btn-outline-success waves-effect waves-light'  
                                                                    onclick='dispalyData(this)' 
                                                                    data-id='{$Display[$i]['id']}' 
                                                                    data-name='{$Display[$i]['name']}' 
                                                                    data-phone='{$Display[$i]['phone']}' 
                                                                    data-booking_date='{$Display[$i]['booking_date']}' 
                                                                    data-account_name='{$Display[$i]['account_name']}' 
                                                                    data-bond_no='{$Display[$i]['bond_no']}' 
                                                                    data-note='{$Display[$i]['note']}'>
                                                                    <i class='fa fa-eye'>&nbsp;&nbsp;&nbsp;التفاصيل</i>
                                                                </button>
                                                            </td>";
                                                        
                                                        // عرض الأزرار حسب نوع المستخدم
                                                        if ($isAdmin) {
                                                            // أزرار المسؤول (للأدمن فقط)
                                                            echo "<td>
                                                                <div class='btn-group btn-group-sm'>
                                                                    <form class='form_Admin_Accept' method='POST' action=''> 
                                                                        <input type='hidden' name='id' value='{$Display[$i]['id']}'>
                                                                        <button type='submit' class='btn btn-info mr-1 mb-1' name='Accept_admin' onclick='return confirm(\"هل تريد تأكيد الحجز كمسؤول؟\");'>
                                                                            تأكيد المسؤول
                                                                        </button>
                                                                    </form>
                                                                    
                                                                    <form class='form_Admin_Delete' method='POST' action=''> 
                                                                        <input type='hidden' name='id' value='{$Display[$i]['id']}'>
                                                                        <button type='submit' class='btn btn-warning mr-1 mb-1' name='Delete_admin' onclick='return confirm(\"هل تريد رفض الحجز كمسؤول؟\");'>
                                                                            رفض المسؤول
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>";
                                                        } else {
                                                            // أزرار مقدم الخدمة (لمقدم الخدمة فقط)
                                                            echo "<td>
                                                                <div class='btn-group btn-group-sm'>
                                                                    <form class='form_Accept' method='POST' action=''> 
                                                                        <input type='hidden' name='id' value='{$Display[$i]['id']}'>
                                                                        <button type='submit' class='btn btn-success mr-1 mb-1' name='Accept_provider' onclick='return confirm(\"هل تريد تأكيد الحجز كمقدم خدمة؟\");'>
                                                                            تأكيد
                                                                        </button>
                                                                    </form>
                                                                    
                                                                    <form class='form_delete' method='POST' action=''> 
                                                                        <input type='hidden' name='id' value='{$Display[$i]['id']}'>
                                                                        <button type='submit' class='btn btn-danger mr-1 mb-1' name='Delete_provider' onclick='return confirm(\"هل تريد رفض الحجز كمقدم خدمة؟\");'>
                                                                            رفض
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>";
                                                        }
                                                        
                                                        echo "</tr>";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>الرقم</th>
                                                    <th>اسم العميل</th>
                                                    <th>رقم الجوال</th>
                                                    <th>تاريخ الحجز</th>
                                                    <th>اسم الحساب</th>
                                                    <th>رقم السند</th>
                                                    <th>التفاصيل</th>
                                                    <?php
                                                    // تحديد عنوان العمود في التذييل حسب نوع المستخدم
                                                    if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
                                                        echo "<th>عمليات المسؤول</th>";
                                                    } else {
                                                        echo "<th>عمليات مقدم الخدمة</th>";
                                                    }
                                                    ?>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
</div>