$(document).ready(function(){
    
    $("#search").change(function(){
        let formData = new FormData(document.forms.searchForm);

        $.ajax({
            type: "POST",
            url: $("#searchForm").attr("action"),
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data){
                $("#usersTableBody").empty().append(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    });

    $("body").on("submit", ".formSubmit", function(e){
        e.preventDefault();

        let formData = new FormData(this);
        let url = $(this).attr("action");
        let method = $(this).attr("method");

        $.ajax({
            type: method,
            url: url,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data){
                if(data['message']){
                    alert(data['message'])
                }

                $("#" + data['id']).find(".count").text(data['count']);
            },
            error: function(data){
                alert(data);
            }
        });
    });

    $(".view").click(function(){
        parent = $(this).parents(".tableBody")[0];

        element = $(this).attr("data-toggle") ? $(parent).find("#" + $(this).attr("data-toggle"))[0] : $(parent).find(".tableNested")[0];
        
        $(element).toggle();
    });

});