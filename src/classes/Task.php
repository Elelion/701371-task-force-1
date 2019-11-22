<?php
declare(strict_types=1);

namespace classes;

class Task
{
	const ACTION_NEW = 'new';
	const ACTION_START = 'start';
	const ACTION_CANCEL = 'cancel';
	const ACTION_COMPLE = 'completed';
	const ACTION_FAIL = 'fail';

	const STATUS_NEW = 'new';
	const STATUS_PROGRESS = 'progress';
	const STATUS_CANCELED = 'cancel';
	const STATUS_COMPLETED = 'completed';
	const STATUS_FAILED = 'failed';

	const ROLES_ANONYMUS = 'anonymous';
	const ROLES_REGISTRED = 'registered';

	public $status;
	public $idExecutor;
	public $idClient;
	public $completed;

	private const RELATIONS = [
		self::ACTION_NEW => self::STATUS_NEW,
		self::ACTION_START => self::STATUS_PROGRESS,
		self::ACTION_CANCEL => self::STATUS_CANCELED,
		self::ACTION_COMPLE => self::STATUS_COMPLETED,
		self::ACTION_FAIL => self::STATUS_FAILED
	];

	// **

	public function __construct(array $data = []) {
		foreach ($data as $key => $value) {
			if (property_exists($this, $key)) {
			// NOTE: $this - ссылка на текущий класс
			$this->{$key} = $value;
			echo $this->{$key} . PHP_EOL;
		}
	}
	}

	// **

	public function getActions(): array
	{
		return [
			self::ACTION_NEW,
			self::ACTION_CANCEL,
			self::ACTION_COMPLE,
			self::ACTION_FAIL
		];
	}

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
		return $this->idExecutor;
	}

	public function getCurrentStatus(): string
	{
		return $this->status;
	}

  // **

	// public function createTask(): void
	// {
	//   echo 'User action: ' . self::ACTION_NEW . PHP_EOL;

	//   $this->status = self::STATUS_NEW;
	//   echo 'status: ' . $this->status . PHP_EOL;

	//   $this->status = self::STATUS_PROGRESS;
	//   echo 'status: ' . $this->status . PHP_EOL;

	//   // TODO: code there...

	//   $this->status = self::STATUS_COMPLETED;
	//   echo 'status: ' . $this->status . PHP_EOL;
	// }

	// public function cancelTask(): void
	// {
	//   echo 'User action: ' . self::ACTION_CANCEL . PHP_EOL;
	//   $this->status = self::STATUS_CANCELED;
	//   echo 'status: ' . $this->status . PHP_EOL;
	// }
}