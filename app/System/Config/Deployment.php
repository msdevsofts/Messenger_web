<?php


namespace App\System\Config;


class Deployment
{
    /**
     * デプロイモード
     */
    protected const DEPLOY_DEVELOP = 'develop';     // 開発環境
    protected const DEPLOY_RELEASE = 'release';     // 本番環境

    protected const DEPLOY = self::DEPLOY_DEVELOP;

    public function isDeploymentDevelop() {
        return Deployment::DEPLOY === self::DEPLOY_DEVELOP;
    }

    public function isDeploymentRelease() {
        return Deployment::DEPLOY === self::DEPLOY_RELEASE;
    }
}
