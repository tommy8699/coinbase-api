<?php
declare(strict_types=1);


namespace App\Components\Post\Category\Grid;


use App\Model\Repositories\PostCategoryRepository;
use Nette\Application\UI\Control as UiControl;

class Control extends UiControl
{
    public function __construct(
        private PostCategoryRepository $postCategoryRepository,
    ) { }

    public function render():void
    {
       // $this->template->postCategories = $this->postCategoryRepository->findAll();
       $this->template->postCategories = [];
        $this->template->render(__DIR__ . '/default.latte');
    }
}
