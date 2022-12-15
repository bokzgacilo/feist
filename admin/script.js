$(document).ready(function(){

  
  $('.import-button').click(function(){
    $('#importModal').show();
  })
  
  $('.create-room').click(function(){
    $('#createRoomModal').show();
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

    let selected_record = [];

    $.each($("input[name='select[]']:checked"), function(){
      selected_record.push($(this).val());
    });

    console.log(selected_record)

    $.ajax({
      type: 'post',
      url: 'delete.php',
      data: {
        records: selected_record,
        table: table
      },
      success: function(response){
        $("input[name='select[]']:checked").parent().parent().fadeOut();
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