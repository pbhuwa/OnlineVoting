<?php
  require_once('connection.php');
  session_start();
  if(empty($_SESSION['member_id'])){
    header("location:access-denied.php");
  }
  else{
    if (isset($_POST['submit']))
    {
      $vote = $_REQUEST['vote'];
      $caname = $row['candi_name'];
      $caid = $row['candidate_id'];
      $sql = $mysqli->query("INSERT INTO tbCandidates(candidate_id,candidate_name,candidate_position,candidate_cvotes)
       VALUES ('$caid','$caname','','$vote')" )
      or die("Could not insert candidate at the moment". mysqli_error() );
          $query_run = $mysqli->query($mysqli,$sql);
          if ($query_run){
              echo '<script type="text/javascript">alert("Your vote is uploaded successfully...")</script>';
              echo "<script>window.location.href='voter.php'</script>";
              }
            else{
              die("failed to upload vote ".mysqli_error($mysqli));
              }
      //$mysqli->query("UPDATE tbCandidates SET candidate_cvotes=candidate_cvotes+1 WHERE candidate_name='$vote'");
      }
    }

  $positions= $mysqli->query("SELECT * FROM tbPositions")
    or die("There are no records to display ... \n" . mysqli_error()); 
     if (isset($_POST['Submit']))
     {
       
       $position = addslashes( $_POST['position'] ); 
       $result = $mysqli->query("SELECT * FROM tbCandidetails WHERE candi_position='$position'")
       or die(" There are no records at the moment ... \n"); 
     
     }
     else
     // do something
  
?>
<!DOCTYPE html>

<html>
<head>
<title>online voting</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="css/user_styles.css" rel="stylesheet" type="text/css" /> -->
<script language="JavaScript" src="js/user.js">
</script>

</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-pinterest" href="https://uk.pinterest.com/"><i class="fa fa-pinterest"></i></a></li>
        <li><a class="faicon-twitter" href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="https://dribbble.com/"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-rss" href="https://www.rss.com/"><i class="fa fa-rss"></i></a></li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace inline pushright">
        <li><i class="fa fa-phone"></i> 014227771</li>
        <li><i class="fa fa-envelope-o"></i>AAPP@gmail.com </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.html">ONLINE VOTING</a></h1>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class="active"><a href="voter.php">Home</a></li>

        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/background1.jpg');">
  <section id="testimonials" class="hoc container clear"> 
    <!-- ################################################################################################ -->
    <h2 class="font-x3 uppercase btmspace-80 underlined"> Online <a href="#">Voting</a></h2>
    <ul class="nospace group">




            <div >
            <table bgcolor="#00FF00" width="420" align="center">
            <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
            <tr>
                <td bgcolor="#5D7B9D" >Choose Position</td>
                <td bgcolor="#5D7B9D" style="color:#000000"; ><SELECT NAME="position" id="position" onclick="getPosition(this.value)">
                <OPTION  VALUE="select">select
                <?php 
                  //loop through all table rows
                  while ($row=mysqli_fetch_array($positions)){
                    echo "<OPTION VALUE=$row[position_name]>$row[position_name]"; 
                  }
                ?>
                </SELECT></td>
                <td bgcolor="#5D7B9D" ><input style="color:#ff0000";  type="submit" name="Submit" value="See Candidates" /></td>
            </tr>
            <tr>

            </tr>
            </form> 
            </table>
            <table width="270" align="center">
            <form>
            <tr>
                <th>Candidates:</th>
            </tr>
            <?php

                if (isset($_POST['Submit']))
                {
                  while ($row=mysqli_fetch_array($result)){

                      echo "<tr>";
                      echo "<td style='background-color:#bf00ff'>" . $row['candi_name']."</td>";
                      echo "<td style='background-color:#bf00ff'><input type='radio' name='vote' value=''/></td>";
                      echo "<td style='background-color:#bf00ff; color:#000000;'><input type='submit' name='submit' value='Click to vote'/></td>";
                      echo "</tr>";
                  }
                  mysqli_free_result($result);
                  mysqli_close($link);
              //}
                }
                else
              // do nothing
            ?>

            <tr>
                <h4>NB: Click a circle under a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</h4>

            </tr>
            </form>
            </table>
            </div>


    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="title">Address</h6>
      <ul class="nospace linklist contact">
        <li><i class="fa fa-map-marker"></i>
          //<address>

          
          //</address>
        </li>
      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Phone</h6>
      <ul class="nospace linklist contact">

        <li><i class="fa fa-phone"></i> 2234569<br>
          014227771</li>


      </ul>
    </div>

    <div class="one_third">
      <h6 class="title">Email</h6>
      <ul class="nospace linklist contact">

        <li><i class="fa fa-envelope-o"></i>AAPP groups</li>

      </ul>
    </div>


    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2017 - All Rights Reserved - <a href="#">AAPP GROUPS</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>