<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Source;
use Illuminate\Http\Request;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        $file = file_get_contents(base_path('webservices.json'));

        $decodeFile =  json_decode($file, true);

        $decodeFile['servers'][0] = ["url" => url('/')];

        //Replace Host With Current Host
        $decodeFile['host'] = request()->getHttpHost();

        //Set Base Path
        $decodeFile['basePath'] = request()->getRequestUri();

        //Set Scheme According To Request
        $decodeFile['schemes'] = $request->isSecure() ? ['https'] : ['http'];

        return view('documentation.index', ['decodeFile' => json_encode($decodeFile)]);
    }
}
