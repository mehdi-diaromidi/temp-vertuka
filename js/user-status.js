jQuery(document).ready(function ($) {
  // تابع برای چک کردن وضعیت کاربر
  function checkUserStatus() {
    // چک کردن وجود کلید در Local Storage
    const storedUserStatus = localStorage.getItem("user_status");

    if (storedUserStatus !== null) {
      // اگر کلید موجود باشد، از آن استفاده می‌کنیم
      const userLoginStatus = JSON.parse(storedUserStatus);

      if (userLoginStatus.user_login) {
        $(".user-status-set").html(`
                    <div class="mr-12">
                        <a class="button secondary" href="/my-account/">
                            <span class="">پروفایل کاربری</span>
                        </a>
                    </div>
                `);
        console.log("User is logged in (from Local Storage)");
      } else {
        $(".user-status-set").html(`
                    <div class="mr-12">
                        <a class="button secondary" href="/login/">
                            <span class="">ورود به پنل کاربری</span>
                        </a>
                    </div>
                    <div class="mr-12">
                        <a class="button bg-success text-white" href="/register/">
                            <span class="">ثبت نام</span>
                        </a>
                    </div>
                `);
        console.log("User is not logged in (from Local Storage)");
      }
    } else {
      // اگر کلید موجود نباشد، درخواست AJAX ارسال می‌شود
      $.ajax({
        url: wc_ls_ajax.wc_ls_ajaxurl,
        type: "POST",
        dataType: "JSON",
        data: {
          action: "user_status_set",
          _nonce: wc_ls_ajax._wc_ls_nonce,
        },
        beforeSend: function () {},
        success: function (response) {
          if (response.user_login) {
            $(".user-status-set").html(`
                            <div class="mr-12">
                                <a class="button secondary" href="/my-account/">
                                    <span class="">پروفایل کاربری</span>
                                </a>
                            </div>
                        `);
            console.log("User is logged in (from AJAX)");

            // ذخیره وضعیت کاربر در Local Storage
            localStorage.setItem("user_status", JSON.stringify(response));
          } else {
            $(".user-status-set").html(`
                            <div class="mr-12">
                                <a class="button secondary" href="/login/">
                                    <span class="">ورود به پنل کاربری</span>
                                </a>
                            </div>
                            <div class="mr-12">
                                <a class="button bg-success text-white" href="/register/">
                                    <span class="">ثبت نام</span>
                                </a>
                            </div>
                        `);
            console.log("User is not logged in (from AJAX)");

            // ذخیره وضعیت کاربر در Local Storage
            localStorage.setItem("user_status", JSON.stringify(response));
          }
        },
        error: function (error) {
          console.log("Error:", error);
        },
        complete: function () {},
      });
    }
  }

  // تابع برای پاک کردن Local Storage برای صفحات مشخص
  function clearLocalStorageForSpecificPages() {
    const currentUrl = window.location.href;

    // لیست صفحاتی که باید Local Storage پاک شود
    const pagesToClearStorage = [
      "https://vertuka.com/login/",
      "https://vertuka.com/register/",
      "https://vertuka.com/member-authenticate/",
    ];

    // چک کردن آیا آدرس فعلی در لیست صفحات است
    if (pagesToClearStorage.includes(currentUrl)) {
      console.log("Clearing Local Storage for specific pages.");
      localStorage.removeItem("user_status"); // پاک کردن کلید user_status
    }
  }

  // صدا زدن تابع برای چک کردن وضعیت کاربر
  checkUserStatus();

  // صدا زدن تابع برای پاک کردن Local Storage
  clearLocalStorageForSpecificPages();
});
