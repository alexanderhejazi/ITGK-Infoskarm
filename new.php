<?php

$con = new PDO("mysql:host=localhost;dbname=itgkstad;charset=utf8", "root", "");
$posts = $con->query("SELECT * FROM news WHERE valid > CURRENT_TIMESTAMP() ORDER BY created DESC");
$users = $con->query("SELECT * FROM users");
$subjects = $con->query("SELECT * FROM subjects ORDER BY subject");
$subjects = $subjects->fetchAll(PDO::FETCH_ASSOC);
$users = $users->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['user'])) {
	// New post
	$newPost = $con->prepare("INSERT INTO news (user, post, valid, type) VALUES (:user, :post, :valid, :type)");
	$newPost->execute([
		"user" => $_POST['user'],
		"post" => $_POST['text'],
		"valid" => $_POST['valid'],
		"type" => $_POST['type']
	]);
	header("Refresh:0");
}

if (isset($_POST['user2'])) {
	// New test/assignment
	$newPost = $con->prepare("INSERT INTO prov (user, subject, department, assignment, deadline) VALUES (:user, :subject, :department, :assignment, :deadline)");
	$newPost->execute([
		"user" => $_POST['user2'],
		"subject" => $_POST['subject'],
		"department" => $_POST['department'],
		"assignment" => $_POST['assignment'],
		"deadline" => $_POST['deadline']
	]);
	header("Refresh:0");
}


?>

<!DOCTYPE html>
<html lang="sv">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administration - ITG Infoskärm</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css/admin.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <section>
      <div class="container">
        <div class="row">
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Ny post</div><!-- /.panel-heading -->
					<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
						  <label for="user">Användare</label>
						  <select class="form-control" id="user" name="user">
							<? foreach($users as $user): ?>
							<option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
							<? endforeach; ?>
						  </select>
						</div>
						<div class="form-group">
						  <label for="type">Typ</label>
						  <select class="form-control" id="type" name="type">
							<option value="0">Nyhet</option>
							<option value="1">Information</option>
						  </select>
						</div>
						<div class="form-group">
						  <label for="message">Text</label>
						  <textarea class="form-control" rows="5" id="message" name="text"></textarea>
						</div>
						<div class="form-group">
							<label for="datetimepicker2">Giltig till</label>
						    <div class='input-group date' id='datetimepicker2'>
						        <input type='text' class="form-control" name="valid" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
						<input type="submit" class="btn btn-primary" value="Publicera">
						</form>
					</div><!-- /.panel-body -->
				</div><!-- /.panel panel-default -->
			</div><!-- /.col-md-4 -->

			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Nytt prov / inlämning</div><!-- /.panel-heading -->
					<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
						  <label for="user2">Användare</label>
						  <select class="form-control" name="user2" id="user2">
							<? foreach($users as $user): ?>
							<option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
							<? endforeach; ?>
						  </select>
						</div>
						<div class="form-group">
							<label for="department">Klass</label>
							<input type="text" class="form-control" id="department" name="department">
						</div>
						<div class="form-group">
						  <label for="subject">Ämne</label>
						  <select class="form-control" name="subject" id="subject">
							<? foreach($subjects as $subject): ?>
							<option value="<?= $subject['id'] ?>"><?= $subject['subject'] . " (" . $subject['shortcode'] . ")" ?></option>
							<? endforeach; ?>
						  </select>
						</div>
						<div class="form-group">
							<label for="assignment">Uppgift</label>
							<input type="text" class="form-control" id="assignment" name="assignment">
						</div>
						<div class="form-group">
							<label for="deadline">Visa fram till</label>
						    <div class='input-group date' id='deadline'>
						        <input type='text' class="form-control" name="deadline" />
						        <span class="input-group-addon">
						            <span class="glyphicon glyphicon-calendar"></span>
						        </span>
						    </div>
						</div>
						<input type="submit" class="btn btn-primary" value="Publicera">
						</form>
					</div><!-- /.panel-body -->
				</div><!-- /.panel panel-default -->
			</div><!-- /.col-md-4 -->

<div class="col-md-4">
<p>
	Att göra:<br>
<br>
- Möjlighet att logga in som olika användare<br>
<br>
- Möjlighet att lägga in nya ämnen<br>
<br>
- Prov/inlämning ska visas 2 veckor innan deadline. Just nu visas det så fort det publiceras.
</p>
</div><!-- /.col-md-4 -->
        </div>
      </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript">
	    $(function () {
	    	var today = new Date();
			var d = new Date();
			d.setDate(d.getDate() + 7);
	        $('#datetimepicker2').datetimepicker({
	            locale: 'sv',
	            format: 'YYYY-MM-DD HH:mm:00',
	            defaultDate: d
	        });

	        $('#deadline').datetimepicker({
	            locale: 'sv',
	            format: 'YYYY-MM-DD HH:00:00',
	            defaultDate: today
	        });

	    });
	</script>
  </body>
</html>