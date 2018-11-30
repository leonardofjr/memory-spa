<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperMethodsController extends Controller
{
    
    // Helper Functions

    public function array_filter_null($a) {
        $filtered = array_filter($a, 'strlen');
        $result = array_values($filtered);
        return $result;
    }

    public function typeDrowndown() {
        return array('Website', 'App', 'Game');
    }

    public function listOfProgrammingLanguages() {
        return array(
            'HTML5',
            'CSS3',
            'Javascript',
            'PHP',
            'MySql',
            'Angular',
            'Laravel',
        );
    }
}
