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
        return [
            "view" => VIEW_DIR . "home.php"
        ];
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
                "topics" => $topicManager->findTopics($id, ['a.creationdate', 'DESC'])
            ]
        ];

    }

    public function listPosts($id)
    {
        $postManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "posts" => $postManager->findPosts($id, ['creationdate', 'DESC'])
            ]
        ];



    }

    public function userProfile($id)
    {

        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "forum/userProfile.php",
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];
    }



}