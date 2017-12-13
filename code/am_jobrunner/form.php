<html>
<head>
  <link rel="stylesheet" href="styles/styles.css"></link>
</head>
<body>
	<form name="job" id="job" method="POST" action="actions/add_job.php">

		<table width="100%" id="job-group-form-1">
			<tr>
				<th>Friendly Name:</th>
				<td><input type="text" name="friendly_name" value="" id="friendly_name"></td>
			</tr>
			<tr>
				<th>Job Type</th>
				<td>
					<select name="job" id="job">
						<option value=""></option>
						<option value="command">Command Line Job</option>
						<option value="web">Web Automation Job</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>Absolute path to executable:</th>
				<td><input type="text" name="absolute_path" value="" id="absolute_path"></td>
			</tr>
			<tr>
				<th>Parameter String (For now, submit json string)</th>
				<td>
          <textarea name="parameter_json" col="50" rows="10"></textarea>
				</td>
			</tr>
<!--
			<tr><td colspan="2"><input type="button" id="btn_addJob" value="Add Job"></td></tr>
-->
		</table>
		<div id="submit_button">
		<input type="submit" id="btn_submit" value="Create Job">
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

