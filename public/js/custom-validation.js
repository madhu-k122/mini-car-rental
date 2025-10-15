$(function () {
    function getAllowCharacters(element) {
        let allow_characters = $(element).attr('allow_characters') || '';
        if (!allow_characters) return ['a-z'];
        allow_characters = allow_characters.replace(/-/g, '\\-').replace(/\//g, '\\/');
        return allow_characters.split(',');
    }

    $.validator.addMethod("allowcharacters", function (value, element) {
        let list = getAllowCharacters(element);
        let pattern = '^[' + list.join('') + ']+$';
        let regex = new RegExp(pattern, 'i');
        return this.optional(element) || regex.test(value);
    }, "Only allowed characters are permitted.");


    function initializeValidation() {
        $('.validate_form').each(function () {
            let $form = $(this);
            $form.validate({
                errorClass: 'text-danger',
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    }
    initializeValidation();
});
