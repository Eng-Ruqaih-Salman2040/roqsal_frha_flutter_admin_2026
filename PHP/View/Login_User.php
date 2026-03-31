<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/pages/authentication.css">
</head>

<body class="vertical-layout vertical-menu-modern 1-column bg-full-screen-image blank-page">
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="../../app-assets/images/pages/login.png" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">تسجيل الدخول</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">مرحبًا بك من جديد ، يرجى تسجيل الدخول إلى حسابك.</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                             <form action="" method="post">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="text" name="userName" class="form-control" id="user-name" placeholder="اسم المستخدم" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">اسم المستخدم</label>
                                                    </fieldset>

                                                    <!-- ✅ كلمة المرور مع التشيك بوكس داخل الحقل -->
                                                    <div class="input-group mb-1">
                                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="كلمة المرور" required>
                                                        <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                <input type="checkbox" id="showPassword" onclick="togglePassword()">
                                                            </div>
                                                        </div>
                                                    </div>
<div class="form-group d-flex justify-content-between align-items-center mt-1">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">تذكرنى</span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex justify-content-center mt-2">
                                                        <button type="submit" name="login" value="login" class="btn btn-primary btn-block" style="max-width:220px;">تسجيل الدخول</button>
                                                    </div>
                                                </form>
                                                    </div>
                                        </div>
                                        <div class="login-footer">
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

    <!-- ✅ سكربت إظهار/إخفاء كلمة المرور -->
    <script>
    function togglePassword() {
        var passwordField = document.getElementById("user-password");
        var checkbox = document.getElementById("showPassword");

        if (checkbox.checked) {
            passwordField.type = "text";   // يظهر كلمة السر
        } else {
            passwordField.type = "password"; // يخفي كلمة السر
        }
    }
    </script>

    <script src="../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../app-assets/js/core/app-menu.js"></script>
    <script src="../../app-assets/js/core/app.js"></script>
    <script src="../../app-assets/js/scripts/components.js"></script>
</body>
</html>
