<?php
	
	namespace Rpc\Server;
	
	use Rpc\Libs\Logs;
	use Rpc\Libs\Notice;
	
	class ConsumerRpc
	{
		protected $server;
		
		protected $log;
		
		public $config;
		
		public function __construct($config)
		{
			$this->config = $config;
			
			$this->server = new \swoole_server($config['ConsumerIp'], $config['ConsumerPort']);
		}
		
		public function start()
		{
			$this->connect ()->receive ()->close ();
			// 上线通知
			Notice::online ($this->config);
			
			$this->server->start ();
		}
		
		public function receive()
		{
			$this->server->on ('receive', function ($server, $fd, $reactor_id, $data) {
				$request   = Logs::receive ($data);
				$className = $this->config['production_path'] . $request['service'];
				$app       = new $className;
				$response  = $app->{$request['action']}($request['parameters']);
				$server->send ($fd, $response);
				$server->close ($fd);
			});
			
			return $this;
		}
		
		public function connect()
		{
			$this->server->on ('connect', function ($server, $fd) {
				Logs::add ('start_time', time ());
			});
			
			return $this;
		}
		
		public function close()
		{
			$this->server->on ('close', function ($server, $fd) {
				Logs::add ('end_time', time ());
				
				// 发送日志通知
				Notice::log ($this->config, Logs::$log);
			});
			
			return $this;
		}
	}