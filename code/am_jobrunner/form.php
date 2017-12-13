<html>
<head>
</head>
<body>
	<form name="job-group" id="job-group">

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
		<input type="submit" id="btn_submit" value="Create Job Order">
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

