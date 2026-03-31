<?php 
$report_entity = isset($_POST['report_entity']) ? $_POST['report_entity'] : 'reservations';
$selected_status = isset($_POST['service_type']) ? $_POST['service_type'] : 'all';
$selected_shop_status = isset($_POST['shop_status']) ? $_POST['shop_status'] : 'all';

$selected_date_from = isset($_POST['date_from']) ? $_POST['date_from'] : '';
$selected_date_to = isset($_POST['date_to']) ? $_POST['date_to'] : '';

$report_title = 'تقرير شامل';
if ($report_entity == 'reservations') {
    $report_title = 'تقرير الحجوزات';
    if ($selected_status == '2') $report_title .= ' - الملغية';
    elseif ($selected_status == '1') $report_title .= ' - المؤكدة';
    elseif ($selected_status == '0') $report_title .= ' - قيد الانتظار';
} elseif ($report_entity == 'shop') {
    $report_title = 'تقرير الخدمات (المتاجر)';
    if ($selected_shop_status == '1') $report_title .= ' - المفعلة';
    elseif ($selected_shop_status == '0') $report_title .= ' - غير المفعلة';
} elseif ($report_entity == 'section') $report_title = 'تقرير الأقسام';
  elseif ($report_entity == 'city') $report_title = 'تقرير المدن';
  elseif ($report_entity == 'bank_accounts') $report_title = 'تقرير الحسابات البنكية';
  elseif ($report_entity == 'rating') $report_title = 'تقرير التقييمات';
  elseif ($report_entity == 'Technical_Support') $report_title = 'تقرير الدعم الفني';
  elseif ($report_entity == 'ads') $report_title = 'تقرير الإعلانات';
?>
<script>
    // تفريغ التواريخ عند تغيير الكيان ليعود الجدول نظيفاً
    function clearDatesAndSubmit(sel) {
        let frm = sel.form;
        frm.date_from.value = "";
        frm.date_to.value = "";
        frm.submit();
    }

    // تغيير عنوان المتصفح وملفات تصدير الـ PDF ليطابق نوع التقرير
    document.title = "<?php echo $report_title; ?> - لوحة تحكم فرحة";
</script>

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">التقارير</h2>
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
            <!-- نموذج الفلترة -->
            <section id="filter-form">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">فلترة التقرير</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="?page1=Reports" class="row">
                            <!-- فلتر التقرير الأساسي -->
                            <div class="col-md-3 mb-1">
                                <label class="form-label"> تقرير عن </label>
                                <select name="report_entity" class="form-select" onchange="clearDatesAndSubmit(this)" autocomplete="off">
                                    <option value="reservations" <?php echo ($report_entity == 'reservations') ? 'selected' : ''; ?>>الحجوزات</option>
                                    <option value="shop" <?php echo ($report_entity == 'shop') ? 'selected' : ''; ?>>الخدمات (المتاجر)</option>
                                    <option value="section" <?php echo ($report_entity == 'section') ? 'selected' : ''; ?>>الأقسام</option>
                                    <option value="bank_accounts" <?php echo ($report_entity == 'bank_accounts') ? 'selected' : ''; ?>>الحسابات البنكية</option>
                                    <option value="city" <?php echo ($report_entity == 'city') ? 'selected' : ''; ?>>المدن</option>
                                    <option value="rating" <?php echo ($report_entity == 'rating') ? 'selected' : ''; ?>>التقييمات</option>
                                    <option value="Technical_Support" <?php echo ($report_entity == 'Technical_Support') ? 'selected' : ''; ?>>الدعم الفني</option>
                                    <option value="ads" <?php echo ($report_entity == 'ads') ? 'selected' : ''; ?>>إعلانات التطبيق</option>
                                </select>
                            </div>

                            <!-- فلتر الحالات المعروض فقط عند الحاجة -->
                            <?php if ($report_entity == 'reservations'): ?>
                            <div class="col-md-3 mb-1">
                                <label class="form-label"> حالة الحجز </label>
                                <select name="service_type" class="form-select" onchange="this.form.submit()" autocomplete="off">
                                    <option value="all" <?php echo ($selected_status == 'all') ? 'selected' : ''; ?>>كل الحجوزات</option>
                                    <option value="2" <?php echo ($selected_status == '2') ? 'selected' : ''; ?>>ملغية</option>
                                    <option value="1" <?php echo ($selected_status == '1') ? 'selected' : ''; ?>>مؤكدة</option>
                                    <option value="0" <?php echo ($selected_status == '0') ? 'selected' : ''; ?>>قيد الانتظار</option>
                                </select>
                            </div>
                            <?php elseif ($report_entity == 'shop'): ?>
                            <div class="col-md-3 mb-1">
                                <label class="form-label"> حالة الخدمة </label>
                                <select name="shop_status" class="form-select" onchange="this.form.submit()" autocomplete="off">
                                    <option value="all" <?php echo ($selected_shop_status == 'all') ? 'selected' : ''; ?>>كل الخدمات</option>
                                    <option value="1" <?php echo ($selected_shop_status == '1') ? 'selected' : ''; ?>>خدمات مفعلة</option>
                                    <option value="0" <?php echo ($selected_shop_status == '0') ? 'selected' : ''; ?>>خدمات غير مفعلة</option>
                                </select>
                            </div>
                            <?php else: ?>
                            <!-- مساحة فارغة لموازنة الشكل للحالات التي لا تملك فلتر حالة -->
                            <div class="col-md-3 mb-1"></div>
                            <?php endif; ?>

                            <!-- فلاتر التواريخ المشتركة -->
                            <div class="col-md-3 mb-1">
                                <label class="form-label">من تاريخ</label>
                                <input type="date" name="date_from" value="<?php echo htmlspecialchars($selected_date_from); ?>" class="form-control" onchange="this.form.submit()">
                            </div>
                            <div class="col-md-3 mb-1">
                                <label class="form-label">إلى تاريخ</label>
                                <input type="date" name="date_to" value="<?php echo htmlspecialchars($selected_date_to); ?>" class="form-control" onchange="this.form.submit()">
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <!-- جدول التقرير -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title" style="font-size: 20px; font-weight: bold; color: #28c76f; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                                    <i class="feather icon-file-text"></i> <?php echo $report_title; ?>
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration table-striped table-bordered complex-headers" id="reportTable">
                                            <!-- Table Headers and Body dynamically injected depending on Report Entity -->
                                            <?php if ($report_entity == 'reservations'): ?>
                                                <thead>
                                                    <tr>
                                                        <th>رقم الحجز</th>
                                                        <th>اسم العميل</th>
                                                        <th>المتجر / القاعة</th>
                                                        <th>رقم الجوال</th>
                                                        <th>تاريخ الحجز</th>
                                                        <th>الحالة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($bookings) && count($bookings) > 0) {
                                                        foreach ($bookings as $b) {
                                                            $status_text = '<span class="badge badge-warning" style="font-size: 15px; padding: 10px;">قيد الانتظار</span>';
                                                            if ($b['reservation_status'] == 1) $status_text = '<span class="badge badge-success" style="font-size: 15px; padding: 10px;">مؤكدة</span>';
                                                            elseif ($b['reservation_status'] == 2) $status_text = '<span class="badge badge-danger" style="font-size: 15px; padding: 10px;">ملغية</span>';

                                                            echo "<tr>
                                                                <td>{$b['id']}</td>
                                                                <td>{$b['name']}</td>
                                                                <td>{$b['shop_name']}</td>
                                                                <td>{$b['phone']}</td>
                                                                <td>{$b['booking_date']}</td>
                                                                <td>{$status_text}</td>
                                                            </tr>";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            <?php elseif ($report_entity == 'shop'): ?>
                                                <thead>
                                                    <tr>
                                                        <th>الرقم</th>
                                                        <th>الاسم</th>
                                                        <th>الجوال</th>
                                                        <th>البريد</th>
                                                        <th>السعر</th>
                                                        <th>العنوان</th>
                                                        <th>الحالة</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($bookings) && count($bookings) > 0) {
                                                        foreach ($bookings as $b) {
                                                            $status_text = ($b['statues'] == 1) ? '<span class="badge badge-success" style="font-size: 14px;">مفعلة</span>' : '<span class="badge badge-danger" style="font-size: 14px;">غير مفعلة</span>';
                                                            echo "<tr>
                                                                <td>{$b['id']}</td>
                                                                <td>{$b['name']}</td>
                                                                <td>{$b['phone']}</td>
                                                                <td>{$b['email']}</td>
                                                                <td>{$b['price']}</td>
                                                                <td>{$b['address']}</td>
                                                                <td>{$status_text}</td>
                                                            </tr>";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            <?php else: ?>
                                                <?php
                                                // مصفوفة ذكية لترجمة أسماء الأعمدة في التقارير العامة المتغيرة
                                                $ar_columns = [
                                                    'id' => 'الرقم',
                                                    'name' => 'الاسم',
                                                    'imge' => 'الصورة',
                                                    'image' => 'الصورة',
                                                    'note' => 'ملاحظات',
                                                    'date_create' => 'تاريخ الإنشاء',
                                                    'time_create' => 'وقت الإنشاء',
                                                    'phone' => 'الجوال',
                                                    'email' => 'البريد الإلكتروني',
                                                    'address' => 'العنوان',
                                                    'price' => 'السعر',
                                                    'status' => 'الحالة',
                                                    'statues' => 'الحالة',
                                                    'account_name' => 'اسم الحساب',
                                                    'subject' => 'الموضوع',
                                                    'message' => 'الرسالة',
                                                    'sort' => 'الترتيب',
                                                    'rating_value' => 'التقييم',
                                                    'review_comment' => 'التعليق',
                                                    'created_time' => 'تاريخ التقييم',
                                                    'customer_name' => 'اسم العميل',
                                                    'shop_id' => 'رقم المتجر',
                                                    'rating_id' => 'رقم التقييم'
                                                ];
                                                ?>
                                                <!-- Dynamic Table for general views (Section, City, Ads, etc.) -->
                                                <thead>
                                                    <tr>
                                                    <?php if(isset($bookings) && count($bookings) > 0): ?>
                                                        <?php foreach (array_keys($bookings[0]) as $k): ?>
                                                            <?php 
                                                            if (!is_numeric($k)) {
                                                                $ar_name = isset($ar_columns[$k]) ? $ar_columns[$k] : ucfirst($k);
                                                                echo "<th>" . $ar_name . "</th>"; 
                                                            } 
                                                            ?>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <th>لا توجد بيانات</th>
                                                    <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($bookings) && count($bookings) > 0) {
                                                        foreach ($bookings as $b) {
                                                            echo "<tr>";
                                                            foreach ($b as $k => $v) {
                                                                if (!is_numeric($k)) {
                                                                    // معالجة عرض الصور في الجداول المبسطة
                                                                    if (strpos($k, 'imge') !== false || strpos($k, 'image') !== false) {
                                                                        // استخدام basename يستخرج اسم الصورة الصافي حتى لو كانت مخزنة بمسار خاطئ
                                                                        $clean_img = basename($v);
                                                                        echo "<td><img src='../../image/{$clean_img}' alt='صورة' width='50' height='50' style='object-fit:cover; border-radius:5px;'></td>";
                                                                    } 
                                                                    // معالجة الأرقام 0 و 1 لتحويلها إلى حالة مفعل/غير مفعل في كل التقارير تلقائياً
                                                                    elseif (($k == 'status' || $k == 'statues') && ($v == '1' || $v == '0')) {
                                                                        $st = ($v == 1) ? '<span class="badge badge-success">مفعلة</span>' : '<span class="badge badge-danger">غير مفعلة</span>';
                                                                        echo "<td>{$st}</td>";
                                                                    } 
                                                                    else {
                                                                        echo "<td>{$v}</td>";
                                                                    }
                                                                }
                                                            }
                                                            echo "</tr>";
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            <?php endif; ?>
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

<style>
    /* ضمان الحفاظ على لوني الأحمر والأخضر حتى مع تفعيل الـ Dark Mode */
    .custom-excel-btn {
        background-color: #28c76f !important;
        border-color: #28c76f !important;
        color: #ffffff !important;
    }
    .custom-print-btn {
        background-color: #ea5455 !important;
        border-color: #ea5455 !important;
        color: #ffffff !important;
    }
</style>

<!-- DataTables + Export Buttons -->
        <script src="../../app-assets/vendors/js/vendors.min.js"></script>
        <!-- مكتبة JSZip الضرورية لتصدير الإكسل -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
        <script src="../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>

 <script>
// كود ذكي لمنع إعادة إرسال الفلتر القديم عند تحديث الصفحة (F5)، ليعود الفلتر لـ "كل الحجوزات"
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

$(document).ready(function() {
    $('#reportTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { 
                extend: 'excelHtml5', 
                text: 'Excel',
                className: 'btn btn-sm custom-excel-btn', // لون أخضر مع تصغير
                exportOptions: {
                    columns: ':visible' // تصدير كل الأعمدة المرئية فقط
                }
            },
            { 
                extend: 'print', 
                text: 'طباعة',
                className: 'btn btn-sm custom-print-btn', // لون أحمر مع تصغير
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        language: {
            "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
            "sLoadingRecords": "جارٍ التحميل...",
            "sProcessing": "جارٍ المعالجة...",
            "sLengthMenu": "أظهر _MENU_ مدخلات",
            "sZeroRecords": "لم يعثر على أية سجلات",
            "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered": "(منتقاة من مجموع _MAX_ مدخل)",
            "sSearch": "ابحث:",
            "oPaginate": {
                "sFirst": "الأول",
                "sPrevious": "السابق",
                "sNext": "التالي",
                "sLast": "الأخير"
            }
        }
    });
});
</script>
