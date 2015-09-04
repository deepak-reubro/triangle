<?php

Interface DatabaseDriver{

	public static function connect();
	public static function query();

}