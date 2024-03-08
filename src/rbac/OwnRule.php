<?php
namespace sudesuvar\todo\rbac;

use yii\rbac\Rule;

/**
 * Checks if authorID matches user passed via params
 */
/*
 * execute metodunda, kullanıcının
 * belirtilen bir model kaydını değiştirme yetkisine sahip olup olmadığını kontrol eder.
 * 
 * OwnRule, belirli bir kaydın sahibinin o kullanıcı olup olmadığını kontrol eder.
*/
class OwnRule extends Rule
{
    public $name = 'taskOwnRule';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['model']) ? $params['model']->id_user == $user : false;
    }
}

