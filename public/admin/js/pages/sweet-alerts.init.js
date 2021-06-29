!(function (t) {
    "use strict";
    function e() {}
    (e.prototype.init = function () {
      
            t(".sa-warning").click(function () {
                Swal.fire({
                    title: "Bạn có chắc muốn xóa?",
                    text: "Sau khi xóa sẽ không phục hồi được!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#1cbb8c",
                    cancelButtonColor: "#f14e4e",
                    confirmButtonText: "Vâng, hãy xóa!",
                }).then(function (t) {
                    t.value && Swal.fire("Thành công!", "Dữ liệu đã được xóa.", "success");
                });
            })
    }),
        (t.SweetAlert = new e()),
        (t.SweetAlert.Constructor = e);
})(window.jQuery),
    (function () {
        "use strict";
        window.jQuery.SweetAlert.init();
    })();
