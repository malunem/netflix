$(document).ready(function(){

    /* LOAD MORE CONTENT SUGGESTIONS */
    $(".content_suggestions").slice(0, 1).removeClass("d-none");
    $("#content_loadMore").on("click", function(e){
      e.preventDefault();
      $(".content_suggestions:hidden").slice(0, 1).removeClass("d-none");
      if($(".content_suggestions:hidden").length == 0) {
        $("#content_loadMore").text("").addClass("noContent");
      }
    });
    
    /* LOAD MORE COLLAB SUGGESTIONS */
    $(".collab_suggestions").slice(0, 1).removeClass("d-none");
    $("#collab_loadMore").on("click", function(e){
      e.preventDefault();
      $(".collab_suggestions:hidden").slice(0, 1).removeClass("d-none");
      if($(".collab_suggestions:hidden").length == 0) {
        $("#collab_loadMore").text("").addClass("noContent");
      }
    });

  });