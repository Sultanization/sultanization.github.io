<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Get newsfeed</title>

	<!-- css here -->
	<style>
		body {
			text-align: left;
			font-family: Roboto;
			width: 70%;
			margin: 0 auto;
			background: #f1f3f4;
		}
		a {
			text-decoration: none;
			color: #292f31;
			text-indent: 10px;
			font-size: 1.2rem;
			line-height: 1.5;
			text-align: left;
		}
	</style>

</head>
<body>
	<h1 style="font-size: 4rem;"><span style="color: red;">МОЯ</span> <br> НОВОСТНАЯ ЛЕНТА</h1>

	<form method="POST" action="getNewsFeed()">
		<input type="text" name="newsSource" placeholder="Введите URL сайта"> <br> <br>
		<input type="submit" value="Получить ленту новостей">
	</form>
	

	

	<!-- PHP here -->
	<?php
	include 'simple_html_dom.php';

	// Доступ к DOM
	$dom = new DOMDocument('1.0', 'utf-8');


	// Добавление новостного сайта
	function getNewsFeed($url, $div) {

		// Исключения
		$exceptions = ['GGG', 'Байзкова', 'ДТП'];

		echo "<br><br><b><i>" . $url . "</i></b> <br><br>";

		// Получение новостных ссылок
		$site = $url;
		$site = file_get_html($url);
		$titles = $site->find("$div a");


		foreach ($titles as $title) {
			$newsPath = $title->getAttribute('href');

			$title->setAttribute('class', 'newsBlock');
			$title->setAttribute('style', 'display: inline-block;');
			$title->setAttribute('target', '_blank');

			$newsPath = $title->getAttribute('href');
			$fullNewsPath;

			// && !preg_match('/https/i', $newsPath)
			if(mb_strlen($title->text(), "utf-8") > 20 ) {

				// Показ новстей по ключевым словам и наоборот
				if(!preg_match('/GGG|ДТП|Хабиб|Баян Есентаева/', $title)) {

					// Если в URL дблированы /kz, /ru
					if(substr($newsPath, 0, 3) === "/kz" || substr($newsPath, 0, 3) === "/ru") {
						$newsPath = substr($newsPath, 3);
						$fullNewsPath = $url . $newsPath;
						$title->setAttribute('href', $fullNewsPath);
						echo "✔  " . $title . "<br>";
					}
					else {
						$fullNewsPath = $url . $newsPath;
						$title->setAttribute('href', $fullNewsPath);
						echo "✔ " . $title . "<br>";
					}
				}
			}
		} 
	}


	// getNewsFeed('https://www.tengrinews.kz', 'div');
	// getNewsFeed('https://www.baigenews.kz', 'div');
	// getNewsFeed('https://www.zakon.kz/kazakhstan/', 'div');
	// getNewsFeed('https://forbes.kz/news/kazakhstan', 'div');
	// getNewsFeed('https://lenta.ru/', 'div');
	// getNewsFeed('https://www.nytimes.com/', 'div');
	// getNewsFeed('https://www.bbc.com/', 'div');

	getNewsFeed('http://www.today.kz', '.news_section-item');
	getNewsFeed('http://senate.parlam.kz/', 'article');
	getNewsFeed('https://primeminister.kz/ru', '.col-md-9');
	getNewsFeed('https://atameken.kz/', '.news-list');
	getNewsFeed('http://www.kaf.kz/media/news/', '.item__list');
	getNewsFeed('http://www.kazagro.kz/holding?p_p_id=newsportlet_WAR_newsportlet&p_p_lifecycle=0&p_p_state=maximized&p_p_mode=view&p_p_col_id=column-2&p_p_col_pos=1&p_p_col_count=4&_newsportlet_WAR_newsportlet_action=showNewsFull&_newsportlet_WAR_newsportlet_type=2', '.news-list');
	getNewsFeed('https://qaztech.vc/', '.newsfeed');
	getNewsFeed('https://hcsbk.kz/ru/news/press_relize/', '.other-el__list');
	getNewsFeed('https://kmc.kz/ru/press/news', '.page-content');
	getNewsFeed('https://www.kdb.kz/pc/news/', '.posts');
	getNewsFeed('https://www.post.kz/info/press-centr/novosti', 'div');
	getNewsFeed('http://www.ke.kz/', '.news-item');
	getNewsFeed('https://www.damu.kz/news/', '.news-list');
	getNewsFeed('https://skcn.kz/ru/news/news', '.posts__list');
	getNewsFeed('https://ekonomist.kz/statii-ekonomist-kz/', '.post-container');
	getNewsFeed('http://www.kmg.kz/rus/press-centr/press-relizy/', '.news_list');
	getNewsFeed('https://www.sk.kz/press-centre/news/', '.news-item');
	getNewsFeed('http://edu.gov.kz/m/?#', '.news-list');
	getNewsFeed('http://gov.kz/memleket/entities/dsm?lang=ru', '.card-news-list');
	getNewsFeed('https://www.mks.gov.kz/rus/press-sluzhba/news/', '.block--news');
	getNewsFeed('http://www.adilet.gov.kz/ru/news', '.view-content');
	getNewsFeed('http://www.minfin.gov.kz/irj/portal/anonymous', '.tab-pane');
	getNewsFeed('https://moa.gov.kz/ru/posts-list/post', '.post-block');
	getNewsFeed('https://m.nationalbank.kz/ru/news/1.html', '.panel');
	getNewsFeed('https://primeminister.kz/ru/news', '.card');
	getNewsFeed('https://stat.gov.kz/news', 'ul');


	// Вставляем новый элемент как корень (потомок документа)
	echo $dom->saveXML();

	// getting user's preferences
		/*$userURL = $_POST['newsSource'];
		$userDIV = $_POST['newsDiv'];*/
		// getNewsFeed($userURL, $usrDiv);
	?>

	<!-- 
		Что желательно добавить?

		Поднятие вверх новостей по ключевым словам или же их выделение;
		Показ нормального  URL;
	-->
	
</body>
</html>