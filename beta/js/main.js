$.material.init();
$('.select').dropdown({
    autoinit: '.select'
});
$.fn.datepicker.defaults.language = 'vi';
$.fn.datepicker.defaults.format = 'dd/mm/yyyy';
$.fn.datepicker.defaults.autoclose = true;
$.fn.datepicker.defaults.weekStart = 1;
$('.datepicker').datepicker();
