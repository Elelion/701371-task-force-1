<?php
declare(strict_types=1);

namespace app\components;
use app\components\exception\ExceptionAction;

class Task
{
	const STATUS_NEW = 'new';
	const STATUS_PROGRESS = 'progress';
	const STATUS_CANCELED = 'cancel';
	const STATUS_COMPLETED = 'completed';
	const STATUS_FAILED = 'failed';

	const ROLES_ANONYMUS = 'anonymous';
	const ROLES_REGISTRED = 'registered';

	private $status;
	private $executorId;
	private $clientId;
	private $completed;

	public function __construct(array $data = []) {
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
				if (
					$key === 'status'
					&& !in_array($data['status'], $this->getStatuses())
				) {
					throw new ExceptionAction('Invalid argument. Task.php: __construct');
				}

				$this->{$key} = $value;
			}
		}

		echo 'executorId: ' . $this->executorId . PHP_EOL;
		echo 'clientId: ' . $this->clientId . PHP_EOL;
	}

	/**/

	public function getStatuses(): array
	{
		return [
			self::STATUS_NEW,
			self::STATUS_CANCELED,
			self::STATUS_PROGRESS,
			self::STATUS_COMPLETED,
			self::STATUS_FAILED
		];
	}

	public function getIdExecutor(): int
	{
		return $this->executorId;
	}

	public function getCurrentIdClient(): int
	{
		return $this->clientId;
	}

	public function getCurrentStatus(): string
	{
		return $this->status;
	}
}
