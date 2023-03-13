<?php
  require('db.php');
  $result = mysqli_query($con,"SurveyName * FROM SurveyDetails");

  echo "<table border='1'>
  <tr>
  <th>SurveyName</th>
  </tr>";

  while($row = mysqli_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['SurveyName'] . "</td>";
  echo "</tr>";
  }
  echo "</table>";

  mysqli_close($con);
  ?>