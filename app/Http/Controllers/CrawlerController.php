<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Tests\Browser\ExampleTest;
//use Illuminate\Support\Facades\Request;

/*use Behat\Mink\Mink;
use Behat\Mink\Session;
use DMore\ChromeDriver\ChromeDriver;*/

use Storage;





/*
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
 
use Tests\Browser\ExampleTest;
use Illuminate\Support\Facades\Artisan;
//use Artisan;
 
 
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome\ChromeProcess;
*/

use Tests\DuskTestCase;

use Session;


class CrawlerController extends Controller
{
	protected $crawler, $driver;

	 function __construct() {
       $this->crawler = new ExampleTest();
    }
    public function index(){

			//shell_exec('cd .. && php artisan dusk');
			return view('crawler');

    }

    public function crawler(Request $request){
    	$url =  $request->post('url');
    	Storage::put('url.txt', $url);
    	$test = Storage::get('url.txt');
    	shell_exec('cd .. && php artisan dusk');
    	$data = Storage::get('data.txt');
		echo($data);
		Storage::put('data.txt', "");
    }
}
