;(function ($) {
  "use strict"

  jQuery(document).ready(function ($) {
    $("#publish").on("click", function (e) {
      let title = $("#post").find('input[name="post_title"]').val()
      let phone = $("#post").find('input[name="alfasoftphone"]').val()

      if (title.length < 5) {
        e.preventDefault()
        alert("Please Enter Title More Than 5 Character")
      } else if (phone.length != 9) {
        e.preventDefault()
        alert("Please Enter Valid Phone")
      } else {
        return
      }
    })
    getCountry()

    // Call The API
    function getCountry() {
      const api = "https://restcountries.com/v3.1/all"
      fetch(api)
        .then(function (response) {
          return response.json()
        })
        .then(function (data) {
          data.forEach(function (item) {
            $("#alfasoftcountry").append(
              `<option value='${item.name.common}(${item.ccn3})'>${item.name.common}(${item.ccn3})</option>`
            )
          })
        })
        .catch(function (err) {
          console.log(err)
        })
    }
  })
})(jQuery)
