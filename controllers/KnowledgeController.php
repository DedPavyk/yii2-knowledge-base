<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\KnowledgeBase;

class KnowledgeController extends Controller
{
    public function actionIndex()
    {
        $data = KnowledgeBase::getData();
        $initialTopicId = $data[0]['id'];
        $initialSubtopicId = $data[0]['subtopics'][0]['id'];
        
        return $this->render('index', [
            'data' => $data,
            'initialTopicId' => $initialTopicId,
            'initialSubtopicId' => $initialSubtopicId
        ]);
    }

    public function actionGetSubtopics($topicId)
    {
        $data = KnowledgeBase::getData();
        foreach ($data as $category) {
            if ($category['id'] == $topicId) {
                return $this->renderPartial('_content', [
                    'subtopics' => $category['subtopics']
                ]);
            }
        }
        return '';
    }

    public function actionGetContent($subtopicId)
    {
        $subtopic = KnowledgeBase::getSubtopicContent($subtopicId);
        if ($subtopic) {
            return $this->renderPartial('_content', [
                'content' => $subtopic
            ]);
        }
        return '';
    }
}