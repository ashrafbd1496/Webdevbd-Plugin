(function ($) {
  $("table.wp-list-table.contacts").on("click", "a.submitdelete", function (e) {
    e.preventDefault();

    if (!confirm(WebDevBdAjx.confirm)) {
      return;
    }
    var self = $(this),
      id = self.data("id");

    // wp.ajax
    //   .send("webdevbd-delete-contact", {
    //     data: {
    //       id: id,
    //       _wpnonce: WebDevBdAjx.nonce,
    //     },
    //   })
    wp.ajax
      .post("webdevbd-delete-contact", {
        id: id,
        _wpnonce: WebDevBdAjx.nonce,
      })
      .done(function (response) {
        self
          .closest("tr")
          .css("background-color", "red")
          .hide(400, function () {
            $(this).remove();
          });
      })
      .fail(function () {
        alert(WebDevBdAjx.error);
      });
  });
})(jQuery);
