! function() {
    "use strict";
    window.copyBPlAdminShortcode = function(e) {
        var o = document.querySelector("#bPlAdminShortcode-" + e + " input"),
            n = document.querySelector("#bPlAdminShortcode-" + e + " .tooltip");
        o.select(), o.setSelectionRange(0, 30), document.execCommand("copy"), n.innerHTML = wp.i18n.__("Copied Successfully!", "store-finder"), setTimeout((function() {
            n.innerHTML = wp.i18n.__("Copy To Clipboard", "store-finder")
        }), 1500)
    }
}();