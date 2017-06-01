
//promena boje za deo gde su log in i logo
$('.formlog').focusin(function() {
    $('.loginlogo').css('background','hsla(232, 100%, 19%, 0.69)');
});
$('.formlog').blur(function() {
    $('.loginlogo').css('background','hsla(232, 100%, 19%, 0.42)');
});

function unesikomTogle(idpost){
        $('#unesikom' + idpost).fadeToggle();
    
}
