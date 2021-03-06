<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
	<title>
		Build a Survey Form using HTML and CSS
	</title>

	<style>

		/* Styling the Body element i.e. Color,
		Font, Alignment */
		body {
			background-color: #d6dad8;
			font-family: Verdana;
			text-align: center;
		}

		/* Styling the Form (Color, Padding, Shadow) */
		form {
			background-color: #fff;
			max-width: 500px;
			margin: 50px auto;
			padding: 30px 20px;
			box-shadow: 2px 5px 10px rgba(0, 0, 0, 0.5);
		}

		/* Styling form-control Class */
		.form-control {
			text-align: left;
			margin-bottom: 25px;
		}

		/* Styling form-control Label */
		.form-control label {
			display: block;
			margin-bottom: 10px;
		}

		/* Styling form-control input,
		select, textarea */
		.form-control input,
		.form-control select,
		.form-control textarea {
			border: 1px solid #777;
			border-radius: 2px;
			font-family: inherit;
			padding: 10px;
			display: block;
			width: 95%;
		}

		/* Styling form-control Radio
		button and Checkbox */
		.form-control input[type="radio"],
		.form-control input[type="checkbox"] {
			display: inline-block;
			width: auto;
		}

		/* Styling Button */
		button {
			background-color: #05c46b;
			border: 1px solid #777;
			border-radius: 2px;
			font-family: inherit;
			font-size: 21px;
			display: block;
			width: 100%;
			margin-top: 50px;
			margin-bottom: 20px;
		}
	</style>
</head>

<body>
	<h1>GeeksforGeeks Survey Form</h1>

	<!-- Create Form -->
	<form id="form">

		<!-- Details -->
		<div class="form-control">
			<label for="name" id="label-name">
				Hình ảnh
			</label>

			<!-- Input Type Text -->
			<input type="file" name="image" 
				id="name"
				placeholder="Enter your name" />
		</div>

		
		<div class="form-control">
			<label for="comment">
				Miêu tả
			</label>

			<!-- multi-line text input control -->
			<textarea name="comment" id="comment"
				placeholder="Enter your comment here">
			</textarea>
		</div>
		<div class="form-control">
			<label for="age" id="label-age">
				Tác Gỉa
			</label>

		
			<input type="text"
				id="age"
				placeholder="Enter your age" />
		</div>
		<div class="form-control">
			<label for="age" id="label-age">
				Diễn viên
			</label>

		
			<input type="text"
				id="age"
				placeholder="Enter your age" />
		</div>
		<div class="form-control">
			<label for="email" id="label-email">
				Ngày Sinh
			</label>

			<!-- Input Type Email-->
			<input type="email"
				id="email"
				placeholder="Enter your email" />
		</div>
	
	
	
		<!-- Multi-line Text Input Control -->
		<button type="submit" value="submit">
			Submit
		</button>
	</form>
</body>

</html>
