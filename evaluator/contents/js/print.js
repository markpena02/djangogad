$(document).ready(function() {
    const proposalId = getQueryParam('id');

    $.ajax({
        url: '../../controller/evaluator/fetch_document_details.php?id=' + proposalId,
        type: 'GET',
        dataType: 'text',
        success: function(response) {
            const data = JSON.parse(response);
            let jsonString = data[0].document_file;
            let data_file = JSON.parse(JSON.parse(jsonString));
            
            $('#dateRequested').text(data[0].date_received);
            $('#dateReviewed').text(data[0].date_reviewed);

            populateForm(data_file);
            calculateTotalScore();

            $.ajax({
                url: '../../controller/evaluator/fetch_proposal_details.php?id=' + data[0].proposer_id,
                type: 'GET',
                dataType: 'text',
                success: function(response1) {
                    const response2 = JSON.parse(response1);
                    $('#title').text(response2.title);
                    $('#proponent').text(response2.proponent_name);
                    $('#office').text(response2.office);
                    $('#description').text(response2.description);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching proposal details:', error);
                    alert('Error fetching proposal details. Please try again later.');
                }
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching document details:', error);
            alert('Error fetching document details. Please try again later.');
        }
    });

    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function populateForm(documentFile) {
        // Populate the form with data from documentFile
    }

    function calculateTotalScore() {
        // Calculate the total score
    }
});
