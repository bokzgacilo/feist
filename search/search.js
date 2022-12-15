function getAll(){
  $.ajax({
    type: 'post',
    url: 'getAll.php',
    success: function(response){
      $('.right-container').html(response);
    }
  })
}

function openItem(id){
  $.ajax({
    type: 'post',
    url: 'showDetails.php',
    data: {
      profileID : id
    },
    success: function(response){
      window.location.href = '../details/index.php?uid=' + id;
    }
  })
}


$(document).ready(function(){
  // getAll();

  $('.panel-item-grade').click(function(){
    var selector = $(this).attr('title');

    $.ajax({
      type: 'post',
      url: 'filter.php',
      data: {
        grade: selector
      },
      success: function(response){
        $('.right-container').html(response);
      }
    })
  })
  $('.panel-item-grade').click(function(){
    var selector = $(this).attr('title');

    $.ajax({
      type: 'post',
      url: 'filter.php',
      data: {
        grade: selector
      },
      success: function(response){
        $('.right-container').html(response);
      }
    })
  })

  $('.panel-item-position').click(function(){
    var selector = $(this).attr('title');

    $.ajax({
      type: 'post',
      url: 'filter.php',
      data: {
        position: selector
      },
      success: function(response){
        $('.right-container').html(response);
      }
    })
  })

  $('.close-mod').click(function(){
    $('.side-content').animate({'marginRight' : '-400px'}, 200, function(){
      $(this).parent().css('display', 'none');
    })
  })

  $('.account').click(function(){
    $('#account').css('display', 'flex');
    $('.side-content').animate({'marginRight' : '0px'}, 200)
  })

  $('.search-form').submit(function(event){
    const urlParams = new URLSearchParams(window.location.search);
    const param = urlParams.get('show');
    let keyword = $("input[name='keyword']").val();
    
    $.ajax({
      type: 'post',
      url: 'search.php',
      data: {
        keyword: keyword,
        show: param 
      }
    }).done((response) => {
      $('.right-container').html(response)
    })
    event.preventDefault()
  })
})