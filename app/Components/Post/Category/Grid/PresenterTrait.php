<?php
declare(strict_types=1);


namespace App\Components\Post\Category\Grid;


use App\Model\SecurityPresenterTrait;
use Nette\DI\Attributes\Inject;

trait PresenterTrait
{
    use SecurityPresenterTrait;

    #[Inject] public ControlFactory $postCategoryGridControlFactory;

    private bool $canCreatePostCategoryGridControl = false;

    public function createComponentPostCategoryGridControl(): Control
    {
        $this->checkSignalPrivilege($this->canCreatePostCategoryGridControl);

        return $this->postCategoryGridControlFactory->create();
    }

}

