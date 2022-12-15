<?php
  include('../connection.php');
  
  // Initialize
  $not_assigned = '';
  $grade7count = '';
  $grade8count = '';
  $grade9count = '';
  $grade10count = '';
  $grade11count = '';
  $grade12count = '';

  $teacherIcount = '';
  $teacherIIcount = '';
  $teacherIIIcount = '';
  $teacherIVcount = '';

  // Grades
  $count_not_assigned = $conn -> query("SELECT * FROM new_students WHERE grade='Not set'");
  $count7 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 7'");
  $count8 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 8'");
  $count9 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 9'");
  $count10 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 10'");
  $count11 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 11'");
  $count12 = $conn -> query("SELECT * FROM new_students WHERE grade='Grade 12'");

  // Position
  $count_teacherI = $conn -> query("SELECT * FROM new_teacher WHERE position='Teacher I'");
  $count_teacherII = $conn -> query("SELECT * FROM new_teacher WHERE position='Teacher II'");
  $count_teacherIII = $conn -> query("SELECT * FROM new_teacher WHERE position='Teacher III'");
  $count_teacherIV = $conn -> query("SELECT * FROM new_teacher WHERE position='Teacher IV'");

  // Assignments
  $not_assigned = $count_not_assigned -> num_rows;
  $grade7count = $count7 -> num_rows;
  $grade8count = $count8 -> num_rows;
  $grade9count = $count9 -> num_rows;
  $grade10count = $count10 -> num_rows;
  $grade11count = $count11 -> num_rows;
  $grade12count = $count12 -> num_rows;

  $teacherIcount = $count_teacherI -> num_rows;
  $teacherIIcount = $count_teacherII -> num_rows;
  $teacherIIIcount = $count_teacherIII -> num_rows;
  $teacherIVcount = $count_teacherIV -> num_rows;
  // $conn -> close();  
?>