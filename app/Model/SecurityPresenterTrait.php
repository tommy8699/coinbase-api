<?php
declare(strict_types=1);


namespace App\Model;


use Nette\Http\IResponse;
use Tracy\Debugger;

trait SecurityPresenterTrait
{

    public function checkSignalPrivilege(bool $canDoStuff):void
    {
        if ($canDoStuff) {
            return;
        }
        $httpRequest = $this->getHttpRequest();
        $toLog = [
            'message' => 'Somebody tried to hack. There is some info.',
            'RemoteAddress' => $httpRequest->getRemoteAddress(),
            'RemoteHost' => $httpRequest->getRemoteHost(),
            'RequestHeaders' => $httpRequest->getHeaders(),
            'RequestedUrl' => $httpRequest->getUrl()->getAbsoluteUrl(),
        ];
        Debugger::log($toLog);

        $this->error('Omlouváme se, ale tuto akci není možné provést.', IResponse::S403_FORBIDDEN); 
    }
}
