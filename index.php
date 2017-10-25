<?php

$con = new PDO("mysql:host=localhost;dbname=itgkstad;charset=utf8", "root", "");
$news = $con->query("SELECT * FROM news WHERE valid > CURRENT_TIMESTAMP() AND type = 0 ORDER BY created DESC");
$info = $con->query("SELECT * FROM news WHERE valid > CURRENT_TIMESTAMP() AND type = 1 ORDER BY created DESC");

include 'food.php';

// Fix days in swedish later
$days = [
1 => "Måndag",
2 => "Tisdag",
3 => "Onsdag",
4 => "Torsdag",
5 => "Fredag"
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="refresh" content="300">
	<title>IT-Gymnasiet Kristianstad Infoskärm</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<style>
	@keyframes marquee {
	    0%   { text-indent: 27.5em }
	    100% { text-indent: -105em }
	}
	</style>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					Nyheter
				</div><!-- /.panel-heading -->
				<div class="panel-body news-padding">
					<div class="news">

					<? foreach($news->fetchAll(PDO::FETCH_ASSOC) as $post): ?>
					<?php

					$user = $con->prepare("SELECT * FROM users WHERE id = ?");
					$user->execute([$post['user']]);
					$user = $user->fetch(PDO::FETCH_ASSOC);

					?>

					<div class="col-md-12 nyhet">
						<p><?= nl2br($post['post']) ?></p>
						<p class="author"><?= $user['name'] ?> - skrevs <time class="timeago" datetime="<?= $post['created'] ?>"></time>, försvinner <time class="timeago" datetime="<?= $post['valid'] ?>"></time></p>
					</div><!-- /.col-md-12 -->

					<? endforeach; ?>

					</div> <!-- ./news -->
				</div><!-- /.panel-body -->
			</div><!-- /.panel panel-default -->
		</div><!-- /.col-sm-4 -->

<div class="col-sm-4">
	<div class="panel panel-default">
		<div class="panel-heading">Allmän information</div><!-- /.panel-heading -->
		<div class="panel-body news-padding">
					<div class="news">

					<? foreach($info->fetchAll(PDO::FETCH_ASSOC) as $post): ?>
					<?php

					$user = $con->prepare("SELECT * FROM users WHERE id = ?");
					$user->execute([$post['user']]);
					$user = $user->fetch(PDO::FETCH_ASSOC);

					?>

					<div class="col-md-12 nyhet">
						<p><?= nl2br($post['post']) ?></p>
						<p class="author"><?= $user['name'] ?> - skrevs <time class="timeago" datetime="<?= $post['created'] ?>"></time>, försvinner <time class="timeago" datetime="<?= $post['valid'] ?>"></time></p>
					</div><!-- /.col-md-12 -->

					<? endforeach; ?>

					</div> <!-- ./news -->
		</div><!-- /.panel-body -->
	</div><!-- /.panel panel-default -->
</div><!-- /.col-sm-4 -->

		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<? if(date("N") == 5 && date("H") >= 12): ?>
						Helg
					<? else: ?>
						Dagens lunch
					<? endif; ?>				
					
				</div><!-- /.panel-heading -->
				<div class="panel-body">
					<? if(date("N") == 5 && date("H") >= 12): ?>
						Trevlig helg! &lt;33333
					<? endif; ?>
					<? if(date('N') > 5): ?>
						Ingen skola idag - trevlig helg! &lt;33333
					<? else: ?>
					<? if(date("H") < 12): ?>
						<div class="col-md-3"><?= $days[date("N")] ?></div>
						<div class="col-md-9" <?= (date('N') < 5) ? "style='padding-bottom:20px'" : "" ?>> <?= food()[date('N')] ?></div>
					<? endif; ?>
					<? foreach(food() as $day => $food): ?>
						<? if($day > date('N')): ?>
							<!-- Alla dagar efter idag -->
							<div class="col-md-3"><?= $days[$day] ?></div>
							<div class="col-md-9" <?= ($day < 5) ? "style='padding-bottom:20px'" : "" ?>> <?= $food ?></div>
						<? endif; ?>
					<? endforeach; ?>
					<? endif; ?>
				</div><!-- /.panel-body -->
			</div><!-- /.panel panel-default -->
		</div><!-- /.col-sm-4 -->
	</div><!-- /.row -->

</div><!-- /.container -->

<div class="timeframe">
	
</div>

<!-- <div class="logon">
	<img src="img/weloveit.png">
</div> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.5.3/jquery.timeago.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/locale/sv.js"></script>

<script type="text/javascript">

window.setInterval(function(){
	moment.locale('sv');
	var timer = moment(new Date());
	time = timer.format('[<span class=\'time\'>]HH:mm:ss[</span>] [<span class=\'week\'>]D MMMM YYYY [-] [v.] W [</span>]');
	$('.timeframe').html(time);
}, 1000);

jQuery.timeago.settings.strings = {
  prefixAgo: "för",
  prefixFromNow: "om",
  suffixAgo: "sedan",
  suffixFromNow: "",
  seconds: "mindre än en minut",
  minute: "ungefär en minut",
  minutes: "%d minuter",
  hour: "ungefär en timme",
  hours: "ungefär %d timmar",
  day: "en dag",
  days: "%d dagar",
  month: "ungefär en månad",
  months: "%d månader",
  year: "ungefär ett år",
  years: "%d år"
};
jQuery.timeago.settings.allowFuture = true;

   jQuery(document).ready(function() {
     $("time.timeago").timeago();
   });
</script>

</body>
</html>