$(document).ready(function(){
    $(".recommendations-content").slice(0, 1).removeClass("d-none");
    $("#loadMore").on("click", function(e){
      e.preventDefault();
      $(".recommendations-content:hidden").slice(0, 1).removeClass("d-none");
      if($(".recommendations-content:hidden").length == 0) {
        $("#loadMore").text("").addClass("noContent");
      }
    });
    
  });