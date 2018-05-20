$(function() {
    // Get the form.
    var form = $('#ajax_contact');

    // Get the messages div.
    var formMessages = $('#form-messages');

    // Set up an event listener for the contact form.
    $(form).submit(function(event) {
    // Stop the browser from submitting the form.
        event.preventDefault();

        // Serialize the form data.
        // Submit the form using AJAX.
        var formData = $(form).serializeArray();
        var parsedData = formData.reduce(function(acc, input) {
            if (input.name.indexOf("question") > -1 && input.name !== "questionNumber") {
                var questionId = input.name.split('-')[1];
                var question = Object.assign({}, input);
                question.answers = [];
                
                acc[questionId] = question;
            }
            else if(input.name.indexOf("answer") > -1 && input.name !== "questionNumber") {
                var x = input.id;
                var questionId = input.name.split('-')[1];
                acc[questionId].answers.push(input)
            }
            return acc;
        }, {});
        var formName = formData[0].value;
        var visibility = formData[2].value;
        $.ajax({
            type: 'POST',
            url: "newForm_handler.php",
            data: {
                formName: formName,
                visibility: visibility,
                data: JSON.stringify(parsedData)
            }
        })
        .done(function(response) {
            // Set the message text.
            $(formMessages).text(response);
        
        })
        .fail(function(data) {
            // Set the message text.
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
        });
    });
});