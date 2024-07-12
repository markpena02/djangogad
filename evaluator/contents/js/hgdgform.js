$(document).ready(function() {
    $('input[type="radio"]').on('change', function() {
        var totalScore = 0;
        var scores = {};

        // Iterate over each group to calculate their total scores
        $('input[type="radio"]:checked').each(function() {
            var parent = $(this).data('parent');
            var value = parseFloat($(this).val());

            if (!scores[parent]) {
                scores[parent] = 0;
            }

            scores[parent] += value;
        });

        // Update individual scores
        for (var key in scores) {
            if (scores.hasOwnProperty(key)) {
                totalScore += scores[key];
                $('#score' + key).text(scores[key].toFixed(1));
            }
        }

        // Update the total score
        $('#total-score, #total-score-bottom').text(totalScore.toFixed(2));

        // Update the remarks based on total score
        var remarks = getRemarks(totalScore);
        $('#remarks').text(remarks);
    });

    function getRemarks(totalScore) {
        if (totalScore < 1) {
            return 'Poor';
        } else if (totalScore < 2) {
            return 'Fair';
        } else if (totalScore < 3) {
            return 'Good';
        } else if (totalScore < 4) {
            return 'Very Good';
        } else {
            return 'Excellent';
        }
    }
});
