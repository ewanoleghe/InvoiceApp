function filterInvoices(checkbox, status) {
    var checked = checkbox.checked;
    var url = '/';
    if (checked) {
        url += status;
    }
    window.location.href = url;
}

document.addEventListener("DOMContentLoaded", function() {
    var filterDropdown = document.getElementById('filter-dropdown');
    var dropdownToggle = document.getElementById('filter-dropdown-toggle');

    dropdownToggle.addEventListener('click', function(event) {
        event.stopPropagation();
        filterDropdown.classList.toggle('show');
    });

    window.addEventListener('click', function(event) {
        if (!event.target.matches('#filter-dropdown-toggle')) {
            filterDropdown.classList.remove('show');
        }
    });
});
