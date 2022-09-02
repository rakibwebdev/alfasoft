;(function ($) {
  "use strict"

  jQuery(document).ready(function ($) {
    $("#publish").on("click", function (e) {
      let title = $("#post").find('input[name="post_title"]').val()

      if (title.length < 5) {
        e.preventDefault()
        alert("Please Enter Title More Than 5 Character")
      } else {
        return
      }
    })
  })
})(jQuery)
