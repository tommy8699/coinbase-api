<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Repositories\ApiService;
use App\Model\Repositories\CoinBaseService;
use Nette\Application\UI\Presenter;

final class HomepagePresenter extends Presenter
{    
    private $apiService, $coinBaseService;

    public $productId;

    public function __construct(ApiService $apiService, CoinBaseService $coinBaseService)
	{
		$this->apiService = $apiService;
        $this->coinBaseService = $coinBaseService;
	}

    public function actionDefault():void
    {

    }

    public function renderDefault():void
    {
        $this->template->productId = $this->productId;
        $this->template->products = [];
        $this->template->warehouseValue = $this->productId != null ? [] : null;
    }

    public function handleGetWarehouseValue($productId) 
    {
        $this->productId = $productId;
    }

    public function actionGetDataFromCzechRegister():void
    {
        $this->apiService->getWarehouseValue();
        $this->redirect("default");
    }

    public function actionCoinBase():void
    {
        $this->coinBaseService->getCoinBase();
        $this->redirect("default");
    }
}
