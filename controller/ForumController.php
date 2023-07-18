<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {
    }

    public function listCategories()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => [
                "categories" => $categoryManager->findAll(['name', 'ASC'])
            ]
        ];
    }

    public function listTopics($id)
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findTopics($id, ['a.creation_date', 'DESC'])
            ]
        ];

    }

    public function listPosts($id)
    {
        $postManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "posts" => $postManager->findPosts($id, ['a.creation_date', 'DESC'])
            ]
        ];

    }



}