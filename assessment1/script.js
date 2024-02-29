$(document).ready(function() {

    var scores = 0;

    $(".q1right, .q2right, .q3right, .q4right, .q5right").click(function() {
        $(this).css("background-color", "rgb(99, 255, 107)");
        scores++;
    });

    $(".q1wrong, .q2wrong, .q3wrong, .q4wrong, .q5wrong").click(function() {
        $(this).css("background-color", "rgb(255, 140, 140)");
    });

    $('.btn-show-scores').click(function () {
        alert('Your score: ' + scores);
    });    
});

