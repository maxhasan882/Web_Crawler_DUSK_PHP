<?php
 
namespace App\Http\Controllers;
 
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
 
 
 
use Tests\DuskTestCase;
//use Tests\Browser\ExampleTest;
//
use Storage;
 
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $attribute;
    public function index(){
   $process = (new ChromeProcess)->toProcess();
	$process->start();
	//$process->run();
	$options = (new ChromeOptions)->addArguments(['--disable-gpu', '--headless']);
	$capabilities = DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options);
	$driver = retry(5, function () use($capabilities) {
	    return RemoteWebDriver::create('http://localhost:9515', $capabilities);
	}, 50);
	$browser = new Browser($driver);
	$browser->visit('https://w...content-available-to-author-only...s.com/item/Hair-Accessories-Synthetic-Wig-Donuts-Bud-Head-Band-Ball-French-Twist-Magic-DIY-Tool-Bun-Maker/32457370321.html?scm=1007.13442.37932.0&pvid=f8b9f498-65d4-400f-a14f-38b4bba77546&tpp=1');
           // $browser->pause(3000);
            try{
                $browser->click('.close-layer');
                $browser->pause(2000);
            }
            catch(Exception $e){
 
            }
 
           $browser->click('#j-shipping-company');
           $browser->pause(3000);
           $elements = $browser->elements('#j-shipping-dialog');
           foreach ($elements as $element) {
		        $html[] = $element->getAttribute('innerHTML');
		    }
		    $this->attribute=$html;
 
	$browser->quit();
	$process->stop();
 
	Storage::disk('local')->put('file.txt', $this->attribute);
 
	foreach ($this->attribute as $value) {
		echo($value);
	}
 
    }
}