<?php
class CategoriesController extends Controller
{
    protected $usesModels = array('CategoryCollection');

    public function index()
    {
        $repository = new Repository('categories');
        $categoryCollection = new CategoryCollection();

        return new View('json_encode_model', $categoryCollection);
    }
}