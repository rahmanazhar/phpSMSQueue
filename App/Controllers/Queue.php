<?php

namespace App\Controllers;

use \Core\View;

class Queue extends \Core\Controller
{

    public $queue = [];

    public $file;
    public $countData;

    public function __construct()
    {
        $this->file = $_SERVER['DOCUMENT_ROOT'] . '/data.json';
    }

    /**
     * Insert data to queue
     *
     * @return json
     */
    public function insert()
    {
        header('Content-Type: application/json; charset=utf-8');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->load();

            $request = (empty($_POST))?json_decode(file_get_contents("php://input"), true):$_POST;
            $newdata =  array(
                'id' =>  $request["id"],
                'message' => $request["message"],
                'queue' => $this->countData + 1,
            );
            array_push($this->queue, $newdata);
            $this->store();

            echo json_encode([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $newdata
            ]);
        } else {
            echo json_encode([
                'code' => 200,
                'status' => 'error',
                'message' => 'Invalid'
            ]);
        }
    }

    public function call()
    {
        header('Content-Type: application/json; charset=utf-8');
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->load();
            $consume = null;
            if (!empty($this->queue)) {
                $consume = $this->queue[key($this->queue)];
                unset($this->queue[key($this->queue)]);
                $this->store();
            }

            echo json_encode([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'consume' => $consume,
                'data' => $this->queue
            ]);
        } else {
            echo json_encode([
                'code' => 200,
                'status' => 'error',
                'message' => 'Invalid'
            ]);
        }
    }

    public function getTotalMessage()
    {
        header('Content-Type: application/json; charset=utf-8');
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->load();

            echo json_encode([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => count($this->queue) . ' messages in queue'
            ]);
        } else {
            echo json_encode([
                'code' => 200,
                'status' => 'error',
                'message' => 'Invalid'
            ]);
        }
    }


    public function getMessage()
    {
        header('Content-Type: application/json; charset=utf-8');
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->load();

            echo json_encode([
                'code' => 200,
                'status' => 'success',
                'message' => 'Success',
                'data' => $this->queue
            ]);
        } else {
            echo json_encode([
                'code' => 200,
                'status' => 'error',
                'message' => 'Invalid'
            ]);
        }
    }

    public function store()
    {
        $fh = fopen($this->file, 'w') or die("Can't create file");
        file_put_contents($this->file, json_encode($this->queue));
    }

    public function load()
    {
        $filecontent = file_get_contents($this->file);
        $array = json_decode($filecontent, true);

        $this->countData = empty($array) ? 0 : count($array);
        $this->queue = empty($array) ? [] : $array;
    }
}
