document.addEventListener("DOMContentLoaded", function () {

    const quantityInputs =
        document.querySelectorAll('input[type="number"]');

    quantityInputs.forEach(function (input) {

        input.addEventListener("change", function () {

            if (this.value < 1) {
                this.value = 1;
            }

        });

    });

});