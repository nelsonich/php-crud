<?php

namespace App\Controllers;

use Dotenv\Dotenv;
use System\Controller;
use System\Request;
use System\Database;

// require '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->safeLoad();

class HomePageController extends Controller
{
    private $mongo;

    public function __construct()
    {
        $this->mongo = new Database(
            $_ENV['DATABASE_NAME'],
            'items' // table name
        );
    }

    /**
     * @route GET /api/items
     */
    public function getAll()
    {

        $items = $this->mongo->fetchData();

        return ['items' => $items];
    }

    /**
     * @route GET /api/items/:id
     */
    public function getById(Request $request, $id)
    {
        $item = $this->mongo->fetchData([
            '_id' => $id
        ]);

        return ['item' => $item];
    }

    /**
     * @route POST /api/items
     */
    public function create(Request $request)
    {
        $name = $request->param('name');
        $phone = $request->param('phone');
        $key = $request->param('key');

        $this->mongo->insertMany([
            'name' => $name,
            'phone' => $phone,
            'key' => $key,
        ]);

        return ['success' => 'ok'];
    }

    /**
     * @route PUT /api/items/:id
     */
    public function update(Request $request, $id)
    {
        $name = $request->param('name');
        $phone = $request->param('phone');
        $key = $request->param('key');

        $this->mongo->updateMany(
            ['_id' => $id],
            [
                'name' => $name,
                'phone' => $phone,
                'key' => $key,
            ]
        );

        return ['success' => 'ok'];
    }

    /**
     * @route DELETE /api/items/:id
     */
    public function delete(Request $request, $id)
    {
        $this->mongo->deleteData([
            '_id' => $id,
        ]);

        return ['success' => 'ok'];
    }
}
