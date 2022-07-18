<?php
  
namespace App\Console\Commands;
  
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use KubAT\PhpSimple\lib\simple_html_dom;
use DateTime;

  
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
  
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
  
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
  
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at ". now());
  
        /*------------------------------------------
        --------------------------------------------
        Write Your Logic Here....
        I am getting users and create new users if not exist....
        --------------------------------------------
        --------------------------------------------*/
        $begin = new DateTime( "2022-06-01" );
        $end   = new DateTime( "2022-06-29" );

        for($k = $begin; $k <= $end; $k->modify('+1 day')){
        $originaldate=$k->format("Y-m-d");
	    //require_once "simple_html_dom.php";
        //include_once(app_path() . '/librerias/libchart/classes/libchart.php');
 
	$html = file_get_html('https://app.4d88.com/history/date?d='.$originaldate, false);
	$results = array();
  
  if (!empty($html)) {
  
	  $div_class = $title = "";
	  $i = 0;
  
	  foreach ($html->find(".col-lg-4") as $div_class) {
		  if($i==3){
			  break;
		  }
		  //Extract the review title
		  $results[$i]['Fetching Date'] = $originaldate;
		  foreach ($div_class->find(".t1") as $title) {
			  $results[$i]['Title'] = $title->plaintext;
		  }
		  foreach ($div_class->find(".t2") as $date) {
			  $results[$i]['Date'] = $date->plaintext;
		  }
		  foreach ($div_class->find(".t3") as $number) {
			  $results[$i]['Number'] = $number->plaintext;
		  }
		  foreach ($div_class->find(".r1") as $prize1) {
			  $results[$i]['Prize1'] = "'".$prize1->plaintext;
		  }
		  foreach ($div_class->find(".r2") as $prize2) {
			  $results[$i]['Prize2'] = "'".$prize2->plaintext;
		  }
		  foreach ($div_class->find(".r3") as $prize3) {
			  $results[$i]['Prize3'] = "'".$prize3->plaintext;
		  }
		  foreach ($div_class->find(".compact") as $special1) {
			  foreach ($special1->find("tr",0) as $special11) {
				  @$results[$i]['Special1'] = "'".$special1->find("td",0)->plaintext;
			  }
			  foreach ($special1->find("tr",0) as $special11) {
				  @$results[$i]['Special2'] = "'".$special1->find("td",1)->plaintext;
			  }
			  foreach ($special1->find("tr",1) as $special11) {
				@$results[$i]['Special3'] = "'".$special1->find("td",4)->plaintext;
			}
			foreach ($special1->find("tr",1) as $special11) {
				@$results[$i]['Special4'] = "'".$special1->find("td",5)->plaintext;
			}
			foreach ($special1->find("tr",2) as $special11) {
				@$results[$i]['Special5'] = "'".$special1->find("td",8)->plaintext;
			}
			foreach ($special1->find("tr",2) as $special11) {
				@$results[$i]['Special6'] = "'".$special1->find("td",9)->plaintext;
			}
			foreach ($special1->find("tr",3) as $special11) {
				@$results[$i]['Special7'] = "'".$special1->find("td",12)->plaintext;
			}
			foreach ($special1->find("tr",3) as $special11) {
				@$results[$i]['Special8'] = "'".$special1->find("td",13)->plaintext;
			}
			foreach ($special1->find("tr",4) as $special11) {
				@$results[$i]['Special9'] = "'".$special1->find("td",16)->plaintext;
			}
			foreach ($special1->find("tr",4) as $special11) {
				@$results[$i]['Special10'] = "'".$special1->find("td",17)->plaintext;
			}
			  foreach ($special1->find("tr",0) as $special11) {
				  @$results[$i]['Consolation1'] = "'".$special1->find("td",2)->plaintext;
			  }
			  foreach ($special1->find("tr",0) as $special11) {
				  @$results[$i]['Consolation2'] = "'".$special1->find("td",3)->plaintext;
			  }
  
			  
			  foreach ($special1->find("tr",1) as $special11) {
				  @$results[$i]['Consolation3'] = "'".$special1->find("td",6)->plaintext;
			  }
			  foreach ($special1->find("tr",1) as $special11) {
				  @$results[$i]['Consolation4'] = "'".$special1->find("td",7)->plaintext;
			  }
  
			 
			  foreach ($special1->find("tr",2) as $special11) {
				  @$results[$i]['Consolation5'] = "'".$special1->find("td",10)->plaintext;
			  }
			  foreach ($special1->find("tr",2) as $special11) {
				  @$results[$i]['Consolation6'] = "'".$special1->find("td",11)->plaintext;
			  }
  
			  
			  foreach ($special1->find("tr",3) as $special11) {
				  @$results[$i]['Consolation7'] = "'".$special1->find("td",14)->plaintext;
			  }
			  foreach ($special1->find("tr",3) as $special11) {
				  @$results[$i]['Consolation8'] = "'".$special1->find("td",15)->plaintext;
			  }
  
			 
			  foreach ($special1->find("tr",4) as $special11) {
				  @$results[$i]['Consolation9'] = "'".$special1->find("td",18)->plaintext;
			  }
			  foreach ($special1->find("tr",4) as $special11) {
				  @$results[$i]['Consolation10'] = "'".$special1->find("td",19)->plaintext;
			  }
			  
		  }
		  
		  $i++;
  
	  }
  }
  $res[]=$results;
}
print_r($res[]);
       
        
  
        return 0;
    }
}