<?php

namespace App\Admin\Controllers;

use App\QuestionTitle;
use App\QuestList;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Services\QuestionService;

class QuestionListController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('description')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new QuestList);

        $grid->id('Id');
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');
        $grid->title_id('Title id');
        $grid->name('Name');
        $grid->image_url('Image url');
        $grid->answer_A('Answer A');
        $grid->answer_B('Answer B');
        $grid->answer_C('Answer C');
        $grid->answer_D('Answer D');
        $grid->answer_true('Answer true');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(QuestList::findOrFail($id));

        $show->id('Id');
        $show->created_at('Created at');
        $show->updated_at('Updated at');
        $show->title_id('Title id');
        $show->name('Name');
        $show->image_url('Image url');
        $show->answer_A('Answer A');
        $show->answer_B('Answer B');
        $show->answer_C('Answer C');
        $show->answer_D('Answer D');
        $show->answer_true('Answer true');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new QuestList);

      //  $form->number('title_id', 'Title id');


      
        $form->select("title_id","绑定题纲")->options(function($title_id){
           return QuestionService::getTitleList();
        });
        $form->text('name', 'Name');
        $form->image('image_url', 'Image url');
        $form->text('answer_A', 'Answer A');
        $form->text('answer_B', 'Answer B');
        $form->text('answer_C', 'Answer C');
        $form->text('answer_D', 'Answer D');
        $form->text('answer_true', 'Answer true');

        return $form;
    }
}
