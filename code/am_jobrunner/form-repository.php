<html>
<head>
  <link rel="stylesheet" href="styles/styles.css"></link>
</head>
<body>
	<form name="repository" id="repository" method="POST" action="actions/add_repository.php">

		<table width="100%" id="repository-form-1">
			<tr>
				<th>Repository Name:</th>
				<td><input type="text" name="repository_name" value="" id="repository_name"></td>
			</tr>
			<tr>
				<th>Local Directory Path:</th>
				<td><input type="text" name="local_directory_path" value="" id="local_directory_path"></td>
			</tr>
			<tr>
				<th>Github Path:</th>
				<td><input type="text" name="github_path" value="" id="github_path"></td>
			</tr>
			<tr>
				<th>Github Clone Path:</th>
				<td><input type="text" name="github_clone_path" value="" id="github_clone_path"></td>
			</tr>
			<tr>
				<th>Circle Status URL:</th>
				<td><input type="text" name="circle_status_url" value="" id="circle_status_url"></td>
			</tr>
			<tr>
				<th>Circle Status API Key:</th>
				<td><input type="text" name="circle_status_api_key" value="" id="circle_status_api_key"></td>
			</tr>
			<tr>
				<th>Active</th>
				<td>
					<select name="active" id="active">
						<option value="Y">Active</option>
						<option value="N">Not Active</option>
					</select>
				</td>
			</tr>
		</table>
		<div id="submit_button">
		<input type="submit" id="btn_submit" value="Add Repository">
	</form>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		function addJobRow() {
			
		}

    $(document).ready(function() {
      console.log("ready");
      // Event binding using a convenience method
      $( "#btn_addJob" ).click(function( event ) {
          alert( "Hello." );
      });
    });
	</script>
</body>
</html>


