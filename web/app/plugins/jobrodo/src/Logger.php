<?php

namespace Jobrodo\Plugin;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;

class Logger {

	private \Monolog\Logger $logger;
	private string          $name;

	public function __construct( string $name ) {
		$this->name   = $name;
		$this->logger = new \Monolog\Logger( $this->name );
		$this->logger->pushHandler( $this->rotating_file_handler() );
	}

	/**
	 * Set file handler.
	 *
	 * @return RotatingFileHandler
	 */
	private function rotating_file_handler(): RotatingFileHandler {
		$handler = new RotatingFileHandler( JOBRODO_PLUGIN_LOGDIR . $this->name . '-plugin.log', 7, \Monolog\Logger::DEBUG );
		$handler->setFormatter( new LineFormatter( null, null, true ) );

		return $handler;
	}

	/**
	 * Get the logger instance.
	 *
	 * @return \Monolog\Logger
	 */
	public function get(): \Monolog\Logger {
		return $this->logger;
	}

}
