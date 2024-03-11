$(document).ready(function() {

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        firstBtn = $('.firstBtn'),
        allPrevBtn = $('.prevBtn');

    allWells.hide();

    navListItems.click(function(e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    firstBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn1 = curStep.attr("id"),
            curStepBtn = 'step-2',
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

        prevStepWizard.removeAttr('disabled').trigger('click');
    });

    allPrevBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");
        prevStepWizard.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function() {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }
        nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
var totalSteps = $(".steps li").length;

/*=========================================================
*     If you won't to make steps clickable, Please comment below code 
=================================================================*/
$(".steps li").on("click", function() {
    var stepVal = $(this).find("span").text();
    $(this).prevAll().addClass("active");
    $(this).addClass("active");
    $(this).nextAll().removeClass("active");
    $(".myContainer .form-container").removeClass("active fadeIn");
    $(".myContainer .form-container:nth-of-type(" + stepVal + ")").addClass("active fadeIn");
});

$(".submit").on("click", function() {
    return false;
});

$(".steps li:nth-of-type(1)").addClass("active");
$(".myContainer .form-container:nth-of-type(1)").addClass("active");

$(".form-container").on("click", ".next", function() {
    $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
    $(this).parents(".form-container").removeClass("active").next().addClass("active fadeIn");
});

$(".form-container").on("click", ".back", function() {
    $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
    $(this).parents(".form-container").removeClass("active fadeIn").prev().addClass("active fadeIn");
});




