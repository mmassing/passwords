<?php

use \OCP\AppFramework\App;

$app = new App('passwords');
$container = $app->getContainer();

$l = \OCP\Util::getL10N('passwords');

\OCP\App::registerAdmin('passwords', 'templates/admin.settings');
\OCP\App::registerPersonal('passwords', 'templates/personal.settings');

$l10n = $container->query('OCP\IL10N');

$navigationEntry = function () use ($container) {
	return [
		'id' => 'passwords',
		'order' => 9999,
		'href' => $container->getServer()->getURLGenerator()->linkToRoute('passwords.page.index'),
		'icon' => $container->getServer()->getURLGenerator()->imagePath('passwords', 'app.svg'),
		'name' => $container->query('OCP\IL10N')->t('Passwords'),
	];
};
$container->getServer()->getNavigationManager()->add($navigationEntry);

\OC::$server->getActivityManager()->registerExtension(function() {
		return new \OCA\Passwords\Activity(
			\OC::$server->query('L10NFactory'),
			\OC::$server->getURLGenerator(),
			\OC::$server->getActivityManager()
		);
});
