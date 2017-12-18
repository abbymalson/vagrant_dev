<html>
<head>
</head>
<body>
	<h1>Job Runner</h1>
  <p>Workflow Automation, is a wonderful thing. This will help move jobs down the line.</p>
	<p>This will accept certain job types and run them in the background so you don't have to.
	</p>
	<p><a href="form.php">Click Here</a> to add a new item.
	</p>
<div id="job_groups">
  <!-- Job Groups -->
  <h2>Job Groups</h2>
  <table width="100%" id="tbl_job_groups">
  </table>
</div>
<div id="jobs">
  <!-- Jobs -->
  <h2>Jobs</h2>
  <table width="100%" id="tbl_jobs">
  </table>
</div>
<div id="job_history">
  <!-- Last jobs run -->
  <h2>Job History</h2>
  <table width="100%" id="id_job_history">
  </table>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
    var count = 0;
    function checkMessageDataQueue() {
      console.log("checkMessageDataQueue: "  + count++);

      // setTimeout(checkMessageDataQueue(), 1000);
    }
    function loadJobHistory() {
    }
    function loadJobs() {
    }
    function loadJobGroups() {
    }
    function loadJobRunnerActivity() {
    }

      // add a timer to re run the check Message Data queue in 2 minute interals ...
    // var myIntervalVar = setInterval(checkMessageDataQueue(), 2 * 60 * 1000);
     var myIntervalVar = setInterval(checkMessageDataQueue(),  1000);
    // checkMessageDataQueue();
    $(document).ready(function() {
      console.log("ready");
      // Event binding using a convenience method
      $( "#btn_addJob" ).click(function( event ) {
          // addJobRow();
          alert( "Hello." );
      });
    });
	</script>
</body>
</html>
