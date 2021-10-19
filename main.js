jQuery(document).ready( function($) {
   $('form.register').on('submit', function(e){
      e.preventDefault();
      var that = $(this),
      url = that.attr('action'),
      type = that.attr('method');
      var name = $('.applicant-name').val();
      var email = $('.applicant-email').val();
      var skills = $('.primary-skills').val();
      var jobtitle = $('.vacant-position').val();
      $.ajax({
         url: myAjax.ajaxurl,
         type:"POST",
         dataType:'json',
         data: {
            action:'display_applied_jobs',
            name:name,
            email:email,
            skills:skills,
            jobtitle:jobtitle,
       },success: function(response) {
            $(".applied_successfully").css("display","block").append('<div> Name :'+name+'<br> Email :'+email+'<br> Primary Skills:'+skills+'</div>');          
      },
      error: function(data){
            $(".failed").css("display","block");  
      }
      });
      $('.register')[0].reset();
   
   });
   
});
function display_form(){
   document.getElementById("application_form").style.display = "block";
}