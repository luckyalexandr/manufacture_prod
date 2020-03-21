$(function () {
    // Выбор отделения
    var department = function() {
        $(".field-deliveryform-address").removeClass("open required");
        $(".field-deliveryform-address textarea").attr('required', false);
        $(".field-deliveryform-area, .field-deliveryform-city, .field-deliveryform-warehouse").addClass("open required");
        $(".field-deliveryform-area select, .field-deliveryform-city select, .field-deliveryform-warehouse select").attr('required', true);
    };

    // Ввод адреса
    var address = function() {
        $(".field-deliveryform-address").addClass("open required");
        $(".field-deliveryform-address textarea").attr("required", true);
        $(".field-deliveryform-area, .field-deliveryform-city, .field-deliveryform-warehouse").removeClass("open required");
        $(".field-deliveryform-area select, .field-deliveryform-city select, .field-deliveryform-warehouse select").attr("required", false);
    };

    // Адрес магазина (самовывоз)
    var self = function() {
        // $(".field-deliveryform-address").addClass("open required");
        $(".field-deliveryform-address textarea").attr({"required":true}).val($(".field-deliveryform-address textarea").val() + "Днепр 49027\n" + "ул. Жуковского 18");
        $(".field-deliveryform-area, .field-deliveryform-city, .field-deliveryform-warehouse").removeClass("open required");
        $(".field-deliveryform-area select, .field-deliveryform-city select, .field-deliveryform-warehouse select").attr("required", false);
    };

    // Начальное состояние
    var initial = function() {
        $(".field-deliveryform-area, .field-deliveryform-city, .field-deliveryform-warehouse, .field-deliveryform-address").removeClass("open required");
        $(".field-deliveryform-area select, .field-deliveryform-city select, .field-deliveryform-warehouse select, .field-deliveryform-address textarea").attr("required", false);
    };

    $("select#deliveryform-method").change(function () {
        if ($(this).val() == 1) {
            department();
        }
        if ($(this).val() == 2) {
            address();
        }
        if ($(this).val() == 3) {
            address();
        }
        if ($(this).val() == 4) {
            self();
        }
        if ($(this).val() == 0) {
            initial();
        }
    });
});

// $(function () {
//     $("#orderform-payment_type").change(function () {
//         if ($(this).val() == 1) {
//             $(".sber").addClass("open");
//         } else {
//             $(".sber").removeClass("open");
//         }
//     });
// });