<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

/**/

use app\components\Task;
use app\components\Action;
use app\components\AvailableActions;

use app\components\RespondAction;
use app\components\CancelAction;
use app\components\CompleteAction;
use app\components\FailAction;

/**/

$myTask = new Task([
	'idClient' => 5,
	'idExecutor' => 3,
]);

var_dump(AvailableActions::getNextStatus(new FailAction));