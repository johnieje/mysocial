var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event){
    event.preventDefault();
    
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.innerHTML;
    //postBodyElement = document.getElementById('post_edit');
    //var postBody = document.getElementById('comment').textContent;
    
    postId = event.target.parentNode.parentNode.dataset['postid'];
    
    $('#edit-body').val(postBody);
    $('#edit-modal').modal();
    
});

$('#save-modal').on('click', function(){
    $.ajax({
        'method': 'POST',
        'url': urlEdit,
        'data': { body: $('#edit-body').val(), postId: postId, _token: token}
    }).done(function(msg){
        $(postBodyElement).text(msg['new-body']);
        $('#edit-modal').modal('hide');
    });
});

$('.like').on('click', function(event){
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null ? true : false;
    $.ajax({
        'method': 'POST',
        'url': urlLike,
        'data': { isLike: isLike, postId: postId,  _token: token}
    }).done(function(){
        event.target.textContent = isLike ? event.target.textContent == "Like" ? "You like this post" : "Like" : event.target.textContent == "Dislike" ? "You don\'t like this post" : "Dislike";
        if(isLike){
            event.target.nextElementSibling.textContent = "Dislike";
        }else{
            event.target.previousElementSibling.textContent = "Like";
        }
    });
});

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});

$('#users').autocomplete({
    source: function (request, response) {
        $.ajax({
            url: urlSearch,
            dataType: 'json',
            data: request,
            success: function (data) {
                response(data.map(function (value) {
                    return {
                        'label': value.name
                    };  
                }));
            }   
        }); 
    },  
    minLength: 2,
    autofocus: true
});

/*
$(function () 
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
   var post = document.querySelector('#body');
    
   var postId = post.dataset.postid;
    
    $.ajax({                                      
      url: urlComment,                  //the script to call to get data          
      data: {postId: postId},                        //you can insert url argumnets here to pass to api.php
                                       //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {
        //var id = data[0];              //get id
        var counter = data[0].count;           //get name
          
          //console.log(counter);
        //--------------------------------------------------------------------
        // 3) Update html content
        //--------------------------------------------------------------------
        $('#output').html("<b>Comments: </b>"+counter); //Set output element html
        //recommend reading up on jquery selectors they are awesome 
        // http://api.jquery.com/category/selectors/
      } 
    });
  }); 
*/