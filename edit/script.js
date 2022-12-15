$(document).ready(function(){
  $('.profile-image').click(function(){
    $('#image_upload').click();
  })

  $('#image_upload').change(function(){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
      var reader = new FileReader();
      reader.onload = function(){
        $(".profile-image").attr("src", reader.result);
      }
      reader.readAsDataURL(file);
    }
  })
})