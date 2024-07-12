$(document).ready(function() {
    $('#viewButton').click(function() {
        var selectedYear = $('#yearSelect').val();
        var selectedQuarter = $('#quarterSelect').val();
        $('#selectedPeriod').text('Year: ' + selectedYear + ', Quarter: ' + selectedQuarter);
    });

    $('#saveButton').click(function() {
        alert('Save button clicked!');
    });
});
