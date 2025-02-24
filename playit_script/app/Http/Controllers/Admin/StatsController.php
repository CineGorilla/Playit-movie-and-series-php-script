<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

use App\Models\Items;
use App\Models\Episodes;
use App\Models\User;
use App\Models\Newsletters;
use App\Models\Comments;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class StatsController extends MainAdminController{  
    public function realtime(){  
    	//Tracking Active Users Online and Country
    	$optParams = array('dimensions' => 'rt:country');
        try {
		  	$gioTopLocationsResults = Analytics::getAnalyticsService()->data_realtime->get(
		      	'ga:'.env('ANALYTICS_VIEW_ID'),
		      	'rt:activeUsers',
		      	$optParams);
		  	// Success. 
		}catch (apiServiceException $e) {
		  	// Handle API service exceptions.
		  	$error = $e->getMessage();
		}

		$gioTopLocations = '';
		if($gioTopLocationsResults->getRows() == null){
			$gioTopLocations .= "[['Country', 'Online']]";
		}else{
			// Print headers.
		    $gioTopLocations .= "[['Country', 'Online'],";
		    // Print table rows.
		    foreach ($gioTopLocationsResults->getRows() as $row) {
		      	$gioTopLocations .= "[";
		      	$resultstr = array();
		      	$i=1;
				foreach ($row as $cell) {
					if($i == 1){
						$resultstr[] = "'".htmlspecialchars($cell, ENT_NOQUOTES)."'";
					}else{
						$resultstr[] = htmlspecialchars($cell, ENT_NOQUOTES);
					}
				  	$i++;
				}
				$gioTopLocations .= implode(",",$resultstr);
		      	$gioTopLocations .= "],";
		    }
		    $gioTopLocations .= "]";
		}

		//Tracking Pages Slug
		$optParams1 = array('dimensions' => 'rt:pagePath');
        try {
		  	$pagePathResults = Analytics::getAnalyticsService()->data_realtime->get(
		      	'ga:'.env('ANALYTICS_VIEW_ID'),
		      	'rt:activeUsers',
		      	$optParams1);
		  	// Success. 
		}catch (apiServiceException $e) {
		  	// Handle API service exceptions.
		  	$error = $e->getMessage();
		}

		//Visitors Sources
		$optParams2 = array('dimensions' => 'rt:source');
        try {
		  	$visitorsSources = Analytics::getAnalyticsService()->data_realtime->get(
		      	'ga:'.env('ANALYTICS_VIEW_ID'),
		      	'rt:activeUsers',
		      	$optParams2);
		  	// Success. 
		}catch (apiServiceException $e) {
		  	// Handle API service exceptions.
		  	$error = $e->getMessage();
		}

		$keywords = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'),'rt:activeUsers',array('dimensions' => 'rt:keyword'));


		$visitorsOnline = Analytics::getAnalyticsService()->data_realtime->get('ga:'.env('ANALYTICS_VIEW_ID'), 'rt:activeVisitors')->totalsForAllResults['rt:activeVisitors'];

    	return view('admin.stats.realtime',compact('gioTopLocations','visitorsOnline','gioTopLocationsResults','pagePathResults','visitorsSources','keywords'));
    }

    public function pageviews(Request $request){
    	if(is_null($request->month)){
    		$month = date("m");
    	}else{
    		$month = $request->month;
    	}
    	$month_name = date("F", mktime(0, 0, 0, $month, 10));
    	$currentYear = date("Y");
    	$monthsDays = cal_days_in_month(CAL_GREGORIAN, $month, $currentYear);
    	$startDate = Carbon::createFromDate($currentYear,$month,1);
		$endDate = Carbon::createFromDate($currentYear,$month,$monthsDays);

		$pageviews = Analytics::fetchTotalVisitorsAndPageViews(Period::create($startDate, $endDate));

		$pageviewslists = Analytics::fetchVisitorsAndPageViews(Period::create($startDate, $endDate));

		$mostVisitedPages = Analytics::fetchMostVisitedPages(Period::create($startDate, $endDate),20);

		$topReferrers = Analytics::fetchTopReferrers(Period::create($startDate, $endDate),20);

		$pageviewsValue = '';
		if($pageviews == null){
			$pageviewsValue .= "[['Date', 'Visitors', 'Pageviews']]";
		}else{
			// Print headers.
		    $pageviewsValue .= "[['Date', 'Visitors', 'Pageviews'],";
		    // Print table rows.
		    foreach ($pageviews as $row) {
		      	$pageviewsValue .= "[";
		      	$resultstr = array();
		      	$i=1;
				foreach ($row as $cell) {
					if($i == 1){
						$resultstr[] = "'".date("d",strtotime($cell))."'";
					}else{
						$resultstr[] = htmlspecialchars($cell, ENT_NOQUOTES);
					}
				  	$i++;
				}
				$pageviewsValue .= implode(",",$resultstr);

		      	$pageviewsValue .= "],";
		    }
		    $pageviewsValue .= "]";
		}
    	return view('admin.stats.pageviews',compact('pageviewsValue','month_name','currentYear','pageviewslists','mostVisitedPages','topReferrers','month'));
    }

    public function seostats(Request $request){
    	if(is_null($request->month)){
    		$month = date("m");
    	}else{
    		$month = $request->month;
    	}
    	$month_name = date("F", mktime(0, 0, 0, $month, 10));
    	$currentYear = date("Y");
    	$monthsDays = cal_days_in_month(CAL_GREGORIAN, $month, $currentYear);
    	$startDate = Carbon::createFromDate($currentYear,$month,1);
		$endDate = Carbon::createFromDate($currentYear,$month,$monthsDays);

    	//New Users vs Returing Users
    	$newVsReturning = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:userType'));

    	//Mobile Device Info
    	$mobileDevices = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:mobileDeviceInfo'));

    	//New Users vs Returing Users
    	$operatingSystems = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:operatingSystem'));

    	//Country
    	$countrys = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:country'));

    	//Browser
    	$browsers = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:browser'));

    	//New Vs Returning Sessions Durations
    	$newVsReturningsessionsDurations = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessionDuration',array('dimensions' => 'ga:userType'));

    	//New Vs Returning Pageviews
    	$newVsReturningPageviews = Analytics::performQuery(Period::create($startDate, $endDate),'ga:pageviews',array('dimensions' => 'ga:userType'));
    	
    	//Source and Medium
    	$sources = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:source'));
    	$mediums = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:medium'));

    	//Search Engines
    	$searchEngines = Analytics::performQuery(Period::create($startDate, $endDate),'ga:pageviews',array('dimensions' => 'ga:source','filters' => 'ga:medium==cpa,ga:medium==cpc,ga:medium==cpm,ga:medium==cpp,ga:medium==cpv,ga:medium==organic,ga:medium==ppc'));

    	//Keywords
    	$keywords = Analytics::performQuery(Period::create($startDate, $endDate),'ga:sessions',array('dimensions' => 'ga:keyword'));

    	$newVsReturningValue = '';
		if($newVsReturning == null){
			$newVsReturningValue .= "[['New Visitor', 'Returning Visitor']]";
		}else{
			// Print headers.
		    $newVsReturningValue .= "[['New Visitor', 'Returning Visitor'],";
		    // Print table rows.
		    foreach ($newVsReturning as $row) {
		      	$newVsReturningValue .= "[";
		      	$resultstr = array();
		      	$i=1;
				foreach ($row as $cell) {
					if($i == 1){
						$resultstr[] = "'".$cell."'";
					}else{
						$resultstr[] = htmlspecialchars($cell, ENT_NOQUOTES);
					}
				  	$i++;
				}
				$newVsReturningValue .= implode(",",$resultstr);

		      	$newVsReturningValue .= "],";
		    }
		    $newVsReturningValue .= "]";
		}

		return view('admin.stats.seostats',compact('month_name','month','mobileDevices','newVsReturningValue','operatingSystems','countrys','browsers','newVsReturningsessionsDurations','newVsReturningPageviews','sources','mediums','searchEngines','keywords'));
    }

}