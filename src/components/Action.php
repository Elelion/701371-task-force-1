<?php
declare(strict_types=1);

namespace app\components;

abstract class Action
{
	abstract public static function getTitle(): string;

	public static function getAction(): string
	{
		return static::class;
	}

	abstract public static function rightsVerification(
		Task $AvailableActions,
		int $userId
	): bool;
}