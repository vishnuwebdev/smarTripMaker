<!DOCTYPE html>
<html lang="">
	<head>
		
		<!-- Meta Tag Start From here -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Project Title Here -->
		<title>Smart Trip Maker</title>
		<style>
			body{
			font-family: 'Rubik', sans-serif;
			position: relative;
			font-size: 0.9rem;
			background: #eee;
			color: #333;
		}
		</style>
	</head>
	<body>
<div style="background: #fff;width: 800px;margin: 35px auto;padding: 20px;box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);">
<table class="table table-hover table-bordered mb0" style="width:100%;border-collapse: collapse;    border-spacing: 0;border: 1px solid #000;">
	<thead>
		<tr>
		  <th class="firsttd" colspan="2" style="text-align:center;padding:15px 10px;border-bottom: 1px solid #000;">CONTACT QUERY</th>
		</tr>
	</thead>
	  <tbody>
		<tr>
		  <td class="firsttd" style="padding: 9px 8px;border-bottom: 1px solid #000;    border-right: 1px solid #000;"> Name</td>
		  <td style="    padding: 9px 8px;border-bottom: 1px solid #000;">
		  <?php echo $result->com_name; ?></td>
		</tr>
		<tr>
		  <td class="firsttd" style="padding: 9px 8px; border-bottom: 1px solid #000;    border-right: 1px solid #000;">Email Id</td>
		  <td style="padding: 9px 8px; border-bottom: 1px solid #000;"><?php echo $result->com_email; ?></td>
		</tr>
		
		<tr>
		  <td class="firsttd" style="padding: 9px 8px;border-bottom: 1px solid #000; border-right: 1px solid #000;">Phone Number</td>         
		  <td style="padding: 9px 8px; border-bottom: 1px solid #000;"><?php echo $result->com_mobile; ?></td>
		</tr>
		
		 <tr>
		  <td class="firsttd" style="padding: 9px 8px;border-bottom: 1px solid #000;border-right: 1px solid #000;">Subject</td>         
		  <td style="    padding: 9px 8px;    border-bottom: 1px solid #000;"><?php echo $result->com_subject; ?></td>
		</tr>
		<tr>
		  <td class="firsttd" style="padding: 9px 8px; border-bottom: 1px solid #000; border-right: 1px solid #000;">Message</td>         
		  <td style="padding: 9px 8px;border-bottom: 1px solid #000;"><?php echo $result->com_description; ?></td>
		</tr>
		
	  
		
	  </tbody>
	</table>
</div>
</body>
</html> 
<!-- User dashboard end from here -->
