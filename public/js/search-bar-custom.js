document.addEventListener('DOMContentLoaded', function () {
    const selectSelected = document.querySelector('.select-selected');
    const selectItems = document.querySelector('.select-items');
    const selectOptions = selectItems.querySelectorAll('div');

    selectSelected.addEventListener('click', function () {
        this.classList.toggle('active');
        selectItems.classList.toggle('show');
    });

    selectOptions.forEach(option => {
        option.addEventListener('click', function () {
            selectSelected.textContent = this.textContent;
            selectSelected.classList.remove('active');
            selectItems.classList.remove('show');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        if (!selectSelected.contains(e.target) && !selectItems.contains(e.target)) {
            selectSelected.classList.remove('active');
            selectItems.classList.remove('show');
        }
    });
});