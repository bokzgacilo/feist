$(document).ready(function(){
  $('.add-member').click(function(){
    $('#add-member').css('display', 'flex');
  })

  $('#search_student').keyup(function(){
    var keyword = $(this).val();

    $.ajax({
      type: 'post',
      url: 'search_student.php',
      data: {keyword : keyword},
      success: function(response){
        $('.search-result').html(response)
      }
    })
  })

  $('.close').click(function(){
    $(this).parent().parent().parent().css('display', 'none');
  })
})

