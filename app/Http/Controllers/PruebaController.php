<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Finning;

use Request;
use DB;
use Auth;
use GuzzleHttp\Client;

class PruebaController extends Controller{


    public function index(){



          $client = new Client(['cookies' => true, 'http_errors' => false]);


          $response = $client->get('https://isatdatapro.orbcomm.com/GLGW/2/RestMessages.svc/JSON/get_forward_messages?access_id=70002643&password=YMQQGQTM&fwIDs=1153035');

          return $response->getBody();



		}

}

// https://isatdatapro.orbcomm.com/GLGW/2/RestMessages.svc/JSON/get_return_messages/?access_id=70000010&password=XHTYFGVT&start_utc=2016-10-12%2010:00:05

