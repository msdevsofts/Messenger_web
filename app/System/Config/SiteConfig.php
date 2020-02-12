<?php


namespace App\System\Config;


class SiteConfig extends Deployment
{
    private $deploymentConfig;

    public function __construct() {
        $this->deploymentConfig = $this->isDeploymentDevelop()
            ? new DevelopmentConfig()
            : new ReleaseConfig();
    }

    /**
     * @return string
     */
    public function getRootDir(): string {
        return $this->deploymentConfig->getRootDir();
    }

    /**
     * @return string
     */
    public function getMainDir(): string {
        return $this->deploymentConfig->getMainDir();
    }

    /**
     * @return string
     */
    public function getMainHostName(): string {
        return $this->deploymentConfig->getMainHostName();
    }

    /**
     * @return string
     */
    public function getAdmHostName(): string {
        return $this->deploymentConfig->getAdmHostName();
    }

    /**
     * @return string
     */
    public function getApiHostName(): string {
        return $this->deploymentConfig->getApiHostName();
    }

    /**
     * @return string
     */
    public function getViewRoot(string $hostName): string {
        return $this->deploymentConfig->getViewRoot($hostName);
    }

    public function isMain(string $hostName): bool {
        return $this->deploymentConfig->isMain($hostName);
    }

    public function isAdmin(string $hostName): bool {
        return $this->deploymentConfig->isAdmin($hostName);
    }

    /**
     * @return string
     */
    public function getImageDir(): string {
        return $this->deploymentConfig->getImageDir();
    }

    /**
     * @return array
     */
    public function getSupportFileTypes(): array {
        return $this->deploymentConfig->getSupportFileTypes();
    }

    public function isJsMinify(): bool {
        return $this->deploymentConfig->isJsMinify();
    }
}
