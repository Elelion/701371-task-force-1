<?php

namespace frontend\widgets;

use frontend\models\Task;
use Yii;
use yii\base\Widget;
use TaskForce\components\AvailableActions;


/**
 * Class TaskActionsButtonsWidget
 * @package frontend\widgets
 */
class TaskActionsButtonsWidget extends Widget
{
    public Task $task;

    /**
     * @return string
     */
    public function run(): string
    {
        /** @note sending - [0 => CancelAction, 1 => RespondAction, ...]  */
        $actions = AvailableActions::getAvailableActions($this->task, Yii::$app->user);

        /**
         * @note
         * since it is faster to find a value by a key than by a value
         * getting - ['CancelAction' => 1, 'RespondAction' => 1,]
         */
        $actions = array_fill_keys($actions, 1);

        return $this->render('task-actions-buttons', [
            'actions' => $actions,
            'task' => $this->task,
        ]);
    }
}