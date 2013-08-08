<?php
class CategoriesController extends Controller
{
    protected $usesModels = array('CategoryCollection');

    public function index()
    {
        return new View('json_encode_model', new CategoryCollection());
    }
}