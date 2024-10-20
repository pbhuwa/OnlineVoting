<?php
	require_once('connection.php');
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
	mysqli_close($mysqli);
?> 