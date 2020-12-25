<?php

class LoginRequiredActivationCest {
	public function _before( AcceptanceTester $I ) {
		$I->loginAsAdmin();
		$I->amOnPluginsPage();
		$I->seePluginInstalled( 'login-required-by-nox' );
		$I->activatePlugin( 'login-required-by-nox' );
		$I->seePluginActivated( 'login-required-by-nox' );
	}

	public function seeOptionsPage( AcceptanceTester $I ) {
		$I->amOnPage( '/wp-admin/options-general.php?page=wp-nox-login-required-settings' );
		$I->see( 'Login Required by NOX' );
	}
}
