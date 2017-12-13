<html>
<head>
</head>
<body>
	<form name="job-group" id="job-group">
		<p>Add/Remove Existing jobs (cli-jobs or web-jobs) to a job group. This will combine the jobs together and execute them in order
		that you have listed below. Remember these items will be executed in order, so please arrange them in order (lowest to highest)</p>
		<p>To add a job to either option below, please use the <a href="form.php">form</a>.</p>

		<table width="100%" id="job-group-form-1">
			<tr>
				<th>Name:</th>
				<td><input type="text" name="name" value="" id="name"></td>
			</tr>
			<tr>
				<th>Job</th>
				<td>
					<select name="job" id="job">
						<option value=""></option>
						<option value="">Command Line Job</option>
						<option value="">Web Automation Job</option>
					</select>
				</td>
			</tr>
			<tr><td colspan="2"><input type="button" id="btn_addJob" value="Add Job"></td></tr>
		</table>
		<div id="job-order-title">Job Order</div>
		<table id="job-order">
		</table>
		<div id="submit_button">
		<input type="submit" id="btn_submit" value="Create Job Group Order">
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		function addJobRow() {
			
		}

    $(document).ready(function() {
      console.log("ready");
      // Event binding using a convenience method
      $( "#btn_addJob" ).click(function( event ) {
          addJobRow();
          alert( "Hello." );
      });
    });
	</script>
</body>
</html>
