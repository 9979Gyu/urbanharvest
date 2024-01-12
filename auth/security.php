<!DOCTYPE html>
<html>
    <head>
        <title>Urban Harvest-Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="icon" href="../assets/img/logo.png"/>
        <link rel="stylesheet" href="../css/authStyle.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){

                $retrievedQues = null;

                // Make an AJAX request to retrieve question data
                $.ajax({
                    url: 'getQuestion.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $retrievedQues = data;
                        // Iterate through the data and display it
                        $.each(data, function(index, ques) {
                            console.log(ques);
                            $('#quesOneSelection').append('<option value="' + ques.questionID + '">' + ques.sentence + '</option>');
                            $('#quesTwoSelection').append('<option value="' + ques.questionID + '">' + ques.sentence + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log('Error fetching question data:', error);
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="regisForm">
            <form name="securityForm" action="securityProcess.php" method="post">
                <table>
                    <tr>
                        <th colspan="2"><p class="title">Registration</p></th>
                    </tr>
                    <tr>
                        <td><label>Question 1:</label></td>
                        <td>
                            <select id="quesOneSelection" name="ques1">
                                <option value="none">Please select question</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Answer 1:</label></td>
                        <td>
                            <input type="text" name="ans1" placeholder="Enter your answer" required/>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Question 2:</label></td>
                        <td>
                            <select id="quesTwoSelection" name="ques2">
                                <option value="none">Please select question</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Answer 2:</label></td>
                        <td>
                            <input type="text" name="ans2" placeholder="Enter your answer" required/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center>
                                <button type="submit" name="submit">Register</button>
                                <button type="reset" name="reset">Clear</button>
                            </center>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>