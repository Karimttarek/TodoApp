$($('input[id="checkAll"]')).click(function(event) {
    if (this.checked) {
      $(':checkbox').prop('checked', true);
    } else {
      $(':checkbox').prop('checked', false);
    }
  });


$(document).ready(function() {

    $(document).on('input' , 'input[type=text]' , function (){
        ajaxRequest($('#title').val() , $('#description').val(),$('#category').val() ,$('#status').val());
    });
    $(document).on('change' , 'select' , function (){
        ajaxRequest($('#title').val() , $('#description').val(),$('#category').val() ,$('#status').val());
    });
});
ajaxRequest = function(title, description, category, status){
    $.ajax({
        url:"/todo-list/filter",
        type:'GET',
        data:{
            '_token': "{{csrf_token()}}",
            'title':title,
            'description':description,
            'category':category,
            'status':status
        },
        success:function(response){
            $('tbody').html(response);
        }
    });
}
