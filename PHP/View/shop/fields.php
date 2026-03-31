

<!-- حقل مخفي للمعرف -->
<input type="hidden" id="edit_id" name="id" value="">

<div class="form-label-group">
    <input type="text" id="edit_user_name" name="user_name" class="form-control" placeholder="اسم المستخدم" required>
    <label for="edit_user_name">اسم المستخدم</label>
</div> 

<div class="form-label-group">
    <input type="password" id="edit_password" name="password" class="form-control" placeholder="كلمة المرور" required>
    <label for="edit_password">كلمة المرور</label>
</div>

<div class="form-group">
    <div class="vs-checkbox-con vs-checkbox-success">
        <input type="checkbox" name="statues" id="edit_statues" value="1">
        <span class="vs-checkbox">
            <span class="vs-checkbox--check">
                <i class="vs-icon feather icon-check"></i>
            </span>
        </span>
        <label>الحالة (نشط)</label>
    </div>
</div>

<div class="form-label-group">
<input type="number" id="edit_rating_Admin" name="rating_Admin" class="form-control" placeholder="تقييم الخدمة" required>    <label for="edit_rating_Admin">تقييم الخدمة</label>
</div>

<div class="form-label-group">
    <input type="text" id="edit_name" name="name" class="form-control" placeholder="اسم المتجر" required>
    <label for="edit_name">اسم المتجر</label>
</div>

<div class="custom-file">
    <input type="file" name="imge" class="custom-file-input" id="edit_imge" accept="image/*">
    <label class="custom-file-label" for="edit_imge">الشعار</label>
</div>
<br/><br/>

<div class="form-label-group">
    <input type="number" id="edit_price" name="price" class="form-control" placeholder="سعر الحجز" required>
    <label for="edit_price">سعر الحجز</label>
</div>
<div class="form-label-group">
    <input type="number" id="edit_cut" name="cut" class="form-control" placeholder="مبلغ العربون" required>
    <label for="edit_cut">مبلغ العربون</label>
</div>
<div class="form-label-group">
    <input type="text" id="edit_latlng" name="latlng" class="form-control" placeholder="احداثيات الموقع" required>
    <label for="edit_latlng">احداثيات الموقع</label>
</div>

<div class="custom-file">
    <input type="file" name="url_profession_license" accept=".pdf" class="custom-file-input" id="edit_url_profession_license">
    <label class="custom-file-label" for="edit_url_profession_license">ترخيص مزاولة المهنة</label>
</div>

<div class="form-group">		  
    <label>المدينة</label>
    <div class="controls">
        <select name="city_id" id="edit_city_id" class="form-control">
            <option value="">اختر المدينة</option>
            <?php
            if (isset($Display_city) && is_array($Display_city)) {
                for ($i = 0; $i < count($Display_city); $i++) {
                    $city_name = $Display_city[$i]['name'];
                    $city_id = $Display_city[$i]['id'];
                    echo "<option value='$city_id'>$city_name</option>";
                }
            }
            ?>
        </select>
    </div>
</div>


<div class="form-group">		  
    <label>القسم</label>
    <div class="controls">
        <select name="section_id" id="edit_section_id" class="form-control" required>
            <option value="">اختر القسم</option>
            <?php
            if (isset($Display_section) && is_array($Display_section)) {
                for ($i = 0; $i < count($Display_section); $i++) {
                    $section_name = $Display_section[$i]['name'];
                    $section_id = $Display_section[$i]['id'];
                    echo "<option value='$section_id'>$section_name</option>";
                }
            }
            ?>
        </select>
    </div>
</div>

<div class="form-label-group">
    <input type="number" id="edit_phone" name="phone" class="form-control" required placeholder="رقم الجوال">
    <label for="edit_phone">رقم الجوال</label>
</div>

<div class="form-label-group">
    <input type="email" id="edit_email" name="email" class="form-control" placeholder="البريد الإلكتروني">
    <label for="edit_email">البريد الإلكتروني</label>
</div>

<div class="form-label-group">
    <input type="text" id="edit_address" name="address" class="form-control" placeholder="العنوان" required>
    <label for="edit_address">العنوان</label>
</div> 

<div class="form-label-group">
    <textarea class="form-control" id="edit_description" name="description" placeholder="ملاحظة" rows="3"></textarea>
    <label for="edit_description">ملاحظة</label>
</div>