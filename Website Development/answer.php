<?php
    ?>

<!DOCTYPE html>
<html>
    <body>
        <p><span id = "SurveyName"></span></p>
    </body>
</html>
    <script type="text/javascript">
        const queryString = window.location.search;
        fetch('https://mi-linux.wlv.ac.uk/~2119668/my-api.php' + queryString)
        .then(response => response.json())
        .then(response =>{
        document.getElementById("SurveyName").innerHTML = response.SurveyName; })
        .catch(err => {
            console.log(err);
        });
    </script>