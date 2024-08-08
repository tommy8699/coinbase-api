<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Repositories\ApiService;
use Nette\Application\UI\Presenter;


final class HomepagePresenter extends Presenter
{    
    private $apiService;

    public $productId;

    public function __construct(ApiService $apiService)
	{
		$this->apiService = $apiService;
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
}
