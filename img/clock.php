<!DOCTYPE html>
<html>
<head>
<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('time').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</head>

<body onload="startTime()">

<?php
	echo   "<i class='fas fa-calendar-alt'></i>". date(" F j, Y") ."<br><i  class='fas fa-clock'></i>"." "."<i  id='time'></i>"."<div></div>";
?>



</body>
</html>
