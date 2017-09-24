<?php
namespace Mini\Controller;

class HomeController
{
	public function index()
	{
		require APP . 'view/index.html';
		$this->getMunti();
		$this->getStarosa();
		$this->getFestival();
	}

	public function getMunti()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.smcinema.com/Home/MoviesPerCinemaByBranch");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"branchKey=7&dateFormat=2&cinemaFilters=0&showingFilters=1&viewType=0&filter=0");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec ($ch);
		curl_close ($ch);

		$this->scraperSM('SM MUNTINLUPA',$response);
	}

	public function getStarosa()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"https://www.smcinema.com/Home/MoviesPerCinemaByBranch");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,"branchKey=24&dateFormat=2&cinemaFilters=0&showingFilters=1&viewType=0&filter=0");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec ($ch);
		curl_close ($ch);

		$this->scraperSM('SM SANTA ROSA',$response);
	}

	public function getFestival()
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://festivalsupermall.com/cinema/");
		curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS,"branchKey=24&dateFormat=2&cinemaFilters=0&showingFilters=1&viewType=0&filter=0");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec ($ch);
		curl_close ($ch);

		$this->scraperFestival($response);
	}

	public function scraperSM($header,$response)
	{
		$html = str_get_html($response);

		echo '<h1 class="text-center">'.$header.'</h1><br>';

		foreach ($html->find('.CR2-movie-poster') as $cinema)
		{
			$number = $cinema->find('span',0);
			$title = $cinema->find('span',2);

			echo '<h5><b>' . $number->plaintext . '</b></h5>';

			foreach ($cinema->find('a') as $schedule)
			{
				echo '|' . $schedule->plaintext;
			}

			echo '<hr>';
		}
	}

	public function scraperFestival($response)
	{
		$html = str_get_html($response);

		echo '<h1 class="text-center">FESTIVAL SUPERMALL</h1><br>';

		foreach ($html->find('.cinemaitems_2') as $cinema)
		{
			$number =  $cinema->find('h3',0);
			echo '<h5><b>' . $number->plaintext . '</b></h5>';

			$details = $cinema->find('.cinematable',0);

			echo $details->outertext . '<hr>';
		}
	}
}
