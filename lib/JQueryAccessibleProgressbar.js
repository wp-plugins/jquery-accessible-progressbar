$(function() {

    $("#accordion_withProgressbar").accordion({
        collapsible: false,
        autoHeight: false,
        event: "mouseover"
    });

    $("#radioProgressbar").buttonset();
    $('#radioProgressbar').change(function() {
        var isChecked = $("input[name='radioProgressbar']:checked");
        var button = $("input[name='radioProgressbar']:checked").val();
        var phpAjax = "";
        var title = "";
        if(button == "archives") {
            phpAjax = "wp-content/plugins/JQueryAccessibleProgressbar/getArchivesAjax.php";
            title = "Archives";
        } else if(button == "posts") {
            phpAjax = "wp-content/plugins/JQueryAccessibleProgressbar/getRecentPostsAjax.php";
            title = "Recent Posts";
        } else if(button == "comments") {
            phpAjax = "wp-content/plugins/JQueryAccessibleProgressbar/getRecentCommentsAjax.php";
            title = "Recent Comments";
        } 
        if (isChecked) {
            $.ajax({
                type: "GET",
                url: phpAjax,
                dataType: "json",
                success: function(msg){
                    var progressBar = $("#progressbar")
                    .progressbar({
                        value: 0,
                        labelledBy: "progressMsg"
                    });
                    if (!$("#progressMsg").length) {
                        $.ajax({
                            type: "GET",
                            url: "wp-content/plugins/JQueryAccessibleProgressbar/getTranslationsAjax.php",
                            dataType: "json",
                            success: function(msg){
                                if(button == "archives") {
                                    title = msg["archives"];
                                } else if(button == "posts") {
                                    title = msg["recent"] + " " + msg["posts"];
                                } else if(button == "comments") {
                                    title = msg["recent"] + " " + msg["comments"];
                                }
                                progressBar.append("<p id='progressMsg'>" + msg["fetching"] + " \"" + title + "\", " + msg["wait"] + "...</p>");
                            }
                        });
                    }

                    var progressContainer = $("#progressContainer").append(progressBar);

                    setTimeout(function() {
                        $("#progressbar").progressbar('value', 0);
                        $('#accordion_withProgressbar').css("display","none");
                        progressUpdater = setInterval(function() {
                            if ($("#progressbar").progressbar('value') == 100) {
                                clearInterval(progressUpdater);
                                $("#progressContainer").empty();
                                $("#progressContainer").append('<div id="progressbar"></div>');

                                $('.areaA').empty();
                                $('.areaA').append(title);
                                $('.areaB').empty();
                                $('.areaB').removeAttr("style");
                                $('.areaB').append('<ul>' + msg["list"] + '</ul>');

                                $('#accordion_withProgressbar').removeAttr("style");
                            }
                            $("#progressbar").progressbar('value', $("#progressbar").progressbar('value') + 2);
                        }, 30);
                    }, 0);
                }
            });
        } 
        return false;
    });

});
