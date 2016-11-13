var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event){
    event.preventDefault();
    
    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
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