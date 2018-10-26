<?php

namespace Service;


class Calculator
{

    private $employeeRole = 0;

    private $numberOfEmployees = 0;

    private $downloadUsage = 0;

    private $uploadUsage = 0;

    public function printValues()
    {

        echo "<br>Role: ".$this->employeeRole;
        echo "<br>Employee Count: ".$this->numberOfEmployees;
        echo "<br>Bandwidth Required: ".$this->downloadUsage;

    }

    public function calculateDownloadBw()
    {
        $downloadSpeedReq = ($this->numberOfEmployees * $this->downloadUsage)
            / 1000;

        return $downloadSpeedReq;

    }

    public function calculateUploadBw()
    {

        $uploadSpeedReq = ($this->numberOfEmployees * $this->uploadUsage)
            / 1000;

        return $uploadSpeedReq;


    }

    public function totalBw(
        $adminRoleDownload,
        $closerRoleDownload,
        $agentRoleDownload
    ) {

        $totalBandwidth = $adminRoleDownload + $closerRoleDownload
            + $agentRoleDownload;

        return $totalBandwidth;


    }

    /**
     * @return int
     */
    public function getDownloadUsage()
    {
        return $this->downloadUsage;
    }

    /**
     * @param int $downloadUsage
     *
     * @throws string \InvalidArgumentException
     */
    public function setDownloadUsage($downloadUsage)
    {

        if (!is_numeric($downloadUsage)) {
            throw new \Exception('Download value must be an integer '
                .$downloadUsage);
        }

        $this->downloadUsage = $downloadUsage;
    }

    /**
     * @return int
     */
    public function getNumberOfEmployees()
    {
        return $this->numberOfEmployees;
    }

    /**
     * @param int $numberOfEmployees
     *
     * @throws string \InvalidArgumentException
     */
    public function setNumberOfEmployees($numberOfEmployees)
    {

        if (!is_numeric($numberOfEmployees)) {
            throw new \Exception('Number of employee\'s value must be an integer '
                .$numberOfEmployees);
        }

        $this->numberOfEmployees = $numberOfEmployees;
    }

    /**
     * @return int
     */
    public function getEmployeeRole()
    {
        return $this->employeeRole;
    }

    /**
     * @param int $employeeRole
     */
    public function setEmployeeRole($employeeRole)
    {
        $this->employeeRole = $employeeRole;
    }

    /**
     * @return int
     */
    public function getUploadUsage()
    {
        return $this->uploadUsage;
    }

    /**
     * @param int $uploadUsage
     *
     * @throws string \InvalidArgumentException
     */
    public function setUploadUsage($uploadUsage)
    {

        if (!is_numeric($uploadUsage)) {
            throw new \Exception('Upload value must be an integer '
                .$uploadUsage);
        }

        $this->uploadUsage = $uploadUsage;
    }

}