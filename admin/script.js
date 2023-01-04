$(document).ready(function(){
  var target_name;
  
  $('.import-button').click(function(){
    $('#importModal').show();
  })
  
  $('.create-room').click(function(){
    $('#createRoomModal').show();
  })

  $('.change-password-button').click(function(){
    $('#change-password').show();
    
    var target = $(this).attr('id');
    var input_element = $('#new-password');
    target_name = $(this).parent().parent().attr('title');

    input_element.val(target)
  })

  $("#changePasswordForm").submit(function(event){
    event.preventDefault();

    $.ajax({
      type: 'post',
      url: 'changepassword.php',
      data: {
        target: target_name,
        newPassword: $('#new-password').val()
      },
      success: function(response){
        console.log(response);
        $('#changePasswordForm')[0].reset();

        alert('Password Change Successfully');
        
        $('#change-password').hide();
      }
    })
  })

  $('.singe-data-button-student').click(function(){
    $('#single-student').show();
  })

  $('.singe-data-button-teacher').click(function(){
    $('#single-teacher').show();
  })

  $('.change-picture').click(function(){
    $('#pictureModal').show();
  })

  $('.openNotif').click(function(){
    $('.notifications').show();
  })

  $('.close').click(function(){
    $(this).parent().parent().parent().hide();
  })

  $("input[name='coord']").keyup(function(){
    let keyword = $(this).val();
    if(keyword != ''){
      $.ajax({
        type: 'post',
        url: 'selectAllTeacher.php',
        data: {
          keyword: keyword
        },
        success: function(response){
          $('.advisers').show();
          $('.advisers').html(response);
        }
      })
    }else {
      $('.advisers').hide();
    }
  })

  $("input[name='keyword']").keyup(function(){
    let keyword = $(this).val();
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const table = urlParams.get('table')

    if(keyword != ''){
      $.ajax({
        type: 'post',
        url: 'search.php',
        data: {
          keyword: keyword,
          table: table
        },
        success: function(response){
          $('#customers').html(response);
        }
      })
    }
  })

  $(".delete-button").click(function(){
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const table = urlParams.get('table')
    
    let current_element = $(this);
    let selected = $(this).attr('id');
    let all_record = [];

    all_record.push(selected);

    $.ajax({
      type: 'post',
      url: 'delete.php',
      data: {
        records: all_record,
        table: table
      },
      success: function(response){
        $(current_element).parent().parent().fadeOut();
        // console.log(response)
      }
    })
  })

  
})

function setCoord(target){
  $('.advisers').hide();
  $("input[name='coord']").val(target);
}

function addStudents(target){
  $('.advisers').hide();
  let student = "<input name='student[]' value='"+target+"' readonly>";
  
  $('.student-list').append(student);
}

function seeStudents(target){
  $.ajax({
    type: 'post',
    url: 'seeAllStudents.php',
    data: {
      room_id: target
    },
    success: function(response){
      $('#viewStudents').show();
      $('.all-students').html(response);
    } 
  })
}