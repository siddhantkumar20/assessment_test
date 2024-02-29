$(document).ready(function() {

    var scores = 0;

    $(".q1right, .q2right, .q3right, .q4right, .q5right").click(function() {
        $(this).css("background-color", "rgb(99, 255, 107)");
        scores++;
    });
    
    $('.btn-show-scores').click(function () {
        alert('Your score: ' + scores);
    });    
});

