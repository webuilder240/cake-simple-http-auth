<?php
	/**
	 * Created by PhpStorm.
	 * User: nick
	 * Date: 15/03/15
	 * Time: 14:09
	 */

	App::uses('Component', 'Controller');

	class BasicComponent extends Component {

		public function initialize(Controller $controller) {

			//Config Load
			$simpleHttpConfig = Configure::read('SimpleHttpAuth.Config');

			if (array_key_exists(env('DEVELOP_ENV'),$simpleHttpConfig)){

				if (!empty($simpleHttpConfig[env('DEVELOP_ENV')]['user']) && !empty($simpleHttpConfig[env('DEVELOP_ENV')]['password'])){

					$matchData = $this->_emptyCheck($simpleHttpConfig[env('DEVELOP_ENV')]);
					$this->autoRender = false;
					if (!isset($_SERVER['PHP_AUTH_USER'])) {
						header('Content-type: text/html; charset='.mb_internal_encoding());
						header('WWW-Authenticate: Basic realm="'.$matchData['auth_message'].'"');
						header('HTTP/1.0 401 Unauthorized');
						die($matchData['unauthrized_message']);
					} else {
						if ($_SERVER['PHP_AUTH_USER'] !== $matchData['user'] || $_SERVER['PHP_AUTH_PW'] !== $matchData['password']) {
							header('Content-type: text/html; charset='.mb_internal_encoding());
							header('WWW-Authenticate: Basic realm="'.$matchData['auth_message'].'"');
							header('HTTP/1.0 401 Unauthorized');
							die($matchData['unauthrized_message']);
						}
					}

					$this->autoRender = true;
				}
			}
		}

		//set Default Message
		private function _emptyCheck($matchData) {
			if (!array_key_exists('unauthrized_message',$matchData)) {
				$matchData['unauthrized_message'] = <<< EOT
					<h1>Unauthorized</h1>
					<p>
						This server could not verify that you are authorized to access the documentrequested.
						Either you supplied the wrong credentials (e.g., bad password), or your
						browser doesn't understand how to supply the credentials required.
					</p>
EOT;
			}

			if (!array_key_exists('auth_message',$matchData)){
				$matchData['auth_message'] = 'Enter username and password.';
			}

			return $matchData;
		}
	}
