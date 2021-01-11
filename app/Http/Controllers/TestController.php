<?php

namespace App\Http\Controllers;

use Kreait\Firebase;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;
use App\Http\Resources\Test as TestResource;



class TestController extends Controller
{

	private $database;

    public function __construct() {
        //$this->database = app('firebase.database');
        $firestore = app('firebase.firestore');
        $this->database = $firestore->database();

    }

    /**
     * Insert data.
     */
    public function insert() {
        $newPost =  $this->database
            ->collection('todos')
            ->add([
                'title' => "Title of the New Post 3",
                'type' => 'Post',
                'description' => "This is a Post"
            ]);

        return response()->json($newPost->snapshot());
    }

    /**
     * Retrieve data.
     */
    public function getData() {
        $post_id = "-M56jWfY-f7mHJYc5MtL";
        $data = $this->database->collection('todos');
        //$data1 = $this->database->getReference('posts')->getChild('arts')->getSnapshot()->getvalue();
        //$alldata = array_merge($data, $data1);

       // return response()->json($data);
       return new TestResource($data);
    }

    /**
     * Update data.
     */
    public function update() {
        $post_id = "1a7cdcc2bf304800981b";

        $update =  $this->database
            ->document('todos/'.$post_id)
            ->set([
                'title' => "Title of the New Post 8",
                'type' => 'Post',
                'description' => "This is a Post",
                'id' => 1
            ]);

        $udoc = $this->database->document('todos/'.$post_id)->snapshot();

        return response()->json($udoc['id']);
    }

    /**
     * Delete data.
     */
    public function delete() {
        $post_id = "-M56jWfY-f7mHJYc5MtL";

        $delete = $this->database->getReference('blog/posts/'.$post_id)->remove();
    }

    /**
     * Delete all data.
     */
    public function deleteAll() {
        $delete = $this->database->getReference('posts')->remove();
    }
}
