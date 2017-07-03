<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as CoreController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use App\Http\Controllers\Admins\AdminController;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

class AdminController extends CoreController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param string $file
     * @return mixed
     * @throws \Exception
     */
    public function getYamlContent($file = '')
    {
        try {
            if (is_file($file)) {
                return Yaml::parse(file_get_contents($file));
            }
            throw new \Exception("File Not Found: " . $file);
        } catch (ParseException $e) {
            throw new \Exception(sprintf("Unable to parse the YAML string: %s", $e->getMessage()));
        }
    }
}
