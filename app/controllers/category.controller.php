<?php
include_once 'app/models/course.model.php';
include_once 'app/models/category.model.php';
include_once 'app/views/category.view.php';
include_once 'app/helpers/auth.helper.php';


class CategoryController
{

    private $model;
    private $modelCourse;
    private $view;
    private $authHelper;
    /**
    * Se inicia la sesión y se crean los objetos de modelos y vistas asociados.
    */
    function __construct()
    {
        $this->model = new CategoryModel();
        $this->modelCourse = new CourseModel();
        $this->view = new CategoryView();
        $this->authHelper = new AuthHelper();
    }

    /**
    * Obtiene cursos y manda a mostrar cursos por ID de categoría.
    * Si no existe el ID muestrar error 404.
    */
    public function showCategory($id)
    {
        $category = $this->model->getCategory($id);
        if (!empty($category)) {
            $categories = $this->model->getAll();
            $courses = $this->modelCourse->getCoursesByCategory($id);
            $this->view->showCategory($categories, $courses, $category);
        } else {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
        }
    }
    /**
     * Manda a mostrar ABM de categorías si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function showManageCategories()
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $categories = $this->model->getAll();
        $this->view->showManageCategories($categories);
    }
    /**
     * Manda a crear categoría con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function createCategory()
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion'])) {
            if ($this->model->insert($_POST['nombre'], $_POST['descripcion']))
                header('Location: ' . BASE_URL . 'categorias/administrar');
            else
                $this->view->showError("¡Ya existe una categoría con ese nombre!");
        }
    }
    /**
     * Manda a actualizar categoría con datos del fomulario de ABM si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function updateCategory($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        if (!empty($_POST['nombre']) && !empty($_POST['descripcion'])) {
            if ($this->model->update($id, $_POST['nombre'], $_POST['descripcion']))
                header('Location: ' . BASE_URL . 'categorias/administrar');
            else
                $this->view->showError("¡Ya existe una categoría con ese nombre!");
        } else {
            $categories = $this->model->getAll();
            $category = $this->model->getCategory($id);
            $this->view->showManageCategories($categories, $category);
        }
    }
    /**
     * Manda a eliminar categoría con datos del fomulario de ABM si el usuario es Administradors.
     * Si no es administrador muestrar error 404.
     */
    public function removeCategory($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        if (!count($this->modelCourse->getCoursesByCategory($id))) {
            $this->model->remove($id);
            header('Location: ' . BASE_URL . 'categorias/administrar');
        } else {
            $this->view->showError("La categoría tiene cursos asignados, NO se puede eliminar.");
        }
    }
    /**
     * Manda a mostrar mostrar confirmación para eliminar categoría si el usuario es Administrador.
     * Si no es administrador muestrar error 404.
     */
    public function showConfirmation($id)
    {
        $this->authHelper->checkLoggedIn();
        if (!$_SESSION['ADMINISTRADOR']) {
            header("HTTP/1.0 404 Not Found");
            $this->view->showError404();
            die();
        }
        $category = $this->model->getCategory($id);
        $name = $category->nombre;
        $this->view->confirmCategoryRemove($id, $name);
    }
    /**
     * Manda a mostrar error 404 si la URL llega inválida.
     */
    function showError404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->showError404();
    }
}
