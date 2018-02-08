<?php
	
	namespace Tcp\Libarary;
	
	class ServerResponse
	{
		const CODE_PREFIX = 'code';
		const DATA_PREFIX = 'data';
		const MESSAGE_PREFIX = 'message';
		
		public function createSuccessMsg($msg)
		{
			return json_encode ([
				self::CODE_PREFIX    => 200,
				self::MESSAGE_PREFIX => $msg,
			]);
		}
		
		public function createCode($code)
		{
			return json_encode ([
				self::CODE_PREFIX => $code,
			]);
		}
		
		public function createSuccessCodeMsg($msg, $code)
		{
			return json_encode ([
				self::CODE_PREFIX    => $code,
				self::MESSAGE_PREFIX => $msg,
			]);
		}
		
		public function createSuccessMsgData($msg, $data)
		{
			return json_encode ([
				self::CODE_PREFIX    => 200,
				self::MESSAGE_PREFIX => $msg,
				self::DATA_PREFIX    => $data,
			]);
		}
		
		public function createSuccessCodeData($code, $data)
		{
			return json_encode ([
				self::CODE_PREFIX => $code,
				self::DATA_PREFIX => $data,
			]);
		}
		
		public function createErrorMsg($msg)
		{
			return json_encode ([
				self::CODE_PREFIX    => 0,
				self::MESSAGE_PREFIX => $msg,
			]);
		}
		
		public function createErrorCodeMsg($msg, $code)
		{
			return json_encode ([
				self::CODE_PREFIX    => $code,
				self::MESSAGE_PREFIX => $msg,
			]);
		}
		
		public function createErrorMsgData($msg, $data)
		{
			return json_encode ([
				self::CODE_PREFIX    => 0,
				self::MESSAGE_PREFIX => $msg,
				self::DATA_PREFIX    => $data,
			]);
		}
		
		public function createErrorCodeData($code, $data)
		{
			return json_encode ([
				self::CODE_PREFIX => $code,
				self::DATA_PREFIX => $data,
			]);
		}
	}