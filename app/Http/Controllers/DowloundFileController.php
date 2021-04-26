<?php

namespace App\Http\Controllers;

use ZanySoft\Zip\Zip;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DowloundFileController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = 'https://simplemaps.com/data/us-zips';
        $page = $client->request('GET', $url);
        $file_url = 'https://simplemaps.com' . $page->filter('.btn-success')->last()->attr('href');
        $file_full_path = 'public/';
        $file_name = 'simple.zip';
        $getFile = file_get_contents($file_url);
        if ($getFile !== false) {
            Storage::disk('local')->put($file_full_path  . $file_name, $getFile, 'public');
            $file_url_storage = Storage::url($file_full_path . $file_name);
            $zip = Zip::open(public_path() . $file_url_storage);
            $zip->extract(public_path() . '/uncompressed');
            $contents = File::get('uncompressed/uszips.csv');
            if ($contents) {
                \DB::delete('delete from uszips');
                $lines = explode(PHP_EOL, $contents);
                $formatting = str_replace('"', '', explode(",", $lines[0]));
                unset($lines[0]);
                foreach ($lines as $line) {
                    $parsedLine = str_getcsv($line, ',');
                    $result = array();
                    foreach ($formatting as $index => $caption) {
                        if (isset($parsedLine[$index])) {
                            $result[$caption] = trim($parsedLine[$index]);
                        } else {
                            $result[$caption] = '';
                        }
                    }
                    \DB::table('uszips')->insert($result);
                }
                $return = 'success insert into BD';
            } else {
                $return = 'Файл пустой';
            }
        } else {
            $return = 'Не удалось прочитать содержимое файла';

        }
        return response()->json($return);
    }
}
